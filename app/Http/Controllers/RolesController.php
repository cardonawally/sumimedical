<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RolesController extends Controller
{
    public function view_roles(): \Inertia\Response
    {
        return Inertia::render('Applications/Roles');

    }
}
