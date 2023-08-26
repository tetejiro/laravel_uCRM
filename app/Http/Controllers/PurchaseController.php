<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::groupBy('id')->selectRaw('
            id, customer_name, sum(subtotal) as total, status, created_at')->paginate(50);

        return Inertia::render('Purchases/Index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::select('id', 'name', 'price')->where('is_selling', true)->get();

        return Inertia::render('Purchases/Create', [
            'items' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();//DB::beginTransaction();
        try {
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status
            ]);

            foreach($request->items as $item)
            {
                $purchase->items()->attach($purchase->id, [
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity']
                ]);
            }
            DB::commit();

            return to_route('dashboard');
            } catch(\Exception $e){
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $all = Order::where('id', $purchase['id'])->get();
        $subtotal = $all->pluck('subtotal');

        return Inertia::render('Purchases/Show', [
            'all' => $all,
            'subtotal' => $subtotal
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $itemId = Item::select('id')->pluck('id');

        $purchase = Purchase::find($purchase->id); // 購買Idで指定
        $allItems = Item::select('id', 'name', 'price')->get(); // 全商品を取得
        $items = []; // 空の配列を用意

        foreach($allItems as $allItem){
            $quantity = 0; // 数量初期値 0
            foreach($purchase->items as $item) { // 中間テーブルを1件ずつチェック
                if($allItem->id === $item->id) { // 同じidがあれば
                    $quantity = $item->pivot->quantity; // 中間テーブルの数量を設定 } }
                }
            }
            array_push($items, [
                'id' => $allItem->id, 'name' => $allItem->name,
                'price' => $allItem->price, 'quantity' => $quantity
            ]);
        }


        $order = Order::groupBy('id')
                            ->where('id', $purchase->id)
                            ->selectRaw('id, customer_id, customer_name, status, created_at')
                            ->get();

        return  Inertia::render('Purchases/Edit', [
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        DB::beginTransaction();

        try{
            $purchase->status = $request->status;
            $purchase->save();

            $items = [];

            foreach($request->items as $item){
                $items = $items + [
                    $item['id'] => [
                        'quantity' => $item['quantity']
                    ]
                ];
            }

            $purchase->items()->sync($items);

            DB::commit();
            return to_route('dashboard');
        } catch(\Exception $e){
            DB::rollback();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
