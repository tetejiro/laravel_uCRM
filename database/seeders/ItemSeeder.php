<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Items')->insert([
            [
                'id' => '1',
                'name' => 'カット',
                'memo' => 'カット詳細',
                'price' => 6000
            ],
            [
                'id' => '2',
                'name' => 'カラー',
                'memo' => 'カラー詳細',
                'price' => 8000
            ],
            [
                'id' => '3',
                'name' => 'パーマ',
                'memo' => 'パーマ詳細',
                'price' => 13000
            ]
        ]);
    }
}
