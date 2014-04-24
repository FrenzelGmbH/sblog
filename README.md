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
