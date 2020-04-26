<?php

namespace repository;

use model\User;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
