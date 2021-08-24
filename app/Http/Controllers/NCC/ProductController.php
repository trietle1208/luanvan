<?php

namespace App\Http\Controllers\NCC;

use App\Component\Recusive;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\DanhMuc;
use App\Models\DetailPara;
use App\Models\Discount;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\ProductImage;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $brand;
    private $type;
    private $productImage;
    private $detail;
    private $discount;
    private $htmlSelectCate = '';
    private $htmlSelectBrand = '';
    private $htmlSelectType = '';
    public function __construct(DanhMuc $category, Product $product, Brand $brand, TypeProduct $type,
                                ProductImage $productImage, DetailPara $detail, Discount $discount) {
        $this->category = $category;
        $this->product = $product;
        $this->brand = $brand;
        $this->type = $type;
        $this->discount = $discount;
        $this->productImage = $productImage;
        $this->detail = $detail;
    }
    public function index() {
        $products = $this->product->all();
        $detail =   $this->detail->all();
        return view('admin.nhacungcap.product.index', compact('products','detail'));
    }

    public function create() {
        $htmlOption = $this->getCategory($parentId = '');
        $categories = $this->category->all();
        $brands = $this->brand->all();
        $types = $this->type->all();
        return view('admin.nhacungcap.product.create',compact('htmlOption', 'brands' ,'types'));
    }

    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusise($parentId);

        return $htmlOption;
    }

    public function store(Request $request) {
        $dataProduct = [
            'sp_ten' => $request->name,
            'sp_giabanra' => $request->price,
            'sp_soluong' => $request->quantity,
            'sp_mota' => $request->desc,
            'sp_slug' => str_slug($request->name),
            'sp_chitiet' => $request->detail,
            'sp_thoigianbaohanh'=> $request->insurance,
            'ncc_id' => Auth::user()->ncc->ncc_id,
            'th_id' => $request->brand,
            'dm_id' => $request->cate,

        ];
        $dataUpload = $this->storageTraitUpload($request, 'image', 'product');
        if(!empty($dataUpload)) {
            $dataProduct['sp_hinhanh'] = $dataUpload['file_path'];
        }
        $product = $this->product->create($dataProduct);

        if($request->hasFile('image_detail')) {
            foreach ($request->image_detail as $fileItem) {
                $dataImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                $product->images()->create([
                    'ha_ten' => $dataImageDetail['file_name'],
                    'ha_mota' => $product->sp_ten,
                    'ha_duongdan' => $dataImageDetail['file_path'],
                ]);
            }
        }

        foreach ($request->chitietthongso as $key => $chitietthongso) {
            if($chitietthongso != null) {
                $this->detail->create([
                    'sp_id' => $product->sp_id,
                    'ts_id' => $request->thongso[$key],
                    'chitietthongso' => $chitietthongso,
                ]);
            }
        }

        Session::put('message','Thêm sản phẩm thành công !!!');
        return redirect()->route('sup.product.create');
    }

    public function getPara(Request $request) {
        $type = $this->type->find($request->id);
        $output = '';
        if($type){
            foreach ($type->parameter as $key => $para) {
                if ($request->idProduct == null)
                {
                    $output .= '<input class="thongso" type="checkbox" data-key="'.$key.'" >'.$para->ts_tenthongso.'</input></br></br>
                    <input type="text" class="chitiet" name="chitietthongso[]" data-key="'.$key.'" readonly>
                    <input type="hidden" name="thongso[]" value="'.$para->ts_id.'"></br></br>';
                }
                else {
                    $chitiet = $para->detail($request->idProduct)->first();
                    if ($chitiet) {
                        $chitietthongso = $chitiet->chitietthongso;
                        $check = 'checked';
                        $readonly = '';
                    }
                    else {
                        $chitietthongso = '';
                        $check = '';
                        $readonly = 'readonly';
                    }
                    $output .= '<input class="thongso" type="checkbox" '.$check.' data-key="'.$key.'" >'.$para->ts_tenthongso.'</input></br></br>
                    <input type="text" class="chitiet" name="chitietthongso[]" value="'.$chitietthongso.'" data-key="'.$key.'" '.$readonly.'>
                    <input type="hidden" name="thongso[]" value="'.$para->ts_id.'"></br></br>';
                }

            }
        }


        return response()->json($output);
    }

    public function edit($id){
        $products = $this->product->find($id);
        $productImages = $this->productImage->where('sp_id',$id)->get();
        $discounts = $this->discount->where('ncc_id',Auth::user()->ncc->ncc_id)->get();
        $categories = $this->category->all();
        $brands = $this->brand->all();
        $types = $this->type->all();
        $para = $products->para()->first();
        foreach ($types as $type) {
                if($para->loaisp_id == $type->loaisp_id) {
                    $this->htmlSelectType .= "<option selected value='". $type['loaisp_id']."'>" . $type->loaisp_ten ."</option>";
                }
                else {
                    $this->htmlSelectType .= "<option value='". $type['loaisp_id']."'>" . $type->loaisp_ten ."</option>";
                }
        }


        foreach ($categories as $category) {
            if($category->dm_id == $products->cate->dm_id) {
                $this->htmlSelectCate .= "<option selected value='". $category['dm_id']."'>" . $category->dm_ten ."</option>";
            }
            else {
                $this->htmlSelectCate .= "<option value='". $category['dm_id']."'>" . $category->dm_ten ."</option>";
            }
        }

        foreach ($brands as $brand) {
            if($brand->th_id == $products->brand->th_id) {
                $this->htmlSelectBrand .= "<option selected value='". $brand['th_id']."'>" . $brand->th_ten ."</option>";
            }
            else {
                $this->htmlSelectBrand .= "<option value='". $brand['th_id']."'>" . $brand->th_ten ."</option>";
            }
        }

        $htmlCate = $this->htmlSelectCate;
        $htmlBrand = $this->htmlSelectBrand;
        $htmlType = $this->htmlSelectType;
        return view('admin.nhacungcap.product.edit',compact('products','productImages','htmlCate','htmlBrand','htmlType','discounts'));
    }

    public function update($id, Request $request) {
        $dataUpdate = [
            'sp_ten' => $request->name,
            'sp_giabanra' => $request->price,
            'sp_soluong' => $request->quantity,
            'sp_mota' => $request->desc,
            'sp_slug' => str_slug($request->name),
            'sp_chitiet' => $request->detail,
            'sp_thoigianbaohanh'=> $request->insurance,
            'ncc_id' => Auth::user()->ncc->ncc_id,
            'th_id' => $request->brand,
            'dm_id' => $request->cate,
            'km_id' => $request->discount,
        ];

        $dataUpload = $this->storageTraitUpload($request, 'image', 'product');
        if(!empty($dataUpload)) {
            $dataUpdate['sp_hinhanh'] = $dataUpload['file_path'];
        }
        $product = $this->product->find($id);
        $product->update($dataUpdate);

        if($request->hasFile('image_detail')) {
            $this->productImage->where('sp_id',$id)->delete();
            foreach ($request->image_detail as $fileItem) {
                $dataImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                $product->images()->create([
                    'ha_ten' => $dataImageDetail['file_name'],
                    'ha_mota' => $product->sp_ten,
                    'ha_duongdan' => $dataImageDetail['file_path'],
                ]);
            }
        }

        $product->para()->detach();
        foreach ($request->chitietthongso as $key => $chitietthongso) {
            if($chitietthongso != null) {
                $this->detail->create([
                    'sp_id' => $product->sp_id,
                    'ts_id' => $request->thongso[$key],
                    'chitietthongso' => $chitietthongso,
                ]);
            }
        }

        Session::put('message','Cập nhật sản phẩm thành công !!!');
        return redirect()->route('sup.product.list');
    }

    public function delete($id) {
        $this->product->find($id)->delete();
        $this->detail->where('sp_id',$id)->delete();
        $this->productImage->where('sp_id',$id)->delete();

        Session::put('message','Xóa sản phẩm thành công !!!');
        return redirect()->route('sup.product.list');
    }
}

