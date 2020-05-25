<?php

namespace Mindyourteam\Work\Controllers;

use App\Http\Controllers\Controller;
use Mindyourteam\Work\Models\Topic;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::whereDoesntHave('users', function ($query)
        {
            $query->where('hidden', 1);
        })
            ->inRandomOrder()
            ->limit(3)->get();
        return view('work::home', ['topics' => $topics]);
    }
}
