<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Channel
    |--------------------------------------------------------------------------
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations
    |--------------------------------------------------------------------------
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace'   => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Channels
    |--------------------------------------------------------------------------
    */

    'channels' => [

        /*
        |--------------------------------------------------------------------------
        | Stack
        |--------------------------------------------------------------------------
        */

        'stack' => [
            'driver' => 'stack',
            'channels' => explode(
                ',',
                env('LOG_STACK', 'app,bugs,critical')
            ),
            'ignore_exceptions' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Application Logs
        |--------------------------------------------------------------------------
        */

        'app' => [
            'driver' => 'daily',
            'path' => storage_path('logs/app/app.log'),
            'level' => 'debug',
            'days' => env('LOG_DAILY_DAYS', 30),
            'tap' => [
                App\Support\Logging\CustomizeFormatter::class,
            ],
            'processors' => [
                App\Support\Logging\ContextProcessor::class,
            ],
            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Bugs Logs
        |--------------------------------------------------------------------------
        */

        'bugs' => [
            'driver' => 'daily',
            'path' => storage_path('logs/bugs/bugs.log'),
            'level' => 'warning',
            'days' => env('LOG_DAILY_DAYS', 30),

            'tap' => [
                App\Support\Logging\CustomizeFormatter::class,
            ],

            'processors' => [
                App\Support\Logging\ContextProcessor::class,
            ],

            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Critical Logs
        |--------------------------------------------------------------------------
        */

        'critical' => [
            'driver' => 'daily',
            'path' => storage_path('logs/critical/critical.log'),
            'level' => 'critical',
            'days' => 90,

            'tap' => [
                App\Support\Logging\CustomizeFormatter::class,
            ],

            'processors' => [
                App\Support\Logging\ContextProcessor::class,
            ],

            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Slack
        |--------------------------------------------------------------------------
        */

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),

            'username' => env(
                'LOG_SLACK_USERNAME',
                'Application Monitor'
            ),

            'emoji' => env(
                'LOG_SLACK_EMOJI',
                ':boom:'
            ),

            'level' => 'critical',
            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Papertrail
        |--------------------------------------------------------------------------
        */

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,

            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => sprintf(
                    'tls://%s:%s',
                    env('PAPERTRAIL_URL'),
                    env('PAPERTRAIL_PORT')
                ),
            ],

            'processors' => [
                PsrLogMessageProcessor::class,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Stderr
        |--------------------------------------------------------------------------
        */

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,

            'handler_with' => [
                'stream' => 'php://stderr',
            ],

            'formatter' => env('LOG_STDERR_FORMATTER'),

            'processors' => [
                PsrLogMessageProcessor::class,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Syslog
        |--------------------------------------------------------------------------
        */

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),

            'facility' => env(
                'LOG_SYSLOG_FACILITY',
                LOG_USER
            ),
            
            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Error Log
        |--------------------------------------------------------------------------
        */

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Null
        |--------------------------------------------------------------------------
        */

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        /*
        |--------------------------------------------------------------------------
        | Emergency
        |--------------------------------------------------------------------------
        */

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
    ],
];