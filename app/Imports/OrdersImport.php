<?php

namespace App\Imports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;

//class OrdersImport implements ToModel, WithUpserts, WithHeadingRow
//{
//    /**
//    * @param array $row
//    *
//    * @return \Illuminate\Database\Eloquent\Model|null
//    */
//    public function model(array $row) {
//        return new Order([
//            'tracking_code' => $row['tracking_code']
//        ]);
//    }
//
//    public function uniqueBy()
//    {
//        // TODO: Implement uniqueBy() method.
//        return 'order_num';
//    }
//}

class OrdersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $detail = Order::find($row['id']);
            $detail->tracking_code = $row['tracking_code'];
            $detail->save();

        }
    }
}



