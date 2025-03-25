<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JoinGroupRequest;
use App\Models\Group;
use Auth;

use function abort;

class GroupCodeController extends BaseController
{
    public function join(JoinGroupRequest $request)
    {
        $validated = $request->validated();

        if ($validated['group_id'] !== $validated['code']) {
            abort(404);
        }

        Group::find($validated['group_id'])->users()->attach(Auth::id());

        return $this->noContentResponse();
    }
}
