<?php

namespace App\Observers;

use App\Models\OrderNCC;
use App\Models\Voucher;

class OrderNccObserver
{
    /**
     * Handle the OrderNCC "created" event.
     *
     * @param  \App\Models\OrderNCC  $orderNCC
     * @return void
     */
    public function created(OrderNCC $orderNCC)
    {
        if($orderNCC->mgg_id != null){
            $voucher = Voucher::find($orderNCC->mgg_id);
            $voucher_up = $voucher->update([
                'mgg_soluong' => $voucher->mgg_soluong - 1,
            ]);
        }
    }

    /**
     * Handle the OrderNCC "updated" event.
     *
     * @param  \App\Models\OrderNCC  $orderNCC
     * @return void
     */
    public function updated(OrderNCC $orderNCC)
    {
        //
    }

    /**
     * Handle the OrderNCC "deleted" event.
     *
     * @param  \App\Models\OrderNCC  $orderNCC
     * @return void
     */
    public function deleted(OrderNCC $orderNCC)
    {
        //
    }

    /**
     * Handle the OrderNCC "restored" event.
     *
     * @param  \App\Models\OrderNCC  $orderNCC
     * @return void
     */
    public function restored(OrderNCC $orderNCC)
    {
        //
    }

    /**
     * Handle the OrderNCC "force deleted" event.
     *
     * @param  \App\Models\OrderNCC  $orderNCC
     * @return void
     */
    public function forceDeleted(OrderNCC $orderNCC)
    {
        //
    }
}
