<?php

namespace App\Http\Controllers\NCC;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\DanhMuc;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptDetail;
use App\Models\TypeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ReceiptController extends Controller
{
    private $receipt;
    private $product;
    private $category;
    private $brand;
    private $type;
    private $receiptdetail;
    public function __construct(Receipt $receipt, Product $product, DanhMuc $category, Brand $brand, TypeProduct $type, ReceiptDetail $receiptdetail) {
        $this->receipt = $receipt;
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->type = $type;
        $this->receiptdetail = $receiptdetail;
    }

    public function index() {

    }

    public function create() {
        $products = $this->product->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        $categories = $this->category->all();
        $brands = $this->brand->all();
        $types = $this->type->all();

        return view('admin.nhacungcap.receipt.create',compact('products','categories','brands','types'));
    }

    public function selectCate(Request $request) {
        $check = '';
        $quantity = '';
        $price = '';
        $output = '';
        $arr_product = Session::get('product');


        if ($request->param == 'brand') {
            $products = $this->product->where('th_id',$request->id)->get();
        } else {
            $products = $this->product->where('dm_id',$request->id)->get();
        }
        if($products) {
            if(count($products) > 0) {
                foreach($products as $key => $product) {
                    if (isset($arr_product[$product->sp_id])) {
                        $check = 'checked';
                        $quantity = $arr_product[$product->sp_id]['quantity'];
                        $price = $arr_product[$product->sp_id]['price'];
                    } else {
                        $check = '';
                        $quantity = '';
                        $price = '';
                    }
                    $output .= '<div class="row"><div class="col-6 product-box"><input '.$check.' type="checkbox" class="product" data-id="'.$key.'">'.$product->sp_ten.' ('.$product->sp_soluong.')</input><br>
                    <input type="hidden" name="product[]" value="'.$product->sp_id.'">
                    <label>Số lượng: </label><br><input type="text" class="quantity" name="quantity[]" value="'.$quantity.'" data-id="'.$key.'" readonly><br>
                    <label>Giá gốc: </label><br><input type="text" class="price" name="price[]" value="'.$price.'" data-id="'.$key.'" readonly></div>
                     <div class="col-6"><img src="'.$product->sp_hinhanh.'" style="height: 150px; width: 200px"></div></div>';
                }
                $output .= '<div class="row">
                            <div class="col-4"><button type="button" class="btn btn-success addProduct" >Thêm</button></div>
                        </div>';
            }
            else{
                $output .= '<span>Không tìm thấy sản phẩm</span>';
            }
        }
        return response()->json($output);
    }

    public function addProduct(Request $request) {
        if($request->arr_quantity && $request->arr_price && $request->arr_idsp) {
            $product = Session::get('product');
            $sum = 0;
            foreach ($request->arr_idsp as $key => $idsp) {
                if (!isset($product[$idsp])) {
                    $product[$idsp] = [
                        'idsp' => $idsp,
                        'quantity' => $request->arr_quantity[$key],
                        'price' => $request->arr_price[$key],
                        'total' => $request->arr_quantity[$key] * $request->arr_price[$key],
                    ];
                }
            }
            Session::put('product', $product);

            $product_get = Session::get('product');
            foreach ($product_get as $item) {
                $sum += $item['total'];
            }

            return response()->json(number_format($sum));


        }
    }

    public function checkQuantity(Request $request) {

        if($request->idsp && $request->soluong) {
            $product = $this->product->find($request->idsp);
            if($product) {
                $check = 0;
                if($product->sp_soluong >= $request->soluong){
                    $check = 1;

                }
                return response()->json($check);
            }
        }
    }
    public function store(Request $request) {
        Session::forget('product');
//        $data = [
//            'pnh_ten' => $request->name,
//            'pnh_tongcong' => $request->sum,
//
//            'nguoilapphieu_id' => Auth::id(),
//            'ncc_id' => Auth::user()->ncc->ncc_id,
//        ];
//
//        $phieunhap = $this->receipt->create($data);
//
//        $chitiet = Session::get('product');
//        if($chitiet) {
//            foreach ($chitiet as $item) {
//                $this->receiptdetail->create([
//                    'sp_id' => $item['idsp'],
//                    'pnh_id' =>$phieunhap->pnh_id,
//                    'soluong' => $item['quantity'],
//                    'giagoc' => $item['price'],
//                ]);
//            }
//            Session::forget('product');
//        }
        return back();
    }
}
