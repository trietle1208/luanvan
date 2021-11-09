<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Cập nhật thông tin cá nhân</h5>
        </div>
        <div class="modal-body">
            <div>
                <form action="{{ route('customer.saveUpdateInfo') }}" id="save-info" method="post">
                    @csrf
                    <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}" />
                    <label>Họ và tên : </label>
                    <input class="form-control name" data-url="{{ route('customer.saveUpdateInfo') }}" data-id="{{ $user->kh_id }}" name="name" type="text" value="{{ $user->kh_hovaten }}">
                    <div class="error name"></div>
                    <label>Số điện thoại : </label>
                    <input class="form-control phone" name="phone" type="text" value="{{ $user->kh_sdt }}">
                    <div class="error phone"></div>
                    <label>Giới tính : </label><br>
                    @if($user->kh_gioitinh == 0)
                        <label>Nam</label>
                        <input class="sex" type="radio" name="sex" value="0" checked>
                        <label>Nữ</label>
                        <input class="sex" type="radio" name="sex" value="1">
                    @else
                        <label>Nam</label>
                        <input class="sex" type="radio" name="sex" value="0">
                        <label>Nữ</label>
                        <input class="sex" type="radio" name="sex" value="1" checked>
                    @endif
                    <br>
                    <div class="error sex"></div>
                    <label>Ngày sinh : </label>
                    <input class="form-control date" name="date" type="date" value="{{ $user->kh_ngaysinh }}">
                    <div class="error date"></div>
                    <label>Hình ảnh : </label>
                    <input type="file" class="form-control avt" name="image" value="{{ $user->kh_hinhanh }}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success saveUpdateInfo">Lưu</button>
                </form>
            </div>
        </div>

        <div class="modal-footer">

        </div>
    </div>
</div>
