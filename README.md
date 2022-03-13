
<h1>Laravel Model Audit</h1>

<h3 style="color:yellow">Warning: this is still in beta. So you may encounter problems.</h3>
<h3 style="color:yellow">This is just a side project soo updates may come rare.</h3>

<h3>Installation</h3>

```
composer require weblynx/laravel-model-audit
```


<h3>After installing run</h3>

```
php artisan migrate
```

<hr>

<h3>Lifecycle events available:</h3>
<ul>
    <li>created</li>
    <li>updated</li>
    <li>deleted</li>
    <li>restored</li>
    <li>soft-deleted</li>
    <li>force-deleted</li>
</ul>

<hr>
<h3>Publish vendor file</h3>
```
php artisan vendor:publish
```
<hr>
<h3>Inside of config you will find an auditor.php file.</h3>
<h4>You can disable any of events globally by commenting the line.</h4>

```php
<?php

return [
    'options' => [
        'created',
        'updated',
//        'deleted',
        'restored',
        'soft-deleted',
        'force-deleted'
    ]
];
```
<hr>

<h3>Traits</h3>

<h2>WithAuditor</h2>
<p>WithAuditor is used to activate th events of the package. Use it on model you want to be audited.</p>

```php 
class Model {
    use WithAuditor;
}
```


<h2>HasManyAudits</h2>
<p>HasManyAudits returns a hasMany relationship on the model that has created models.</p>

```php 
class Model {
    use HasManyAudits;
}
```

<hr>
<h3>Model</h3>

```php 
class Auditor
```

Auditor class has a dynamic belongsToRelationship based on the provider defined in config.
Ex:

Will return a belongsTo relationship with the name: user().

```php 
 'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

```

Next steps:
<ul>
    <li>Add fields that can be excluded from model.</li>
    <li>Add unit testing.</li>
</ul>
