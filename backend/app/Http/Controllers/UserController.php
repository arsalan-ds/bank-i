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
        $url = 'https://jsonplaceholder.typicode.com/todos/1';
        // $url = config('constants.CREATE_ADDRESS_URL');
        $createAddress = HttpRequest::sendRequest($url, $userData, false);
        if($createAddress){
        //    $address = $createAddress->address;
           $address = '123456789poiuytresdfghjklmnbvcx';
           $updateUser = $this->user->updateAddress($address, $user->id);
           if($updateUser){
               return $this->successResponse(new UserResource($updateUser), ResponseMessage::OK);
           }
           return $this->failureResponse(ResponseMessage::MESSAGE_500);
        }
        return $this->failureResponse(ResponseMessage::MESSAGE_500);
    }
}
