<div class="modal-dialog" role="document" style="width: 50vw">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="addWishlist">Danh Sách Yêu Thích</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Giá</th>
                </tr>
                </thead>
                <tbody>
                @foreach($wishlist as $item)
                <tr>
                    <th scope="row">{{ $item->product->sp_id }}</th>
                    <td><a href="{{ route('product.detail', ['ncc' => $item->product->ncc_id ,'slug' => $item->product->sp_slug]) }}">{{ $item->product->sp_ten }}</a></td>
                    <td><a href="{{ route('product.detail', ['ncc' => $item->product->ncc_id ,'slug' => $item->product->sp_slug]) }}"><img src="{{ $item->product->sp_hinhanh }}" class="img-fluid" style="width: 200px; height: 200px"></a></td>
                    <td>{{ number_format($item->product->sp_giabanra) }} VND</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
