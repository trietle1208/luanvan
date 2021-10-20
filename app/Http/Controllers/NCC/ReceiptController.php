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
use Illuminate\Support\Facades\DB;
class ReceiptController extends Controller
{
    private $receipt;
    private $product;
    private $category;
    private $brand;
    private $type;
    private $receiptdetail;

    public function __construct(Receipt $receipt, Product $product, DanhMuc $category, Brand $brand, TypeProduct $type, ReceiptDetail $receiptdetail)
    {
        $this->receipt = $receipt;
        $this->product = $product;
        $this->category = $category;
        $this->brand = $brand;
        $this->type = $type;
        $this->receiptdetail = $receiptdetail;
        $this->middleware(['permission:Add Receipt'])->only(['create']);
        $this->middleware(['permission:Edit Receipt'])->only(['edit']);
        $this->middleware(['permission:Delete Receipt'])->only(['delete']);
    }

    public function index()
    {
        $receipts = $this->receipt->where('ncc_id', Auth::user()->ncc->ncc_id)->get();

        return view('admin.nhacungcap.receipt.index', compact('receipts'));
    }

    public function create()
    {
        $products = $this->product->where('ncc_id', Auth::user()->ncc->ncc_id)->get();
        $categories = $this->category->all();
        $brands = $this->brand->all();
        $types = $this->type->all();

        return view('admin.nhacungcap.receipt.create', compact('products', 'categories', 'brands', 'types'));
    }

    public function selectCate(Request $request)
    {
        $check = '';
        $quantity = '';
        $quantityPN = '';
        $price = '';
        $output = '';
        $arr_product = Session::get('product');

        if ($request->param == 'brand') {
            $products = $this->product->where('th_id', $request->id)->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        } else if($request->param == 'cate'){
            $products = $this->product->where('dm_id', $request->id)->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        } else {
            $products = $this->product->where('sp_ten','like','%'.$request->name.'%')->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        }
        if ($products) {
            if (count($products) > 0) {
                foreach ($products as $key => $product) {

                    if (isset($arr_product[$product->sp_id])) {
                        $check = 'checked';
                        $quantity = $arr_product[$product->sp_id]['quantity'];
                        $price = $arr_product[$product->sp_id]['price'];
                    } else {
                        $check = '';
                        $quantity = '';
                        $price = '';
                    }
                    $output .= '<div class="row"><div class="col-6 product-box"><input ' . $check . ' type="checkbox" class="product" data-id="' . $key . '">' . $product->sp_ten . '</input><br>
                    <span>Số lượng còn trong kho : '.$product->sp_soluong.'</span><br>
                    <input type="hidden" name="product[]" value="' . $product->sp_id . '">
                    <label>Số lượng: </label><br><input type="text" class="quantity" name="quantity[]" value="' . $quantity . '" data-id="' . $key . '" readonly><br>
                    <label>Giá gốc: </label><br><input type="text" class="price" name="price[]" value="' . $price . '" data-id="' . $key . '" readonly></div>
                     <div class="col-6"><img src="' . $product->sp_hinhanh . '" style="height: 150px; width: 200px"></div></div>';
                }
                $output .= '<div class="row">
                            <div class="col-4"><button type="button" class="btn btn-success addProduct" >Thêm</button></div>
                        </div>';
            } else {
                $output .= '<span>Không tìm thấy sản phẩm</span>';
            }
        }
        return response()->json($output);
    }

    public function addProduct(Request $request)
    {
        if ($request->arr_quantity && $request->arr_price && $request->arr_idsp) {
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
            return response()->json([
                'sum' => number_format($sum),
                'product' => $product_get,
            ]);
        }
    }

    public function checkQuantity(Request $request)
    {
        if ($request->idsp && $request->soluong) {
            $product = $this->product->find($request->idsp);
            if ($product) {
                $check = 0;
                if ($product->sp_soluong >= $request->soluong) {
                    $check = 1;
                }
                return response()->json($check);
            }
        }
    }

