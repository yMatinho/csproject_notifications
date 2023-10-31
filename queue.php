<?php

use App\Core\Jobs\EmailJob;
use Framework\Singleton\App;
use Framework\Singleton\Router\Router;
use \PhpAmqpLib\Connection\AMQPStreamConnection;

include("config.php");
include("routes.php");

App::get()->executeQueue("email_queue", EmailJob::class);