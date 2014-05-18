sblog
=====

SMART WebLog Module

Installation
============

Install package via composer "frenzelgmbh/sblog": "dev-master"

Update config file *config/web.php* and *config/db.php*

```php
// app/config/web.php
return [
    'modules' => [
        'sblog' => [
            'class' => 'frenzelgmbh\sblog\Module',
            // set custom module properties here ...
        ],
    ],
];
// app/config/db.php
return [
        'class' => 'yii\db\Connection',
        // set up db info
];
```

Run migration file
php yii migrate --migrationPath=@vendor/frenzelgmbh/sblog/migrations

Widgets
=======

To use the blog, you can implement the following widgets:

Widget for Picture Links (can be used to include advertisement links)
* MODULE (e.g. STARTPAGE)
* ID (1)
* Picture (needs to be uploaded)
* Link (whatever you wanna link to)
```php 
if(class_exists('frenzelgmbh\sblog\widgets\WidgetPictureLink')){
  echo frenzelgmbh\sblog\widgets\WidgetPictureLink::widget([
    'title'=>NULL,
    'limit'=>20,
  ]); 
}
```