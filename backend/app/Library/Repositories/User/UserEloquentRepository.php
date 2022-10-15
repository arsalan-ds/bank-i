<?php

namespace BankI\Repositories\User;

use BankI\Models\User;
use BankI\Abstracts\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function __construct(){
        $this->model = new User();
    }

    public function create($data){
        $user = new $this->model;
        $user->first_name = $data['firstName'];
        $user->last_name = $data['lastName'];
        $user->email = $data['email'];
        $user->save();
    }

    public function first(){
        return $this->model->first();
    }

    public function updateAddress($address, $id){
        $user =  $this->model->where('id', $id)->first();
        $user->address = $address;
        $user->save();
        return $user;
    }
}
