<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/index');
    }

    public function show($id)
    {
        return Inertia::render('Inertia/Show',[
            'id' => $id
        ]);
    }
}
