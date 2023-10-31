<?php

namespace Framework\Singleton;

use Exception;
use Framework\Command\ApiExecutionCommand;
use Framework\Command\ExecutionCommand;
use Framework\Factory\ViewFactory;
use Framework\Singleton\Singleton;
use Framework\View\View;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class App implements Singleton
{
    private static $instance;

    private ExecutionCommand $command;

    private function __construct()
    {
    }

    public static function get(): App
    {
        if (!self::$instance)
            self::$instance = new App();
        return self::$instance;
    }

    public function executeApi()
    {
        header("Content-Type: application/json");

        $this->command = new ApiExecutionCommand($this->getBruteUrl());
        $this->command->execute();
    }

    public function  executeQueue(string $queue, string $jobClass): void
    {
        $connection = new AMQPStreamConnection(RABBITMQ_HOST, RABBITMQ_PORT, RABBITMQ_USER, RABBITMQ_PASSWORD);

        $channel = $connection->channel();

        $channel->queue_declare($queue, false, true, false, false);

        $callback = function ($msg) use ($jobClass) {
            try {
                $job = new $jobClass(json_decode($msg->body));
                $job->handle();
            } catch(Exception $e) {}
            
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->basic_consume($queue, '', false, false, false, false, $callback);
        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }

    private function getBruteUrl(): string
    {
        return str_replace(["/", "http:", "https:"], "", $_SERVER["REQUEST_URI"]);
    }
}
