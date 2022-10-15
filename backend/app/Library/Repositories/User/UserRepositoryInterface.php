<?php

namespace BankI\Repositories\User;
use BankI\Abstracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function create($data);

    public function first();

    public function updateAddress($address, $id);
}
