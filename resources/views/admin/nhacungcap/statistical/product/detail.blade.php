<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết sản phẩm</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <p><strong>Thuộc danh mục : </strong>{{ $product->cate->dm_ten }}</p>
                    <p><strong>Thuộc thương hiệu : </strong>{{ $product->brand->th_ten }}</p>
                    <p><strong>Thời gian bảo hành : </strong>{{ $product->sp_thoigianbaohanh }} tháng</p>
                    <p><strong>Giá : </strong>{{ number_format($product->sp_giabanra) }} VNĐ</p>
                    <img src="{{ $product->sp_hinhanh }}" class="img-fuild" style="width:150px ; height:150px">
                </div>
                <div class="col-6">
                    @foreach($product->para as $para)
                        @foreach($product->detail as $detail)
                            @if($para->ts_id == $detail->ts_id)
                            <p><strong>{{ $para->ts_tenthongso }} : </strong>{{ $detail->chitietthongso }}</p>
                            <hr>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>