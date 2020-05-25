<?php
use App\User;

return [
    'deletes' => true,
    'is_admin' => true,
    'model' => User::class,
    'entity_name' => 'user',
    'entity_title' => ['r Nutzer', 'Nutzer'], // singular, plural
    'order_by' => 'name',

    'columns' => [
        'name' => 'Name',
        'email' => 'E-Mail',
    ],

    'fields' => [
        'name' => 'Name',
        'email' => 'E-Mail',
    ],
];