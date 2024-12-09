<?php

if (php_sapi_name() != 'cli') { die("This script can only be run from the command line."); }

require_once '../vendor/autoload.php';
require_once '../Config/DataBase.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$tableExists = Capsule::schema()->hasTable('tasks');

if (!$tableExists)
{
	Capsule::schema()->create('tasks', function ($table) {
		$table->increments('id');
		$table->string('username');
		$table->string('email');
		$table->text('task_text');
		$table->integer('status')->default(0);
		$table->timestamps();
	});
	echo "Success" . PHP_EOL;
}
else
{
	echo "Table 'tasks' is exists" . PHP_EOL;
}