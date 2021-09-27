<div class="modal-dialog modal-lg">
    <div class="modal-content modalsanpham">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Thêm khuyến mãi cho các sản phẩm</h4>
            <div id="success"></div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3 class="text-center">{{ $discount->km_ten }}</h3>
            <h3>Danh sách sản phẩm thuộc khuyến mãi</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>ID sản phẩm</th>
                    <th>Tên sản phẩm số</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody class="deleteProduct">
                @foreach($discount->product as $product)
                    <tr>
                        <td>
                            {{$product->sp_id}}
                        </td>
                        <td>
                            {{$product->sp_ten }}
                        </td>
                        <td>
                            <img src="{{ $product->sp_hinhanh }} " style="height: 150px; width: 200px">
                        </td>
                        <td>
                            <a href="" data-id="{{ $product->sp_id }}" data-key="{{ $discount->km_id }}" class="btn btn-danger deleteProduct-discount">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h3>Thêm sản phẩm cho khuyến mãi</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>ID sản phẩm</th>
                    <th>Tên sản phẩm số</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody class="addProduct">
                @foreach($products as $product)
                    <tr>
                        <td>
                            {{$product->sp_id}}
                        </td>
                        <td>
                            {{$product->sp_ten }}
                        </td>
                        <td>
                            <img src="{{ $product->sp_hinhanh }} " style="height: 150px; width: 200px">
                        </td>
                        <td>
                            <a href="" data-id="{{ $product->sp_id }}" data-key="{{ $discount->km_id }}" class="btn btn-info add-discount">Thêm</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
