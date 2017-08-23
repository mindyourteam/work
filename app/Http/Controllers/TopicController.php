<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Knowfox\Crud\Controllers\CrudController;

class TopicController extends CrudController
{
    public function __construct()
    {
        $this->setup = (object)[
            //'deletes' => true,
            'model' => Topic::class,
            'entity_name' => 'topic',
            'entity_title' => ['s Thema', 'Themen'],
            'order_by' => 'count|desc',

            'columns' => [
                'count' => 'Schmerzen',
                'title' => 'Titel',
            ],

            'fields' => [
                'count' => [
                    'label' => 'Schmerzen',
                    'type' => 'number',
                ],
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

    public function hide(Topic $topic)
    {
        $topic->users()->sync([Auth::id() => ['hidden' => true]]);
        return response()->redirectToRoute('home');
    }

    public function count(Topic $topic)
    {
        $topic->increment('count');
        return response()->redirectToRoute('home');
    }
}
