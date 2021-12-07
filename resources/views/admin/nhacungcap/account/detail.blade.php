<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chitiettaikhoan">Thông tin cá nhân</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <img class="d-flex me-3 rounded-circle avatar-lg" src="{{ $account->info->tt_hinhanh ?? asset('assets/images/avt_null.jpg') }}" alt="Generic placeholder image">
                            <div class="w-100">
                                <h4 class="mt-0 mb-1">{{ $account->name }}</h4>
                                <h6 class="mt-0 mb-1">Chức vụ</h4>
                                @foreach ($account->getRoleNames() as $role)
                                <a href="" class="btn- btn-xs btn-secondary" style="padding : 5px; margin-bottom : 5px">{{ $role }}</a><br><br>
                                @endforeach
                            </div>
                        </div>

                        <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá nhân</h5>
                        <div class="">
                            <h4 class="font-13 text-muted text-uppercase">Giới thiệu bản thân :</h4>
                            <p class="mb-3">
                              Xin chào mình tên là {{ $account->name }}, hiện đang là thành viên mới trong công ty, mong nhận được nhiều sự giúp đỡ từ các bạn.
                            </p>

                            <h4 class="font-13 text-muted text-uppercase mb-1">Sinh nhật :</h4>
                            <p class="mb-3"> {{ $account->info->tt_ngaysinh ?? 'Chưa cập nhật' }}</p>

                            <h4 class="font-13 text-muted text-uppercase mb-1">Công ty :</h4>
                            <p class="mb-3">{{ $account->ncc->ncc_ten }}</p>

                            <h4 class="font-13 text-muted text-uppercase mb-1">Địa chỉ :</h4>
                            <p class="mb-3"> {{ $account->info->tt_diachi ?? 'Chưa cập nhật' }}</p>

                            <h4 class="font-13 text-muted text-uppercase mb-1">Số điện thoại :</h4>
                            <p class="mb-0"> {{ $account->info->tt_sdt ?? 'Chưa cập nhật' }}</p>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>