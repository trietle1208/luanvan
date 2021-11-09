<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Danh sách shipper</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <style>
            .listchooseShipper {
                background-color: #DEDAD9;
            }
        </style>
      <div class="modal-body">
        @foreach ($shippers as $shipper)
             <div style="padding : 15px; margin : 10px" class="listchooseShipper">
                @if($order->gh_id == $shipper->id)
                    <input type="radio" name="shipper" value="{{ $shipper->id }}" checked>
                    <span>{{ $shipper->name }} ({{ $shipper->email }})</span>
                @else
                    <input type="radio" name="shipper" value="{{ $shipper->id }}">
                    <span>{{ $shipper->name }} ({{ $shipper->email }})</span>
                @endif
             </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary chooseShipper" data-id="{{ $order->dh_id }}" data-url="{{ route('admin.order.chooseShipper') }}">Lưu</button>
      </div>
    </div>
  </div>