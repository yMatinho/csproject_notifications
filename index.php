<?php

use Framework\Singleton\App;
use Framework\Singleton\Router\Router;
use \PhpAmqpLib\Connection\AMQPStreamConnection;

include("config.php");
include("routes.php");

function runQueue()

{

    $connection = new AMQPStreamConnection('notifications_rabbitmq', 5672, 'guest', 'guest');

    $channel = $connection->channel();

    $channel->queue_declare('email_queue', false, true, false, false);

    $callback = function ($msg) {

        echo $msg->body;

        echo "Fila processada \n";
    };

    $channel->basic_consume('email_queue', '', false, true, false, false, $callback);

    try {
        while (count($channel->callbacks)) {

            $channel->wait($allowed_methods = null, $nonBlocking = false);
        }
    } finally {

        $channel->close();

        $connection->close();
    }
}


App::get()->executeApi();
