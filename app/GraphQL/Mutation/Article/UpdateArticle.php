<?php

namespace App\GraphQL\Mutation\Article;

use App\Article;
use App\GraphQL\Type\ArticleType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateArticle extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateArticle',
        'description' => 'A mutation'
    ];


    public function authorize(array $args)
    {
        return auth()->user()->admin && Article::find($this->$args['id']) -> user -> id == auth() -> user() ->id; // TODO: Change the autogenerated stub
    }


    public function type()
    {
        return \GraphQL::type('ArticleType');
    }

    public function args()
    {
        return [

            'id' =>[
                'type' => Type::nonNull(Type::int())
            ],'title' =>[
                'type' => Type::string()
            ],'body' =>[
                'type' => Type::nonNull(Type::string())
            ],

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $updateArticle = Article::findOrFail($args['id']);

        $updateArticle -> update($args);

        return $updateArticle;
    }
}