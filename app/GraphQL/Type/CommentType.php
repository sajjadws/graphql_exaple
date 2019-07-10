<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CommentType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

            'id' => [
                'type' => Type::int(),
                'description' => 'use for id'
            ],
            'user' => [
                'type' => \GraphQL::type('UserType'),
                'description' => 'use for id'
            ],

            'approved' => [
                'type' => Type::boolean(),
                'description' => 'use for check this comment accepted or not'
            ],
            'article' => [
                'type' => \GraphQL::type('ArticleType'),
                'description' => 'use for id'
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'use for id'
            ],
        ];
    }
}