<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/index');
    }

    public function create()
    {
        return Inertia::render('Inertia/Create');
    }

    public function show($id)
    {
        return Inertia::render('Inertia/Show',[
            'id' => $id
        ]);
    }

    public function store(Request $request)
    {
        $InertiaTest = new InertiaTest();
        $InertiaTest->title = $request->title;
        $InertiaTest->content = $request->contents;
        $InertiaTest->save();

        return to_route('inertia.index');
    }
}
