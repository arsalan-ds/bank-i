<?php

namespace App\Http\Controllers;

use BankI\Enums\ResponseMessage;
use BankI\Requests\AddCardRequest;
use BankI\Repositories\UserCard\UserCardRepositoryInterface;
use BankI\Resource\UserCard\UserCardResource;
use BankI\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class UserCardController extends Controller
{
    use ApiResponseTrait;
    protected $userCard;
    public function __construct()
    {
        $this->userCard = app(UserCardRepositoryInterface::class);
    }

    public function index(){
        $user = auth()->user();
        $cards = $this->userCard->getByUserId($user->id);
        return $this->successResponse(UserCardResource::collection($cards), ResponseMessage::FOUND);
    }

    public function store(AddCardRequest $request){
        $user = auth()->user();
        $userCard = $this->userCard->create($request->prepareRequest($user->id));
        if($userCard){
            return $this->successResponse(new UserCardResource($userCard), ResponseMessage::CREATE);
        }
        return $this->failureResponse(ResponseMessage::MESSAGE_500);
    }
}
