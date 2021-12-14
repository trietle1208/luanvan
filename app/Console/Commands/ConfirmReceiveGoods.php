<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderNCC;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConfirmReceiveGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirm Order';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order= Order::where('dh_trangthai',3)->get();
        foreach ($order as $item){
            Order::find($item->dh_id)->update([
                'dh_trangthai' => 5,
                'dh_thoigiannhanhang' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $orders = Order::find($item->dh_id);
            foreach ($orders->orderNCC as $orderNCC){
                OrderNCC::find($orderNCC->dhncc_id)->update([
                    'trangthai' => 5,
                    'thoigiannhanhang' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            
            }
        }
    }
}
