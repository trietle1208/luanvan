
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Các mã giảm giá dành cho bạn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <style>
            .chooseVoucher {
                background-color: #DEDAD9;
            }
        </style>
        <div class="listVoucher">
            @foreach ($arr_voucher_sort[0] as $item)
                <div style="padding : 15px; margin : 10px" class="chooseVoucher chooseVoucher_{{ $item['mgg_id'] }}">
                    <input type="radio" name="voucher" value="{{ $item['mgg_id'] }}">
                    <span>{{ $item['mgg_ten'] }} (giảm giá cho đơn hàng có giá trị lớn hơn {{ number_format($item['mgg_dieukien']) }} VNĐ)</span>
                </div>
            @endforeach
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-success addVoucher" data-url="{{ route('product.addVoucher') }}" data-key="{{ $ncc_id }}">Áp dụng mã</button>
      </div>
    </div>
  </div>