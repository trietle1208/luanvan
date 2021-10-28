<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chitiettaikhoan">Thông tin cá nhân</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $account->info->tt_hinhanh ?? asset('assets/images/avt_null.jpg') }}"
                style="width: 200px ; height: 300px" 
                class="img-responsive img-fuild">
            </div>

            <div class="col-md-6">
                <p>
                <strong>Họ và tên : </strong> {{ $account->name }}
                </p>
                <p>
                <strong>Địa chỉ : </strong> {{ $account->info->tt_diachi ?? 'Chưa cập nhật' }}
                </p>
                <p>
                <strong>Số điện thoại : </strong> {{ $account->tt_sdt ?? 'Chưa cập nhật' }}
                </p>
                <p>
                <strong>Giới tính : </strong> {{ $account->info->tt_gioitinh == 0 ? 'Nam' : 'Nữ' }}
                </p>
                <p>
                <strong>Ngày sinh : </strong> {{ $account->tt_ngaysinh ?? 'Chưa cập nhật' }}
                </p>
                <p>
                <strong>Chức vụ : </strong> 
                @foreach ($account->getRoleNames() as $role)
                    {{ $role }},
                @endforeach
                </p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>