<?php
namespace model;

use base\model\AbstractModel;

class User extends AbstractModel
{
    protected string $table = 'users';
    protected array $fillable = [
        'email',
        'name',
        'phone',
        'address',
        'password'
    ];
    protected array $hidden = ['password'];
}
