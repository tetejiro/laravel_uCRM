<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DecileService
{
  public static function decile($subQuery)
  {
    $subQuery = DB::table($subQuery)
      ->groupBy('id')
      ->select('id', 'customer_id', 'customer_name', DB::raw('sum(subtotal) as totalPerPurchase'));

    $subQuery = DB::table($subQuery)
      ->groupBy('customer_id')
      ->orderBy('total', 'desc')
      ->select('customer_id', 'customer_name', DB::raw('sum(totalPerPurchase) as total'));

    DB::statement('set @row_num = 0');
    $subQuery = DB::table($subQuery)
      ->select(
        'customer_id',
        'customer_name',
        'total',
        DB::raw('@row_num:= @row_num+1 as row_num')
      );

    $count = $subQuery->count();
    $total = DB::table($subQuery)->select(DB::raw('sum(total) as total'))->get();
    $total = $total[0]->total;

    $decile = ceil($count / 10);

    $bindValues = [];
    $tempValue = 0;

    for ($i = 0; $i < 10; $i++) {
      array_push($bindValues, 1 + $tempValue);
      $tempValue += $decile;
      array_push($bindValues, 1 + $tempValue);
    }

    // TODO : select, DB::raw() で書き直す
    DB::statement('set @row_num = 0;');
    $subQuery = DB::table($subQuery)
      ->selectRaw("
        row_num,
        customer_id,
        customer_name,
        total,
        case
        when ? <= row_num and row_num < ? then 1
        when ? <= row_num and row_num < ? then 2
        when ? <= row_num and row_num < ? then 3
        when ? <= row_num and row_num < ? then 4
        when ? <= row_num and row_num < ? then 5
        when ? <= row_num and row_num < ? then 6
        when ? <= row_num and row_num < ? then 7
        when ? <= row_num and row_num < ? then 8
        when ? <= row_num and row_num < ? then 9
        when ? <= row_num and row_num < ? then 10
        end as decile
      ", $bindValues);

    $subQuery = DB::table($subQuery)
      ->groupBy('decile')
      ->select('decile', DB::raw('round(avg(total)) as average, sum(total) as totalPerGroup'));


    DB::statement("set @total = {$total} ;");
    $data = DB::table($subQuery)
      ->selectRaw('decile,
        average,
        totalPerGroup,
        round(100 * totalPerGroup / @total, 1) as
        totalRatio
      ')
      ->get();

    $labels = $data->pluck('decile');
    $totals = $data->pluck('totalPerGroup');

    return [$data, $labels, $totals];
  }
}
