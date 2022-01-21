<?php

require '../vendor/autoload.php';

use App\Components\Table;

$table = new Table;

$table->attributes = [
    'border' => 1
];

$data =
[
    ['id' =>1, 'username' => 'test1' ,'password' => '********'],
    ['id' =>2, 'username' => 'test2' ,'password' => '********'],
    ['id' =>3, 'username' => 'test3' ,'password' => '********'],
    ['id' =>4, 'username' => 'test4' ,'password' => '********'],
];

// example using $label, $row, $attributes
// $table->setHeader("Inisial",0,['colspan' => '2']);

$table->setHeader("No",0,['rowspan' => '2']);
$table->setHeader("Username",0);
$table->setHeader("Password",0);

$table->setData($data);

return $table;