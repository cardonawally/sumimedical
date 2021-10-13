<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function view_users(): \Inertia\Response
    {
        return Inertia::render('Applications/Users');

    }
}
