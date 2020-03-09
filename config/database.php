<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql'=>[
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'bejadin_operation'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
        ],


         'mysql2' => [
             'driver' => 'mysql',
             'host' => env('DB_HOST_2', '127.0.0.1'),
             'port' => env('DB_PORT_2', '3306'),
             'database' => env('DB_DATABASE_2', 'bejadin_operation'),
             'username' => env('DB_USERNAME_2', 'root'),
             'password' => env('DB_PASSWORD_2', ''),
             'unix_socket' => env('DB_SOCKET_2', ''),
             'charset' => 'utf8',
             'collation' => 'utf8_general_ci',
             'prefix' => '',
             'prefix_indexes' => true,
             'strict' => false,
             'engine' => null,
         ],
         'mysql3' => [
             'driver' => 'mysql',
             'host' => env('DB_HOST_3', '127.0.0.1'),
             'port' => env('DB_PORT_3', '3306'),
             'database' => env('DB_DATABASE_3', 'bejadin_operation'),
             'username' => env('DB_USERNAME_3', 'root'),
             'password' => env('DB_PASSWORD_3', ''),
             'unix_socket' => env('DB_SOCKET_3', ''),
             'charset' => 'utf8',
             'collation' => 'utf8_general_ci',
             'prefix' => '',
             'prefix_indexes' => true,
             'strict' => false,
             'engine' => null,
         ],
         'mysql4' => [
             'driver' => 'mysql',
             'host' => env('DB_HOST_4', '127.0.0.1'),
             'port' => env('DB_PORT_4', '3306'),
             'database' => env('DB_DATABASE_4', 'bejadin_operation'),
             'username' => env('DB_USERNAME_4', 'root'),
             'password' => env('DB_PASSWORD_4', ''),
             'unix_socket' => env('DB_SOCKET_4', ''),
             'charset' => 'utf8',
             'collation' => 'utf8_general_ci',
             'prefix' => '',
             'prefix_indexes' => true,
             'strict' => false,
             'engine' => null,
         ],
         'mysql5' => [
             'driver' => 'mysql',
             'host' => env('DB_HOST_5', '127.0.0.1'),
             'port' => env('DB_PORT_5', '3306'),
             'database' => env('DB_DATABASE_5', 'bejadin_operation'),
             'username' => env('DB_USERNAME_5', 'root'),
             'password' => env('DB_PASSWORD_5', ''),
             'unix_socket' => env('DB_SOCKET_5', ''),
             'charset' => 'utf8',
             'collation' => 'utf8_general_ci',
             'prefix' => '',
             'prefix_indexes' => true,
             'strict' => false,
             'engine' => null,
         ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
