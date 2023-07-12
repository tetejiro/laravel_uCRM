<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;
use App\Http\Requests\InertiaTestValidation;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/index', [
            'records' => InertiaTest::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Inertia/Create');
    }

    public function show($id)
    {
        return Inertia::render('Inertia/Show',[
            'id' => $id,
            'record' => InertiaTest::findOrFail($id)
        ]);
    }

    public function store(InertiaTestValidation $request)
    {
        $validated = $request->validated();
        $InertiaTest = new InertiaTest();
        $InertiaTest->title = $validated['title'];
        $InertiaTest->content = $validated['content'];
        $InertiaTest->save();

        return to_route('inertia.index')->with([
            'message' => '登録しました'
        ]);
    }

    public function delete($id)
    {
        $record = InertiaTest::findOrFail($id);
        $record->delete();
        return to_route('inertia.index')->with(['message' => '削除完了']);
    }
}