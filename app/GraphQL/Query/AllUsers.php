<?php

namespace App\GraphQL\Query;

use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class AllUsers extends Query
{
    protected $attributes = [
        'name' => 'AllUsers',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(\GraphQL::type('UserType'));
    }

    public function args()
    {
        return [



        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $users = User::all();

        return $users;
    }
}