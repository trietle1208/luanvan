<div class="modal-dialog modal-lg">
    <div class="modal-content modalphieunhap">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết thêm về phiếu nhập</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3 class="text-center">{{$receipt->pnh_ten}}</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Người lập phiếu</th>
                    <th scope="col">Người duyệt phiếu</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $receipt->userNhap->name }}</td>
                    <td>{{ $receipt->userDuyet->name ?? 'Chưa duyệt' }}</td>
                </tr>

                </tbody>
            </table>

            <table class="table">
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Số lượng nhập vào</th>
                    <th>Giá nhập vào</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($receipt->product as $product)
                    <tr>
                        <td>
                            {{$product->sp_ten}}
                        </td>
                        <td>
                            <img src="{{$product->sp_hinhanh}}" style="width: 200px; height: 150px">
                        </td>
                        <td>
                            {{$product->receiptdetail($receipt->pnh_id)->first()->soluonggoc }}
                        </td>
                        <td>
                            {{ number_format($product->receiptdetail($receipt->pnh_id)->first()->giagoc) }}VND
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
