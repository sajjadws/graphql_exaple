<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ArticleType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ArticleType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id'=>[
                'type' => Type::int(),
                'description' => 'use for id'
            ],
            'title'=>[
                'type' => Type::string(),
                'description' => 'use for id'
            ],
            'body'=>[
                'type' => Type::string(),
                'description' => 'use for id'
            ],
            'image'=>[
                'type' => Type::string(),
                'description' => 'use for id'
            ],
            'approved' => [
                'type' => Type::boolean(),
                'description' => 'use for check this comment accepted or not'
            ],
            'comments'=>[
                'type' => Type::listOf(\GraphQL::type('CommentType')),
                'description' => 'this comments string should same name of method in Article.php class method comments',
                'resolve' => function($data){return $data->comments()->where('approved',true)->get();}
            ],
            'user'=>[
                'type' => \GraphQL::type('UserType'),
                'description' => 'this user string should same name of method in Article.php class method user'
            ]

        ];
    }
}