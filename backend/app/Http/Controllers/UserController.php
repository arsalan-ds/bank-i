<?php

namespace App\Http\Controllers;

use BankI\Enums\ResponseMessage;
use BankI\Repositories\User\UserRepositoryInterface;
use BankI\Resource\User\UserResource;
use BankI\Traits\ApiResponseTrait;
use BankI\Utils\HttpRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;
    protected $user;
    public function __construct()
    {
        $this->user = app(UserRepositoryInterface::class);
    }

    public function signIn(){
        $user = $this->user->first();
        $userData = [
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
        ];
        return $this->successResponse(new UserResource($user), ResponseMessage::OK);
    }
}