    public function store(Request $request)
    {
//        dd(Session::get('product'));
        //Session::forget('product');
        $data = [
            'pnh_ten' => $request->name,
            'pnh_tongcong' => $request->sum,
            'nguoilapphieu_id' => Auth::id(),
            'ncc_id' => Auth::user()->ncc->ncc_id,
        ];

        $phieunhap = $this->receipt->create($data);

        $chitiet = Session::get('product');
        if ($chitiet) {
            foreach ($chitiet as $item) {
                $product = Product::find($item['id']);
                $this->receiptdetail->create([
                    'sp_id' => $item['id'],
                    'pnh_id' => $phieunhap->pnh_id,
                    'soluong' => $item['quantity'],
                    'soluonggoc' => $item['quantity'],
                    'giagoc' => $item['price'],
                    'giabanra' => $product->sp_giabanra,
                ]);
            }
            Session::forget('product');
        }
        return back();
    }

    public function modalAjax(Request $request)
    {
        if ($request->id) {
            $receipt = $this->receipt->find($request->id);
            return view('admin.nhacungcap.receipt.chitiet',compact('receipt'))->render();
        }
    }

    public function select(Request $request){
       $products = Product::where('ncc_id',$request->id)->get();
       return response()->json([
          'code' => 200,
          'output' => view('admin.nhacungcap.receipt.select',compact('products'))->render(),
       ],200);
    }

    public function add(Request $request){
        if($request){
            $product = Product::find($request->id);
            $session = Session::get('product');
            $sum = 0;
                if (!isset($session[$request->id])) {
                    $session[$request->id] = [
                        'id' => $request->id,
                        'quantity' => $request->qty,
                        'price' => $request->price,
                        'total' => $request->qty * $request->price,
                    ];
                }
            Session::put('product', $session);
            $session_product = Session::get('product');
            foreach ($session_product as $item){
                $sum += $item['total'];
            }
            $name = '<strong class="text-primary">'.$product->sp_ten.'</strong><br>';
            return response()->json([
                'code' => 200,
                'sum' => number_format($sum),
                'name' => $name,
                'qty' => $request->qty,
                'price' => number_format($request->price),
            ]);
        }
    }

    public function deleteProduct(Request $request){
        if($request->id){
            $sum =0;

            $session = Session::get('product');
            unset($session[$request->id]);
            Session::put('product',$session);

            $session_new = Session::get('product');
            foreach ($session_new as $item){
                $sum += $item['total'];
            }

            return response()->json([
                'code' => 200,
                'sum' => number_format($sum),
            ],200);
        }

    }

    public function edit($id){
        $receipt = Receipt::find($id);
        return view('admin.nhacungcap.receipt.edit',compact('receipt'));
    }

    public function update(Request $request,$id){
        Receipt::find($id)->update([
            'pnh_ten' => $request->name,
        ]);

        return redirect()->route('sup.receipt.list');
    }
    public function listProductReceipt(Request $request){
        $receipt = Receipt::find($request->id);
        return response()->json([
           'code' => 200,
           'output' => view('admin.nhacungcap.receipt.chitietchinhsua',compact('receipt'))->render(),
        ]);
    }

    public function saveUpdateProductReceipt(Request $request){
        $sum = 0;
        $receipt_detail = ReceiptDetail::find($request->idReceiptDetail)->update([
            'soluong' => $request->qty,
            'soluonggoc' => $request->qty,
            'giagoc' => $request->price,
        ]);
        $receipt = Receipt::find($request->idReceipt);
        foreach ($receipt->receipt_detail as $detail) {
            $sum += $detail->giagoc * $detail->soluong;
        }
        $receipt = Receipt::find($request->idReceipt)->update([
           'pnh_tongcong' => number_format($sum),
        ]);

        return response()->json([
           'code' => 200,
           'sum' => number_format($sum),
        ]);
    }

    public function delete(Request $request){
        $receipt = Receipt::find($request->id);

        foreach ($receipt->receipt_detail as $detail){
            ReceiptDetail::find($detail->ctpn_id)->delete();
        }

        $receipt = Receipt::find($request->id)->delete();

        return response()->json([
            'code' => 200,
        ]);
    }
}
