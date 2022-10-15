<?php

namespace BankI\Repositories\UserCard;

use BankI\Abstracts\RepositoryInterface;

interface UserCardRepositoryInterface extends RepositoryInterface
{
    public function create($data);

    public function getByUserId($userId);
}
