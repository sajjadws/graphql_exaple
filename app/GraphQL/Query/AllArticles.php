<?php

namespace App\GraphQL\Query;

use App\Article;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class AllArticles extends Query
{
    protected $attributes = [
        'name' => 'AllArticles',
        'description' => 'A query for all articles'
    ];

    public function type()
    {
        return Type::listOf(\GraphQL::type('ArticleType'));;
    }

    public function args()
    {
        return [
            'limit'=>[
                'type' => Type::int()
            ],
            'page'=>[
                'type' => Type::int()
            ]

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;

        $articles = Article::paginate($limit, ['*'], 'page', $page);

        return $articles;
    }
}