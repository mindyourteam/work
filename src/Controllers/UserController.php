<?php

namespace Mindyourteam\Work\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Knowfox\Crud\Services\Crud;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $crud;

    public function __construct(Crud $crud)
    {
        $this->crud = $crud;
        $this->crud->setup('crud.user');
    }

    public function index(Request $request)
    {
        return $this->crud->index($request);
    }

    public function create()
    {
        return $this->crud->create();
    }

    public function store(UserRequest $request)
    {
        list($user, $response) = $this->crud->store($request);
        return $response;
    }

    public function edit(User $user)
    {
        return $this->crud->edit($user);
    }

    public function update(UserRequest $request, User $user)
    {
        return $this->crud->update($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->crud->destroy($user);
    }
}
