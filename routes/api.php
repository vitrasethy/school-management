<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ActivityTypeController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Auth\RegisteredUserController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\FacultyController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\GroupCodeController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\OptionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ResponseController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\UserAffiliationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('groups/{group}/subjects/{subject}', [SubjectController::class, 'showByGroup']);

    Route::get('departments/{department}/groups', [GroupController::class, 'indexByDepartment']);

    Route::get('user', [UserController::class, 'getCurrentUser']);

    Route::get('user/{user}', [UserController::class, 'show']);

    Route::post('join-group', [GroupCodeController::class, 'join']);

    Route::get('groups/user', [GroupController::class, 'findByUser']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

    Route::apiResources([
        'user-affiliations' => UserAffiliationController::class,
        'faculties' => FacultyController::class,
        'schools' => SchoolController::class,
        'departments' => DepartmentController::class,
        'subjects' => SubjectController::class,
        'groups' => GroupController::class,
        'classrooms' => ClassroomController::class,
        'posts' => PostController::class,
        'schedules' => ScheduleController::class,
        'activity-types' => ActivityTypeController::class,
        'activities' => ActivityController::class,
        'forms' => FormController::class,
        'responses' => ResponseController::class,
        'questions' => QuestionController::class,
        'options' => OptionController::class,
        'answers' => AnswerController::class,
    ]);
});

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('register', [RegisteredUserController::class, 'store']);
