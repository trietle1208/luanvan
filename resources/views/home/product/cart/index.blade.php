@extends('layouts.master')
@section('title')
    <title>Giỏ hàng</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('home/home.js') }}">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-9 padding-right">
                    <div class="row">
                        <section id="cart_items">
                            <div class="container">
                                <div class="breadcrumbs">
                                    <ol class="breadcrumb">
                                        <li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
                                        <li class="active">Giỏ hàng</li>
                                    </ol>
                                </div>
                                <div class="table-responsive cart_info">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr class="cart_menu text-center">
                                            <td class="">Hình ảnh</td>
                                            <td class="">Giá</td>
                                            <td class="">Số lượng</td>
                                            <td class="">Thành tiền</td>
                                            <td class="">Xóa</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            use Illuminate\Support\Facades\Session;
                                            $total = 0;
                                            $cart = Session::get('cart');
                                        ?>
                                        @if($cart != null)
                                            @foreach(Session::get('cart') as $key => $value)
                                                @php
                                                $discount_id = 0;
                                                @endphp
                                                    <div>
                                                    <tr id="name_{{ $key }}">
                                                        <td colspan="5" style="padding: 35px;"><input type="checkbox">&emsp;{{ \App\Models\Manufacture::getData($key)->ncc_ten ?? ''}}</td>
                                                    </tr>
                                                    <tr class="parent_tr">
                                                        <td colspan="5">
                                                            <table class="table table-condensed">
                                                                @foreach($value as $key1 => $product)
                                                                    @if($key1 == 0 && count($product) > 0)
                                                                        @php
                                                                            $discount_id = $product['id'];
                                                                        @endphp
                                                                    @endif
                                                                    @if($key1 != 0)
                                                                    <tr class="product product_{{ $key }}">
                                                                        <td class="cart_product">
                                                                            <input type="checkbox" style="float: left"><br>
                                                                            <a href="{{ route('product.detail', ['ncc' => $key ,'slug' => $product['slug']]) }}"><img src="{{ $product['image']  }}" style="height: 150px; width: 150px" alt=""></a><br>
                                                                            <h4><a href="">{{ $product['name'] }}</a></h4>
                                                                        </td>
                                                                        <td class="cart_price">
                                                                            <p>{{ number_format($product['price_discount']) }} VND</p>
                                                                        </td>
                                                                        @php
                                                                            $receiptdetail = \App\Models\ReceiptDetail::where('sp_id',$key1)->orderBy('created_at','DESC')->first();
                                                                            $quantityProduct = $receiptdetail->soluong;
                                                                        @endphp
                                                                        <td class="cart_quantity">
                                                                            <div class="cart_quantity_button" >
                                                                                <a class="cart_quantity_down cart_qty dec" href="" data-id="{{ $key1 }}" data-key="{{ $key }}"> - </a>
                                                                                <input readonly class="cart_quantity_input" id="valueQty_{{ $key1 }}"
                                                                                    data-url = "{{ route('product.updateCart') }}"
                                                                                    data-qty_has = "{{ $quantityProduct }}"
                                                                                    name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2" min="1">
                                                                                <a class="cart_quantity_up cart_qty inc" href="" data-id="{{ $key1 }}" data-key="{{ $key }}"> + </a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="cart_total">
                                                                            <p class="cart_total_price cart_total_price">
                                                                                {{ number_format($product['total']) }} VND
                                                                            </p>
                                                                            <?php
                                                                            $total += $product['total'];
                                                                            ?>
                                                                        </td>
                                                                        <td class="cart_delete">
                                                                            <a class="cart_quantity_delete" data-key="{{ $key }}" data-url="{{ route('product.deleteCart',['rowId' => $key1 ]) }}"><i class="fa fa-times"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr id="choose-voucher_{{ $key }}" class="choose-voucher" style="display: block">
                                                        <td style="padding: 35px;">
                                                            @if(isset($arr_voucher_sort1[$key]))
                                                                @if($discount_id == 0)
                                                                    <div class="add add_{{ $key }}">
                                                                        <span style="padding-bottom: 15px;">Bạn có thể chọn 1 trong các mã giảm giá dưới đây</span><br>
                                                                        <button style="padding: 10px;" class="btn btn-primary showVoucher"
                                                                            data-url="{{ route('product.showVoucher') }}"
                                                                            value="1" id="button-voucher_{{ $key }}" data-key="{{ $key }}">Danh sách mã</button>
                                                                    </div>
                                                                    
                                                                    <div class="delete delete_{{ $key }}" style="display: none">
                                                                        <span style="padding-bottom: 15px;">Bạn đang sử dụng 1 mã giảm giá</span><br>
                                                                        <div class="col-6">
                                                                            <div class="name_{{ $key }}"></div>
                                                                            <div class="code_{{ $key }}"></div>
                                                                            <div class="desc_{{ $key }}"></div>
                                                                        </div>
                                                                        <hr>
                                                                        <button style="padding: 10px;" class="btn btn-danger deleteVoucher"
                                                                                data-url="{{ route('product.deletedVoucher') }}"
                                                                                id="button-voucher_{{ $key }}" data-key="{{ $key }}"> Xóa mã</button>
                                                                    </div>
                                                                @else
                                                                    <div class="delete delete_{{ $key }}">
                                                                        <span style="padding-bottom: 15px;">Bạn đang sử dụng 1 mã giảm giá</span><br>
                                                                        <div class="col-6">
                                                                            @foreach ($value as $key1 => $voucher)
                                                                                @if($key1 == 0 && count($voucher) > 0)
                                                                                <span>Tên mã : {{ $voucher['name'] }}</span><br>
                                                                                <span>CODE : {{ $voucher['code'] }}</span><br>
                                                                                <span>Mô tả : {{ $voucher['desc'] }}</span><br>
                                                                                @endif  
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="name_{{ $key }}"></div>
                                                                            <div class="code_{{ $key }}"></div>
                                                                            <div class="desc_{{ $key }}"></div>
                                                                        </div>
                                                                        <hr>
                                                                        <button style="padding: 10px;" class="btn btn-danger deleteVoucher"
                                                                                data-url="{{ route('product.deletedVoucher') }}"
                                                                                id="button-voucher_{{ $key }}" data-key="{{ $key }}"> Xóa mã</button>
                                                                    </div>

                                                                    <div class="add add_{{ $key }}" style="display : none;">
                                                                        <span style="padding-bottom: 15px;">Bạn có thể chọn 1 trong các mã giảm giá dưới đây</span><br>
                                                                        <button style="padding: 10px;" class="btn btn-primary showVoucher"
                                                                            data-url="{{ route('product.showVoucher') }}"
                                                                            value="1" id="button-voucher_{{ $key }}" data-key="{{ $key }}">Danh sách mã</button>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </div>
                                                    
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section id="do_action">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="total_area">
                                            <ul>
                                                <li class="subtotal">Tổng tiền sản phẩm: <span>{{  number_format($total)  }} VND</span></li>
                                                <li class="voucher1">Số tiền được giảm:
                                                    <span>
                                                        {{ number_format($totalDiscount) }} VND
                                                    </span>
                                                    <input type="hidden" value="0">
                                                    </li>
                                                <li>Phí vận chuyển: <span>0 VND</span></li>
                                                <li class="total">Tổng tiền  <span>{{  number_format($totalCart)  }} VND</span></li>
                                            </ul>
                                            <a class="btn btn-default check_out" href="{{ route('checkout.index') }}">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section><!--/#do_action-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="danhsachvoucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
    </div>
@endsection

