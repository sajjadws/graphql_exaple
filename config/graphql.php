<?php


use example\Type\ExampleType;
use example\Query\ExampleQuery;
use example\Mutation\ExampleMutation;
use example\Type\ExampleRelationType;

return [

    // The prefix for routes
    'prefix' => 'graphql',

    // The routes to make GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Route
    //
    // Example:
    //
    // Same route for both query and mutation
    //
    // 'routes' => 'path/to/query/{graphql_schema?}',
    //
    // or define each route
    //
    // 'routes' => [
    //     'query' => 'query/{graphql_schema?}',
    //     'mutation' => 'mutation/{graphql_schema?}',
    // ]
    //
    'routes' => '{graphql_schema?}',

    // The controller to use in GraphQL request. Either a string that will apply
    // to both query and mutation or an array containing the key 'query' and/or
    // 'mutation' with the according Controller and method
    //
    // Example:
    //
    // 'controllers' => [
    //     'query' => '\Rebing\GraphQL\GraphQLController@query',
    //     'mutation' => '\Rebing\GraphQL\GraphQLController@mutation'
    // ]
    //
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',

    // Any middleware for the graphql route group
    'middleware' => [],

    // Additional route group attributes
    //
    // Example:
    //
    // 'route_group_attributes' => ['guard' => 'api']
    //
    'route_group_attributes' => [],

    // The name of the default schema used when no argument is provided
    // to GraphQL::schema() or when the route is used without the graphql_schema
    // parameter.
    'default_schema' => 'default',

    // The schemas for query and/or mutation. It expects an array of schemas to provide
    // both the 'query' fields and the 'mutation' fields.
    //
    // You can also provide a middleware that will only apply to the given schema
    //
    // Example:
    //
    //  'schema' => 'default',
    //
    //  'schemas' => [
    //      'default' => [
    //          'query' => [
    //              'users' => 'App\GraphQL\Query\UsersQuery'
    //          ],
    //          'mutation' => [
    //
    //          ]
    //      ],
    //      'user' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\ProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //      'user/me' => [
    //          'query' => [
    //              'profile' => 'App\GraphQL\Query\MyProfileQuery'
    //          ],
    //          'mutation' => [
    //
    //          ],
    //          'middleware' => ['auth'],
    //      ],
    //  ]
    //

    /*
    query getTwoUSer($user1: Int!, $user2: Int!){
    userA : user(id : $user1){  // alias
    id
    name
    },
    userB : user(id : $user2){
    id
    name
    }
    }

     */


    /// with fragments
    /*

    query getTwoUSer($user1: Int!, $user2: Int!){

  userA : user(id : $user1){
   ...userFields
  },
  userB : user(id : $user2){
   ...userFields
    articles{
      comments{
        body
      }
    }
  }
}


fragment userFields on UserType{
  id
  name
}

     */


    /// directions
    /*

        query getTwoUSer($user1: Int!, $user2: Int!, $showUser :Boolean!){

      userA : user(id : $user1) @skip(if : $showUser){
       ...userFields
      },
      userB : user(id : $user2) @include(if : $showUser){
       ...userFields
        articles{
          comments{
            body
          }
        }
      }
    }


    fragment userFields on UserType{
      id
      name
    }


    {
      "user1": 1,
      "user2": 3,
      "showUser": true
    }

         */


    /*

    mutation createNewArticle($title : String!, $body : String!){

      createArticle(title: $title, body : $body){

        title
        body
        user{
          name

        }
      }
    }

    {
      "title": "sallammm",
      "body": "khobiiii"
    }

     */

    /*

    mutation updateArticle($id : Int! , $title : String!, $body : String!){

      updateArticle(id : $id ,title: $title, body : $body){

        title
        body
        user{
          name

        }
      }
    }

    {
      "title": "ssss",
      "body": "sssssssss",
      "id": 139
    }

     */

    /*

    mutation deleteArticle($id : Int!){

      deleteArticle(id : $id )


    }

    {
      "id": 139
    }
     */

    /*
    mutation createNewUser($name : String!, $email : String!, $password : String!){


      registerUser(name : $name, email : $email, password : $password){
        token
      }


    }


    {
      "name": "sajjad",
      "email": "sakkad@gmail.com",
      "password": "sajjad"
    }

     */

    /*

    mutation craeateArticle( $title : String!, $body : String!, $photo : Upload!){


}



    */


    'schemas' => [
        'default' => [
            'query' => [
                'welcome' => \App\GraphQL\Query\Index::class,
                'allArticles' => \App\GraphQL\Query\AllArticles::class,
                'article' => \App\GraphQL\Query\SingleArticle::class
            ],
            'mutation' => [
                'registerUser' => \App\GraphQL\Mutation\Auth\Register::class,
                'loginUser' => \App\GraphQL\Mutation\Auth\Login::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],

        'user' => [
            'query' => [
                'allUsers' => \App\GraphQL\Query\AllUsers::class,
                'user' => \App\GraphQL\Query\SingleUser::class,
            ],
            'mutation' => [
                'createArticle' => \App\GraphQL\Mutation\Article\CreateArticle::class,
                'updateArticle' => \App\GraphQL\Mutation\Article\UpdateArticle::class,
                'deleteArticle' => \App\GraphQL\Mutation\Article\DeleteArticle::class,

            ],
            'middleware' => ['auth:api'],
        ],
    ],

    // The types available in the application. You can then access it from the
    // facade like this: GraphQL::type('user')
    //
    // Example:
    //
    // 'types' => [
    //     'user' => 'App\GraphQL\Type\UserType'
    // ]
    //
    'types' => [
        'ArticleType' => \App\GraphQL\Type\ArticleType::class,
        'UserType' => \App\GraphQL\Type\UserType::class,
        'CommentType' => \App\GraphQL\Type\CommentType::class,
        'TokenType' => \App\GraphQL\Type\TokenType::class,

        // 'example'           => ExampleType::class,
        // 'relation_example'  => ExampleRelationType::class,
    ],

    // This callable will be passed the Error object for each errors GraphQL catch.
    // The method should return an array representing the error.
    // Typically:
    // [
    //     'message' => '',
    //     'locations' => []
    // ]
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],

    /*
     * Custom Error Handling
     *
     * Expected handler signature is: function (array $errors, callable $formatter): array
     *
     * The default handler will pass exceptions to laravel Error Handling mechanism
     */
    'errors_handler' => ['\Rebing\GraphQL\GraphQL', 'handleErrors'],

    // You can set the key, which will be used to retrieve the dynamic variables
    'params_key' => 'variables',

    /*
     * Options to limit the query complexity and depth. See the doc
     * @ https://github.com/webonyx/graphql-php#security
     * for details. Disabled by default.
     */
    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    /*
     * You can define your own pagination type.
     * Reference \Rebing\GraphQL\Support\PaginationType::class
     */
    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    /*
     * Config for GraphiQL (see (https://github.com/graphql/graphiql).
     */
    'graphiql' => [
        'prefix' => '/graphiql/{graphql_schema?}',
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    /*
     * Overrides the default field resolver
     * See http://webonyx.github.io/graphql-php/data-fetching/#default-field-resolver
     *
     * Example:
     *
     * ```php
     * 'defaultFieldResolver' => function ($root, $args, $context, $info) {
     * },
     * ```
     * or
     * ```php
     * 'defaultFieldResolver' => [SomeKlass::class, 'someMethod'],
     * ```
     */
    'defaultFieldResolver' => null,

    /*
     * Any headers that will be added to the response returned by the default controller
     */
    'headers' => [],

    /*
     * Any JSON encoding options when returning a response from the default controller
     * See http://php.net/manual/function.json-encode.php for the full list of options
     */
    'json_encoding_options' => 0,
];
