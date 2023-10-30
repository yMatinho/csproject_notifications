<?php

use Framework\Singleton\App;
use Framework\Singleton\Router\Router;
use \PhpAmqpLib\Connection\AMQPStreamConnection;

include("config.php");
include("routes.php");

function runQueue()

{
    $connection = new AMQPStreamConnection('notifications_rabbitmq', 5672, 'user1', 'test12');

    $channel = $connection->channel();

    $channel->queue_declare('email_queue', false, true, false, false);

    $callback = function ($msg) {
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    };

    $channel->basic_consume('email_queue', '', false, false, false, false, $callback);
    try {
        $channel->consume();
    } catch (\Throwable $exception) {
        echo $exception->getMessage();
    }
}

runQueue();