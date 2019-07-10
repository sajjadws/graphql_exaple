<?php

namespace App\GraphQL\Mutation\Article;

use App\Article;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteArticle extends Mutation
{
    protected $attributes = [
        'name' => 'DeleteArticle',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::boolean();
    }

    public function args()
    {
        return [
            'id' =>[
                'type' => Type::nonNull(Type::int())
            ]


        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {

        $article = Article::findOrFail($args['id']);
        $article -> delete();

        return $article;
    }
}