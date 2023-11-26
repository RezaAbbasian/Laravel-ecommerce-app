<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function query()
    {
        return Order::query()->where('status', $this->status);
    }

    use Exportable;

    public function headings(): array
    {
        return [
            'id',
            'order_num',
            'tracking_code',
            'total',
            'status',
        ];
    }

    public function map($order): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            [
                $order->id,
                $order->order_num,
                $order->tracking_code,
                $order->total,
                $order->status
            ]
        ];
    }




}
