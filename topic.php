<?php
use Mindyourteam\Work\Models\Topic;

return [
    //'deletes' => true,
    'model' => Topic::class,
    'entity_name' => 'topic',
    'entity_title' => ['s Thema', 'Themen'],
    'order_by' => 'count|desc',

    'columns' => [
        'active' => 'Aktiv',
        'count' => 'Schmerzen',
        'title' => 'Titel',
    ],

    'fields' => [
        'active' => [
            'label' => 'Aktiv',
            'type' => 'checkbox',
            'default' => 0,
        ],
        'count' => [
            'label' => 'Schmerzen',
            'type' => 'number',
            'default' => 0,
        ],
        'title' => [
            'label' => 'Titel',
            'type' => 'textarea',
        ]
    ]
];
