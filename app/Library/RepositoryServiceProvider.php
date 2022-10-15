<?php

namespace BankI;

use BankI\Repositories\User\UserEloquentRepository;
use BankI\Repositories\User\UserRepositoryInterface;
use BankI\Repositories\UserCard\UserCardEloquentRepository;
use BankI\Repositories\UserCard\UserCardRepositoryInterface;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $bindings = [
          [UserRepositoryInterface::class, UserEloquentRepository::class],
          [UserCardRepositoryInterface::class, UserCardEloquentRepository::class],
        ];
        $this->bindInterfacesWithTheirImplementations($bindings);
    }

    public function bindInterfacesWithTheirImplementations($bindings)
    {
        foreach ($bindings as $binding) {
            $this->app->bind($binding[0], $binding[1]);
        }
    }
}
