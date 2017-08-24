<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Knowfox\Crud\Controllers\CrudController;

class UserController extends CrudController
{
    public function __construct()
    {
        $this->setup = (object)[
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
    }

    public function create()
    {
        return $this->createCrud();
    }

    public function store(UserRequest $request)
    {
        $request->password = bcrypt($request->password);
        list($ride, $response) = $this->storeCrud($request);
        return $response;
    }

    public function edit(User $user)
    {
        return $this->editCrud($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $request->password = bcrypt($request->password);
        return $this->updateCrud($request, $user);
    }

    public function destroy(User $user)
    {
        return $this->destroyCrud($user);
    }
}
