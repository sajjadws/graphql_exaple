<?php

namespace App\GraphQL\Query;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class Index extends Query
{
    protected $attributes = [
        'name' => 'Index',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {

        return 'salllaaaam';
    }
}