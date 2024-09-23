<?php

namespace App\Attributes;

use Attribute;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response as OAResponse;

#[Attribute(Attribute::TARGET_METHOD)]
class GetCurrentUserOperation extends OA\Get
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/user',
            summary: 'Get current user',
            tags: ['Authentication'],
            responses: [
                new OAResponse(
                    response: 200,
                    description: 'OK',
                    content: new JsonContent(
                        properties: [
                            new Property(property: 'id', type: 'int', format: 'id', example: '1'),
                            new Property(property: 'name', type: 'string', format: 'name', example: 'admin'),
                            new Property(property: 'email', type: 'string', format: 'email', example: 'admin@gmail.com'),
                        ],
                    )
                ),
                new OAResponse(response: 401, description: 'Unauthenticated'),
            ]
        );
    }
}
