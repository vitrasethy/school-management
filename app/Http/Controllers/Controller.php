<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'School Management System',
    description: 'An API for manage school records.',
)]
abstract class Controller
{
    //
}
