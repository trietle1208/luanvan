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
        $orders = OrderNCC::all();
        foreach ($orders as $item){
            if($item->trangthai == 4){
                OrderNCC::find($item->dhncc_id)->update([
                    'trangthai' => 5,
                    'thoigiannhanhang' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                $order_ncc = OrderNCC::find($item->dhncc_id);
                $count = 0;
                $check = 0;
                $orderAdmin = Order::find($order_ncc->dh_id);
                foreach ($orderAdmin->orderNCC as $item){
                    $count++;
                    if($item->trangthai == 5){
                        $check++;
                    }
                }
                if($count == $check) {
                    $orderAdmin->update([
                        'dh_trangthai' => 3,
                        'dh_thoigiannhanhang' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
