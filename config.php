<?php

require("vendor/autoload.php");

define("MAIN_DIR", __DIR__.'/');
define("SITE_URL", "http://localhost:8083/");

define("DB_DATABASE", "csproject_db");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "secret");
define("DB_PORT", 3307);
define("DB_HOST", "notifications_database");

define("RABBITMQ_HOST", "notifications_rabbitmq");
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USER", "user1");
define("RABBITMQ_PASSWORD", "test12");

define("EMAIL_HOST", "smtp.gmail.com");
define("EMAIL_USER", "");
define("EMAIL_PASSWORD", "");
define("EMAIL_PORT", 587);
define("EMAIL_FROM_EMAIL", "noreply@csproject.com");
define("EMAIL_FROM_NAME", "CS Project");

spl_autoload_register(function($class) {
    $class = str_replace("\\","/", $class);
    if(!file_exists(MAIN_DIR.'src/' . $class . '.php'))
        return;
    include MAIN_DIR.'src/' . $class . '.php';
});