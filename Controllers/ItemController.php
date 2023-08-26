<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::select('id', 'name', 'price', 'is_selling')->get();
        return inertia::render('Items/Index', [ 'items' => $items ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia::render('Items/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        Item::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'price' => $request->price
        ]);

        return to_route('Items.index')
        ->with([
            'message' => '保存完了',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $Item)
    {
        return inertia::render('Items/Show', ['Item' => $Item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $Item)
    {
        return inertia::render('Items/Edit', ['Item' => $Item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $Item)
    {
        $Item->name = $request->name;
        $Item->memo = $request->memo;
        $Item->price = $request->price;
        $Item->is_selling = $request->is_selling;
        $Item->save();

        return to_route('Items.index')->with([
            'message' => '更新完了',
            'status' => 'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $Item)
    {
        $Item->delete();

        return to_route('Items.index')->with([
            'message' => '削除しました',
            'status' => 'alerm'
        ]);
    }
}
