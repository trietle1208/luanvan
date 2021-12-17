<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CatePosts;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\DanhMuc;
use App\Models\DetailPara;
use App\Models\Product;
use App\Models\ReceiptDetail;
use App\Models\View;
use App\Models\Voucher;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private $sum_price = 0, $arr = [];

    public function detail(Request $request, $ncc,$slug) {
        $url = $request->url();
        $id_customer = Session::get('customer_id');
        $customer = Customer::find($id_customer);
        $wishlist = Wishlist::where('kh_id',$id_customer)->get();
        $count_wistlist = $wishlist->count();
        $quantityProduct = 0;
        $count = 0;
        $star_1 = 0;
        $star_2 = 0;
        $star_3 = 0;
        $star_4 = 0;
        $star_5 = 0;
        $cateposts = CatePosts::all();
        $categories = DanhMuc::all();
        $brands = Brand::all();
        $product = Product::where('sp_slug',$slug)->first();
        $productRecomments = Product::where('dm_id',$product->dm_id)->where('sp_trangthai',1)->take(6)->get();
        $receiptdetail = ReceiptDetail::where('sp_id',$product->sp_id)->orderBy('created_at','DESC')->first();
        $paradetail = DetailPara::where('sp_id',$product->sp_id)->get();
        $quantityProduct = $receiptdetail->soluong;
        $comments = Comment::where('sp_id',$product->sp_id)->where('bl_idcha','=',null)->where('trangthai',1)->get();
        $session = $request->getSession()->getId();
        $check = View::where('sp_id',$product->sp_id)->where('session',$session)->first();
        $voucher = Voucher::where('ncc_id',$product->ncc->ncc_id)->get();
        if($check == null){
            $view = View::create([
                'sp_id' => $product->sp_id,
                'view' => 1,
                'session' => $session,
            ]);
        }
        $view = View::where('sp_id',$product->sp_id)->count();
        foreach ($product->comment as $comment){
            if($comment['bl_sosao'] != null){
                $count++;
            }
            if($comment['bl_sosao'] == 1){
                $star_1++;
            }
            if($comment['bl_sosao'] == 2){
                $star_2++;
            }
            if($comment['bl_sosao'] == 3){
                $star_3++;
            }
            if($comment['bl_sosao'] == 4){
                $star_4++;
            }
            if($comment['bl_sosao'] == 5){
                $star_5++;
            }
        }
        if(!empty($comments)){
            Carbon::setLocale('vi');
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            return view('home.product.detail',
            compact('url','count_wistlist','voucher','categories','brands','product','quantityProduct','productRecomments','comments','now','cateposts','view','count','star_1','star_2','star_3','star_4','star_5'));
        }else{
            return view('home.product.detail',
            compact('url','count_wistlist','voucher','categories','brands','product','quantityProduct','productRecomments','cateposts','view','count','star_1','star_2','star_3','star_4','star_5'));

        }
    }

    public function ajaxQty(Request $request) {
        if($request->id && $request->qty) {
            $quantityProduct = 0;
            $receiptdetail = ReceiptDetail::where('sp_id',$request->id)->orderBy('created_at','DESC')->first();
            $quantityProduct = $receiptdetail->soluong;
            if($request->qty > $quantityProduct) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Vui lòng nhập số lượng thấp hơn số lượng tồn trong kho!',
                    'qty' => $quantityProduct,
                ]);
            }
        }
    }

    public function showCart(Request $request) {
        // Session::forget('cart');
        $url = $request->url();
        $id_customer = Session::get('customer_id');
        $customer = Customer::find($id_customer);
        $wishlist = Wishlist::where('kh_id',$id_customer)->get();
        $count_wistlist = $wishlist->count();
        $arr_voucher = [];
        $arr_voucher_sort1 = [];
        $totalDiscount = 0;
        $carts = Session::get('cart');
        // dd($carts);
        $cateposts = CatePosts::all();
        if(isset($carts)) {
            foreach ($carts as $key => $cart) {
                $subtotal = 0;
                foreach ($cart as $key1 => $product) {
                    if ($key1 != 0) {
                        $subtotal += $product['total'];
                    } else {
                        if (count($product) > 0) {
                            $totalDiscount += $product['voucherPrice'];
                        }
                    }
                }
                $vouchers = Voucher::where('ncc_id', $key)->where('mgg_soluong', '>', 0)->get();
                foreach ($vouchers as $voucher) {
                    if ($subtotal >= $voucher->mgg_dieukien) {
                        $arr_voucher[$key][] = $voucher->toArray();
                    }
                }
            }
            $totalCart = 0;
            foreach ($carts as $cart) {
                foreach ($cart as $key => $product) {
                    if ($key == 0) continue;
                    $totalCart += $product['total'];
                }
            }
            $totalCart = $totalCart - $totalDiscount;
            if(!empty($arr_voucher)){
                foreach ($arr_voucher as $key1 => $row) {
                    $arr_voucher_sort = [];
                    foreach ($row as $key => $item) {
                        $arr_voucher_sort[] = $row[$key];
                    }
                    usort($arr_voucher_sort, function ($a, $b) {
                        return $a['mgg_sotiengiam'] < $b['mgg_sotiengiam'] ? 1 : -1;
                    });
                    $arr_voucher_sort1[$key1] = $arr_voucher_sort;
                }
                return view('home.product.cart.index', compact('url','count_wistlist','arr_voucher_sort1', 'totalDiscount', 'totalCart','cateposts'));
            }else{
                return view('home.product.cart.index', compact('url','count_wistlist','totalDiscount', 'totalCart','cateposts'));
            }
        }else{
            return view('home.product.cart.empty',compact('url','count_wistlist','cateposts'));
        }
    }
    public function addCart(Request $request) {
        $qty_kho = ReceiptDetail::where('sp_id',$request->id)->orderBy('created_at','DESC')->first();
        $product = Product::findOrFail($request->id);
        $price = $product->price()->first();
        $price_discount = $price->pivot->giabanra;
        $id_discount = 0;
        if(isset($product->discount->km_ten)){
            $price_discount = $price->pivot->giabanra - ($price->pivot->giabanra*$product->discount->km_giamgia)/100;
            $id_discount = $product->discount->km_id;
        }
        $session_cart = Session::get('cart');
        if(isset($session_cart[$request->ncc_id][$request->id])) {
            if($session_cart[$request->ncc_id][$request->id]['qty'] + $request->qty > $qty_kho->soluong){
                return response()->json([
                    'code' => 400,
                    'message' => 'success',
                    'count' => $qty_kho->soluong - $session_cart[$request->ncc_id][$request->id]['qty'],
                ]);
            }else{
                if($request->qty == 1) {
                    $session_cart[$request->ncc_id][$request->id]['qty'] = $session_cart[$request->ncc_id][$request->id]['qty'] + 1;
                }else {
                    $session_cart[$request->ncc_id][$request->id]['qty'] = $session_cart[$request->ncc_id][$request->id]['qty'] + $request->qty;
                }
                $session_cart[$request->ncc_id][$request->id]['total'] = $session_cart[$request->ncc_id][$request->id]['total'] + ($request->qty * $session_cart[$request->ncc_id][$request->id]['price_discount']);
            }
        }else {
            $session_cart[$request->ncc_id][$request->id] = [
                'name' => $product->sp_ten,
                'price' => $price->pivot->giabanra,
                'price_discount' => $price_discount,
                'id_discount' => $id_discount,
                'image' => $product->sp_hinhanh,
                'slug' => $product->sp_slug,
                'qty' => $request->qty,
                'total' => $request->qty * $price_discount,
                'name_ncc' => $product->ncc->ncc_ten,
            ];
            $session_cart[$request->ncc_id][0] = [];
        }
        Session::put('cart',$session_cart);
        $count_cart = 0;
        foreach ($session_cart as $key => $ncc){
            foreach ($ncc as $key1 => $item){
                if($key1 != 0){
                    $count_cart++;
                }
            }
        }
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'count_cart' => $count_cart,
        ],200);
    }

    public function updateCart(Request $request) {
        $carts = Session::get('cart');
        $carts[$request->id_ncc][$request->id]['qty'] = $request->qty;
        $carts[$request->id_ncc][$request->id]['total'] = $carts[$request->id_ncc][$request->id]['price_discount'] * $request->qty;
        Session::put('cart',$carts);
        $total = 0;
        $subtotal = 0;
        $voucher_price = 0;
        foreach (Session::get('cart') as $cart) {
            foreach ($cart as $key => $product) {
                if($key != 0) {
                    $subtotal += $product['total'];
                }else if($key == 0 && count($product) > 0){
                    $voucher_price += $product['voucherPrice'];
                }
            }
        }
        $total = $subtotal - $voucher_price;
        return response()->json([
            'code' => 200,
            'total_product' => number_format($carts[$request->id_ncc][$request->id]['total']),
            'subtotal' => number_format($subtotal),
            'total' => number_format($total),
            'total1' => $total,
        ],200);
    }

    public function deleteCart($rowId, Request $request) {

        $carts = Session::get('cart');
        if(($carts[$request->idNCC][0]) != null){
            return response()->json([
                'code' => 500,
            ]);
        }else{
            unset($carts[$request->idNCC][$rowId]);
            $output = '';
            if(count($carts[$request->idNCC]) <= 1){
                unset($carts[$request->idNCC]);
            }
            Session::put('cart', $carts);
            
            $carts = Session::get('cart');
            // dd($carts);
            if (count($carts) <= 0) {
                Session::flush();
                return response()->json([
                    'code' => 400,
                    'url' => route('trangchu'),
                ]);
            }
            else
            {
                $total = 0;
                $check = 0;
                $discount = 0;
                foreach (Session::get('cart') as $key1 => $cart){
                    $subtotal = 0;
                    if($key1 == $request->idNCC){
                        $check = 1;
                    }
                    foreach ($cart as $key => $item){
                        if($key != 0) {
                            $subtotal += $item['total'];
                        }else if($key == 0 && count($item) > 0) {
                            $discount += $item['voucherPrice'];
                        }
                    }
                    $total += $subtotal;
                }
                $total = $total - $discount;
                $subtotal = $total + $discount;
                $count_cart = 0;
                foreach ($carts as $key => $ncc){
                    foreach ($ncc as $key1 => $item){
                        if($key1 != 0){
                            $count_cart++;
                        }
                    }
                }
                return response()->json([
                    'code' => 200,
                    'total' => number_format($total),
                    'subtotal' => number_format($subtotal),
                    'discount' => number_format($discount),
                    'check' => $check,
                    'output' => $output,
                    'count_cart' => $count_cart,
                ],200);
            }
        }
        
    }

    public function showVoucher(Request $request){
        $carts = Session::get('cart');
        $subtotal = 0;
        $arr_voucher = [];
        $arr_voucher_sort = [];
        $ncc_id = $request->key;
        
        foreach ($carts[$request->key] as $key => $item){
            if($key != 0){
                $subtotal += $item['total'];
            }
        }

        $vouchers = Voucher::where('ncc_id',$request->key)->get();
        foreach($vouchers as $voucher){
            if($voucher){
                if ($subtotal >= $voucher->mgg_dieukien) {
                    $arr_voucher[] = $voucher->toArray();
                }
            }
        }

        foreach ($arr_voucher as $key => $row) {
            $arr_voucher_before[] = $row;
            usort($arr_voucher_before, function ($a, $b) {
                return $a['mgg_sotiengiam'] < $b['mgg_sotiengiam'] ? 1 : -1;
            });
        }
        $arr_voucher_sort[] = $arr_voucher_before;
        return response()->json([
            'code' => 200,
            'output' => view('home.product.cart.show-voucher',compact('arr_voucher_sort','ncc_id'))->render(),
        ]);
    }

    public function addVoucher(Request $request){
        $subtotal = 0;
        $carts = Session::get('cart');
        foreach($carts[$request->key] as $key => $item){
            if($key != 0){
                $subtotal += $item['total'];
            }
        }
        $voucher = Voucher::findOrFail($request->id);
        if($voucher->mgg_soluong > 0) {
            $total_discount = $voucher->mgg_sotiengiam;
            if($voucher->mgg_hinhthuc == 1){
                $total_discount = ($subtotal*$voucher->mgg_sotiengiam)/100;
            }
            $carts[$request->key][0] = [
                'id' => $request->id,
                'name' => $voucher->mgg_ten,
                'code' => $voucher->mgg_macode,
                'desc' => $voucher->mgg_mota,
                'type' => $voucher->mgg_hinhthuc,
                'voucherPrice' => $total_discount,
                'voucherCondition' => $voucher->mgg_dieukien,
            ];
            Session::put('cart',$carts);
        }
        $totalDiscount = 0;
        $carts = Session::get('cart');
        foreach ($carts as $cart) {
            foreach ($cart as $key => $item) {
                if ($key == 0 && count($item) > 0) {
                    $totalDiscount += $item['voucherPrice'];
                }
            }
        }
        $totalCart = 0;

        foreach ($carts as $cart) {
            foreach ($cart as $key => $product) {
                if($key == 0) continue;
                $totalCart += $product['total'];
            }
        }
        $totalCart = $totalCart - $totalDiscount;
        return response()->json([
            'code' => 200,
            'message' => 'Bạn đã thêm mã giảm giá thành công',
            'name' => $voucher->mgg_ten,
            'code_voucher' => $voucher->mgg_macode,
            'desc' => $voucher->mgg_mota,
            'total_discount' => number_format($totalDiscount),
            'total' => number_format($totalCart),
        ]);
    }
    public function deletedVoucher(Request $request) {
        $carts = Session::get('cart');
        $carts[$request->key][0] = [];
        Session::put('cart',$carts);
        $totalDiscount = 0;
        $totalPrice = 0;
        $carts = Session::get('cart');
        foreach ($carts as $cart) {
            foreach ($cart as $key => $item) {
                if ($key == 0 && count($item) > 0) {
                    $totalDiscount += $item['voucherPrice'];
                }
                else if ($key != 0){
                    $totalPrice += $item['total'];
                }
            }
        }
        $totalCart = 0;
        foreach ($carts as $cart) {
            foreach ($cart as $key => $product) {
                if($key == 0) continue;
                $totalCart += $product['total'];
            }
        }
        $totalCart = $totalCart - $totalDiscount;
        
        return response()->json([
            'code' => 200,
            'message' => 'Bạn đã hủy mã giảm giá thành công',
            'total_discount' => number_format($totalDiscount),
            'total' => number_format($totalCart),
        ],200);
    }
}
