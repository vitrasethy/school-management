<?php

namespace App\Attributes;

use Attribute;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response as OAResponse;

#[Attribute(Attribute::TARGET_METHOD)]
class RegisterOperation extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/register',
            summary: 'User register',
            requestBody: new RequestBody(
                required: true,
                content: new JsonContent(
                    required: ['email', 'name', 'password', 'password_confirmation'],
                    properties: [
                        new Property(property: 'email', type: 'string', format: 'email', example: 'admin@gmail.com'),
                        new Property(property: 'name', type: 'string', format: 'name', example: 'admin'),
                        new Property(property: 'password', type: 'string', format: 'password', example: 'admin'),
                        new Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'admin'),
                    ]
                )
            ),
            tags: ['Authentication'],
            responses: [
                new OAResponse(
                    response: 200,
                    description: 'Successful register',
                    content: new JsonContent(
                        properties: [
                            new Property(property: 'token', type: 'string', format: 'token', example: '1|LASDHFLAKHE'),
                        ],
                    )
                ),
                new OAResponse(response: 422, description: 'Unprocessable Entity'),
            ]
        );
    }
}
