<?php

namespace App\Attributes;

use Attribute;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Response as OAResponse;

#[Attribute(Attribute::TARGET_METHOD)]
class LogoutOperation extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/logout',
            summary: 'User logout',
            tags: ['Authentication'],
            responses: [
                new OAResponse(response: 204, description: 'Successful logout'),
            ]
        );
    }
}
