<?php

namespace Database\Seeders;

use BankI\Repositories\User\UserRepositoryInterface;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = app(UserRepositoryInterface::class);
        $data = [
            'firstName' => 'jhon',
            'lastName' => 'doe',
            'email' => 'jhondoe@example.com',
        ];
        $user->create($data);
    }
}
