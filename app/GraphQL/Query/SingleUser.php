<?php

namespace App\GraphQL\Query;
use App\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class SingleUser extends Query
{
    protected $attributes = [
        'name' => 'SingleUser',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::nonNull(\GraphQL::type('UserType'));
    }

    public function args()
    {
        return [

            'id'=>[
                'type' => Type::nonNull(Type::int()),
                'description' => 'use for id'
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {

        $user = User::find($args['id']);

        return $user;
    }
}