<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        return view('home', ['topics' => $topics]);
    }
}
