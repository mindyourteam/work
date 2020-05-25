<?php

namespace Mindyourteam\Work\Controllers;

use Mindyourteam\Work\Requests\TopicRequest;
use Mindyourteam\Work\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Knowfox\Crud\Services\Crud;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    protected $crud;

    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
        $this->crud->setup('crud.topic');
    }

    public function index(Request $request)
    {
        return $this->crud->index($request);
    }

    public function create()
    {
        return $this->crud->create();
    }

    public function store(TopicRequest $request)
    {
        list($topic, $response) = $this->crud->store($request);
        return $response;
    }

    public function edit(Topic $topic)
    {
        return $this->crud->edit($topic);
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        return $this->crud->update($request, $topic);
    }

    public function destroy(Topic $topic)
    {
        return $this->crud->destroy($topic);
    }

    public function hide(Topic $topic)
    {
        $topic->users()->sync([Auth::id() => ['hidden' => true]]);
        return response()->redirectToRoute('work');
    }

    public function count(Topic $topic)
    {
        $topic->increment('count');
        return response()->redirectToRoute('work');
    }
}
