<?php

include_once __DIR__ . '/../.env.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$databaseName = defined('DB_NAME') && DB_NAME ? DB_NAME : '';
$databaseUser = defined('DB_USER') && DB_USER ? DB_USER : '';
$databasePass = defined('DB_PASS') && DB_PASS ? DB_PASS : '';

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'db',
	'database' => $databaseName,
	'username' => $databaseUser,
	'password' => $databasePass,
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_unicode_ci',
	'unix_socket' => '/var/lib/mysql/mysql.sock',
	'port' => 3306,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
