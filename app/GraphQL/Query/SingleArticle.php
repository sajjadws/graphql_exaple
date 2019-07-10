<?php

namespace App\GraphQL\Query;

use App\Article;
use App\GraphQL\Type\ArticleType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class SingleArticle extends Query
{
    protected $attributes = [
        'name' => 'SingleArticle',
        'description' => 'A query'
    ];

    public function type()
    {
        return \GraphQL::type('ArticleType');
    }

    public function args()
    {
        return [

            'id'=>[
                'type' => Type::nonNull(Type::int())
            ]

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {

        return Article::find($args['id']);
    }
}