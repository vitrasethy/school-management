<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\JoinGroupRequest;
use App\Models\Group;
use Auth;
use function abort;

class GroupCodeController extends BaseController
{
    public function join(Group $group, JoinGroupRequest $request)
    {
        $validated = $request->validated();

        if ($group->code !== $validated['code']) {
            abort(404);
        }

        $group->users()->attach(Auth::id());

        return $this->noContentResponse();
    }
}
