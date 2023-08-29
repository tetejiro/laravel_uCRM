<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AnalysisService
{
    public static function perDay($subQuery)
    {
      $subQuery = $subQuery
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

      return [$data, $labels, $totals];
    }


    public static function perMonth($subQuery)
    {
      $subQuery = $subQuery
        ->where('status', true)
        ->select(
          'id',
          'status',
          'customer_name',
          DB::raw('sum(subtotal) as totalPerPurchase'),
          DB::raw('DATE_FORMAT(created_at, "%Y%m") as date'),
        )->groupBy('id');

      $data = DB::table($subQuery)
        ->select('date', DB::raw('sum(totalPerPurchase) as total'))
        ->groupBy('date')
        ->get();

      $labels = $data->pluck('date');
      $totals = $data->pluck('total');

      return [$data, $labels, $totals];
    }


    public static function perYear($subQuery)
    {
      $subQuery = $subQuery
        ->where('status', true)
        ->select(
          'id',
          'status',
          'customer_name',
          DB::raw('sum(subtotal) as totalPerPurchase'),
          DB::raw('DATE_FORMAT(created_at, "%Y") as date'),
        )->groupBy('id');

      $data = DB::table($subQuery)
        ->select('date', DB::raw('sum(totalPerPurchase) as total'))
        ->groupBy('date')
        ->get();

      $labels = $data->pluck('date');
      $totals = $data->pluck('total');

      return [$data, $labels, $totals];
    }

}
