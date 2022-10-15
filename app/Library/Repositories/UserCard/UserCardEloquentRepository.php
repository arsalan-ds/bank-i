<?php

namespace BankI\Repositories\UserCard;

use BankI\Abstracts\EloquentRepository;
use BankI\Models\UserCard;
use Illuminate\Support\Facades\Crypt;

class UserCardEloquentRepository extends EloquentRepository implements UserCardRepositoryInterface
{
    public function __construct()
    {
        $this->model = new UserCard();
    }

    public function create($data){
        $userCard = new $this->model;
        $userCard->user_id = $data['userId'];
        $userCard->card_number = Crypt::encryptString($data['cardNumber']);
        $userCard->expiry_month_and_year = $data['expiry'];
        $userCard->cvc = $data['securityCode'];
        $userCard->is_default = $data['isDefault'];
        $userCard->color = $data['color'];
        $userCard->save();
        return $userCard;
    }

    public function getByUserId($userId){
        return $this->model->where('user_id', $userId)->get();
    }
}
