## Simple Libraries Components (SILICO)
Kumpulan component kecil-kecilan untuk digunakan pribadi menggunakan php

## Cara menggunakan
<details>
    <summary> FORM</summary>

```php
    // -----------------------------------
    // init form
    // from  \App\Components\Form
    use App\Components\Form;
    // ...
    $form = new Form;
    // set action
    // by default string "/"
    $form->action = 'localhost:8080';
    // set target
    // by default string ""
    $form->target = "";
    // set method
    // by default string GET
    $form->method = "GET";
    // add input type text
    $form->field("text","Username","username");
    // add single radio
    $form->field("radio","Sure?","sure", "ya");
    // add single checkbox
    $form->field("checkbox","Sure?","sure", "ya");
    // add inline with multi radio
    $form->radio("Are You Sure","sure",null,['1'=>'Ya','2' => 'No']);
    // add inline with multi checkbox
    $form->checkbox("Are You Sure","sure",null,['1'=>'Ya','2' => 'No']);
    // add select
    $form->select("Choose your favorite color","favorite_color",['1'=>'red','2' => 'yellow','3' => 'green']);
    // add button
    $form->button("Submit","submit");

    return $form;
    // -----------------------------------
    // init form
    // from  \App\Components\Form
    $form = new Form;
    // make form 2 or more column in single page
    $form->column(function($form){
        $form->field("text","Username","username");
    }); 
    $form->column(function($form){
        $form->field("password","Password","password");
    });
    return $form;

```
</details>


<details>
    <summary> TABS</summary>

```php
    // init form
    // from  \App\Components\Tab
    use App\Components\Tab;
    // ...
    $tabs = new Tab;
    
    // parameter GET active tab id
    // from label => strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $label));
    // $label , \Closure $callback
    $tabs->add('Form 1',function(){
        $form = new Form;
        $form->field("text","Username","username");
        return $form->render();
    });

    $tabs->add('Form 2',function(){
        $form = new Form;
        $form->field("text","Username","username");
        return $form->render();
    });
    return $tabs;

```
</details>


<details>
    <summary> CARD</summary>

```php
    
    use App\Components\Card;
    // ...

    $card = new Card;

    $card->setTitle('Data User');
    $card->setDescription('List data user');
    $card->setBody(function(){
        // init form
        $form = new Form;
        $form->field("password","Password","password");
        return $form->render();
    });

    return $card;

```
</details>



<details>
    <summary> COLUMN</summary>

```php
    use App\Components\Column;
    // ...

    $col = new Column;
    $col->add(function(){
        $form = new Form;
        $form->field("password","Password","password");
        return $form->render();
    });
    return $col;

```
</details>