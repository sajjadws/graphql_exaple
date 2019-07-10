<?php

namespace App\GraphQL\Mutation\Auth;

use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class Register extends Mutation
{
    protected $attributes = [
        'name' => 'Register',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return \GraphQL::type('TokenType');
    }

    public function args()
    {
        return [

            'name' => [
                'type' => Type::string(),
                'description' => ""
            ],
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

    protected function rules(array $args = [])
    {

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]; // TODO: Change the autogenerated stub
    }

    public function validationErrorMessages(array $args = [])
    {
        return [
            'email.required' => 'وارد کردن ایمیل الزامی است',
            'email.email' => 'شکل ایمیل درست نمی باشد',
            'password.min.' => 'تعداد کاراکاتر ها حداقل 6 کاراکتر باشد',


        ]; // TODO: Change the autogenerated stub
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $user  = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => bcrypt($args['password']),

                ]
        );

        return [
            'token' => $user->createToken('sajjad')->accessToken,
            'user' => $user
        ];
    }
}