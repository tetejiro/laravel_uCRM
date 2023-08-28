<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        if($request->type == 'perDay') {
            $subQuery = Order::betweenDate($request->startDate, $request->endDate)
                        ->where('status', true)
                        ->select(
                            'id',
                            'status',
                            'customer_name',
                            DB::raw('sum(subtotal) as totalPerPurchase'),
                            DB::raw('DATE_FORMAT(created_at, "%Y%m%d") as date'),
                        )->groupBy('id');

            $data = DB::table($subQuery)
                    ->select('date', DB::raw('sum(totalPerPurchase) as total'))
                    ->groupBy('date')
                    ->get();

            $labels = $data->pluck('date');
            $totals = $data->pluck('total');
        }


        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals
        ], Response::HTTP_OK);
    }
}
