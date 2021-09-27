<?php

namespace App\Observers;

use App\Models\OrderDetail;
use App\Models\ReceiptDetail;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function created(OrderDetail $orderDetail)
    {
        $receiptDetail = ReceiptDetail::where('sp_id',$orderDetail->sp_id)->orderBy('created_at','DESC')->first();
        $receiptDetail->update([
            'soluong' =>  $receiptDetail->soluong - $orderDetail->soluong,
        ]);

    }

    /**
     * Handle the OrderDetail "updated" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function updated(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "deleted" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function deleted(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "restored" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function restored(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function forceDeleted(OrderDetail $orderDetail)
    {
        //
    }
}
