<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'use for id'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'use for id'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'use for id'
            ],
            'admin' => [
                'type' => Type::boolean(),
                'description' => 'use for id'
            ],
            ///this articles string should same name of method in User.php class method articles
            'articles' => [
                'type' => Type::listOf(\GraphQL::type('ArticleType'))
            ]

        ];
    }
}