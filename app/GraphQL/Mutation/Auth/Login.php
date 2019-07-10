<?php

namespace App\GraphQL\Mutation\Auth;

use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Login extends Mutation
{
    protected $attributes = [
        'name' => 'Login',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return \GraphQL::type('TokenType');
    }

    public function args()
    {
        return [
            'email' => [
                'type' => Type::string(),
                'description' => ""
            ],
            'password' => [
                'type' => Type::string(),
                'description' => ""
            ],

        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        if(Auth::attempt([

            'email'=>$args['email'],
            'password'=>$args['password']
        ])){

            $user = Auth::user();

            $token = $user->createToken('sajjad')->accessToken;

            return [
                'token' => $token,
                'user' => $user
            ];

        }else{

            return new Error('Unathorised');
        }


    }
}