<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Knowfox\Crud\Controllers\CrudController;

class TopicController extends CrudController
{
    public function __construct()
    {
        $this->setup = (object)[
            'deletes' => true,
            'model' => Topic::class,
            'entity_name' => 'topic',
            'entity_title' => ['s Thema', 'Themen'],
            'order_by' => 'title',

            'columns' => [
                'title' => 'Titel',
            ],

            'fields' => [
                'title' => [
                    'label' => 'Titel',
                    'type' => 'textarea',
                ]
            ]
        ];
    }

    public function create()
    {
        return $this->createCrud();
    }

    public function store(TopicRequest $request)
    {
        list($ride, $response) = $this->storeCrud($request);
        return $response;
    }

    public function edit(Topic $topic)
    {
        return $this->editCrud($topic);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        return $this->updateCrud($request, $topic);
    }

    public function destroy(Topic $topic)
    {
        return $this->destroyCrud($topic);
    }
}
