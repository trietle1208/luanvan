<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Danh sách phản hồi của bình luận</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
            @foreach($comments as $comment)
                @if($comment->kh_id != null)
                <div class="col-12 repComment mb-4">
                    <div class="row">
                        <div class="col-3">
                            <img class="avatar-lg rounded-circle" style="margin-left : 20px" src="{{ $comment['customer']['kh_hinhanh'] ?? asset('assets/images/avt_null.jpg') }}"></img>
                        </div>
                        <div class="col-9">
                            <h5>{{ $comment['customer']['kh_hovaten'] }}</h5><small>{{  $comment->created_at }}</small><br>
                            <strong>{{ $comment->bl_noidung }}</strong> 
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12 repComment mb-4">
                    <div class="row">
                        <div class="col-3">
                            <img class="avatar-lg rounded-circle" style="margin-left : 20px" src="{{ $comment['admin']['info']['tt_hinhanh'] ?? asset('assets/images/avt_null.jpg') }}"></img>
                        </div>
                        <div class="col-9">
                            <h5 class="text-primary">{{ $comment['admin']['name'] }}</h5><small>{{  $comment->created_at }}</small><br>
                            <strong>{{ $comment->bl_noidung }}</strong> 
                        </div>
                    </div>
                </div>
                @endif
                <hr>
            @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>