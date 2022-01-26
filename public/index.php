<?php

require '../vendor/autoload.php';

// use App\Components\Table;

// $table = new Table;

// $table->attributes = [
//     'border' => 1
// ];

// $data =
// [
//     ['id' =>1, 'username' => 'test1' ,'password' => '********'],
//     ['id' =>2, 'username' => 'test2' ,'password' => '********'],
//     ['id' =>3, 'username' => 'test3' ,'password' => '********'],
//     ['id' =>4, 'username' => 'test4' ,'password' => '********'],
// ];

// // example using $label, $row, $attributes
// // $table->setHeader("Inisial",0,['colspan' => '2']);

// $table->setHeader("No",0,['rowspan' => '2']);
// $table->setHeader("Username",0);
// $table->setHeader("Password",0);

// $table->setData($data);

// return $table;


// use App\Components\Card;
// use App\Components\Tab;
// use App\Components\Form;

// $card = new Card;

// $card->setTitle('Data User');
// $card->setDescription('List data user');
// $card->setBody(function(){
//     // init form
//     $form = new Form;
//     $form->field("password","Password","password");
//     return $form->render();
// });

// return $card;


// use App\Components\Form;

// $form = new Form;
// $form->enableInit = false;
// $form->field("password","Password","password");
// return $form;


use App\Components\Display;
use App\Components\Form;

$display = new Display;

$display->text('Name','Mr. Foo');
$display->tag('Hobby',['Reading','Traveling']);
$display->image('Avatar','https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png');
$display->images('Gallery',['https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png','https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png']);
$display->download('Attachment','https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png');
$display->downloads('Attachment',['https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png','https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png']);
$display->html('<button type="button">Buton Test</button>');

$display->callback(function(){
    $form = new Form;
    $form->enableInit = false;
    $form->field("text","Password","password");
    return $form->render();
});

return $display;


// use App\Components\Column;
// use App\Components\Form;

// $col = new Column;
// $col->add(function(){
//     $form = new Form;
//     $form->field("password","Password","password");
//     return $form->render();
// });
// $col->add(function(){
//     $form = new Form;
//     $form->field("password","Password","password");
//     return $form->render();
// });
// $col->add(function(){
//     $form = new Form;
//     $form->field("password","Password","password");
//     return $form->render();
// });
// $col->add(function(){
//     $form = new Form;
//     $form->field("password","Password","password");
//     return $form->render();
// });

// return $col;