<?php

namespace App\GraphQL\Type;


use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TokenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'TokenType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

            'token'=>[
                'type' => Type::string()
            ],
            'user' => [
                'type' => \GraphQL::type('UserType'),
                'description' => ""
            ],

        ];
    }
}