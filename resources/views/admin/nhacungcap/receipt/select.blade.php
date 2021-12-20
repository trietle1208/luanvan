<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="danhsachsanpham">Danh Sách Sản Phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Số lượng nhập</th>
                    <th scope="col">Giá nhập vào</th>
                    <th scope="col">Giá bán ra</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->sp_id }}</th>
                    <td>{{ $product->sp_ten }}</td>
                    <td><img src="{{ $product->sp_hinhanh }}" style="height: 150px ; width: 150px" class="img-fluid"></td>
                    <!-- <td>{{ number_format($product->sp_giabanra) }} VNĐ</td> -->
                    @if(!empty(Session::get('product')))
                        <td><input type="text" class="form-control qty_{{ $product->sp_id }}"
                                   value="{{ array_key_exists($product->sp_id, Session::get('product')) ? Session::get('product')[$product->sp_id]['quantity'] : '' }}"
                                    {{ array_key_exists($product->sp_id, Session::get('product')) ? 'readonly' : '' }}></td>
                        <td><input type="text" class="form-control price_{{ $product->sp_id }}"
                                   value="{{ array_key_exists($product->sp_id, Session::get('product')) ? Session::get('product')[$product->sp_id]['price'] : '' }}"
                                {{ array_key_exists($product->sp_id, Session::get('product')) ? 'readonly' : '' }}></td>
                        <td><input type="text" class="form-control price_sell_{{ $product->sp_id }}"
                                   value="{{ array_key_exists($product->sp_id, Session::get('product')) ? Session::get('product')[$product->sp_id]['price_sell'] : '' }}"
                                {{ array_key_exists($product->sp_id, Session::get('product')) ? 'readonly' : '' }}></td>
                        <td>
                            <button style="display: {{ array_key_exists($product->sp_id, Session::get('product')) ? 'none' : 'block' }};"
                                    class="btn btn-success addProductReceipt"
                                    data-id="{{ $product->sp_id }}"
                                    data-url="{{ route('sup.receipt.add') }}"
                                    value="0">Thêm</button>
                            <button style="display: {{ array_key_exists($product->sp_id, Session::get('product')) ? 'block' : 'none' }};"
                                    class="btn btn-danger deleteProductReceipt"
                                    data-id="{{ $product->sp_id }}"
                                    data-url="{{ route('sup.receipt.deleteProduct') }}"
                                    value="0">Xóa</button>
                        </td>
                    @else
                        <td><input type="text" class="form-control qty_{{ $product->sp_id }}"></td>
                        <td><input type="text" class="form-control price_{{ $product->sp_id }}"></td>
                        <td><input type="text" class="form-control price_sell_{{ $product->sp_id }}"></td>
                        <td>
                            <button style="display: block"
                                    class="btn btn-success addProductReceipt"
                                    data-id="{{ $product->sp_id }}"
                                    data-url="{{ route('sup.receipt.add') }}"
                                    value="0">Thêm</button>
                            <button style="display: none"
                                    class="btn btn-danger deleteProductReceipt"
                                    data-id="{{ $product->sp_id }}"
                                    data-url="{{ route('sup.receipt.deleteProduct') }}"
                                    value="0">Xóa</button>
                        </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
