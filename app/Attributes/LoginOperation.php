<?php

namespace App\Attributes;

use Attribute;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response as OAResponse;

#[Attribute(Attribute::TARGET_METHOD)]
class LoginOperation extends OA\Post
{
    public function __construct()
    {
        parent::__construct(
            path: '/api/login',
            summary: 'User login',
            requestBody: new RequestBody(
                required: true,
                content: new JsonContent(
                    required: ['email', 'password'],
                    properties: [
                        new Property(property: 'email', type: 'string', format: 'email', example: 'admin@gmail.com'),
                        new Property(property: 'password', type: 'string', format: 'password', example: 'admin'),
                    ]
                )
            ),
            tags: ['Authentication'],
            responses: [
                new OAResponse(
                    response: 200,
                    description: 'Successful login',
                    content: new JsonContent(
                        properties: [
                            new Property(property: 'token', type: 'string', format: 'token', example: '1|LASDHFLAKHE'),
                        ],
                    )
                ),
                new OAResponse(response: 422, description: 'Wrong email or password'),
            ]
        );
    }
}
