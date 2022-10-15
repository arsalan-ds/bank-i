<?php

namespace BankI\Abstracts;

interface RepositoryInterface
{
    public function all($fields = [], array $with = []);

    public function getById($id, array $with = []);

    public function delete($id);
}
