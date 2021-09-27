<div class="modal-dialog modal-xs">
    <div class="modal-content modalchitietthonggso">
        <div class="modal-header">
            <h4 class="modal-title text-center" id="exampleModalLabel">Chi tiết thêm về thông số</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3 class="text-center">Thuộc loại {{$type->loaisp_ten}}</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>ID thông số</th>
                    <th>Tên thông số</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($paras as $para)
                    <tr>
                        <td>
                            {{$para->ts_id}}
                        </td>
                        <td>
                            {{$para->ts_tenthongso}}
                        </td>
                        <td>
                            <a href="{{ route('admin.para.edit', ['id' => $para->ts_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                            <a href="" data-url="{{ route('admin.para.delete', ['id' => $para->ts_id]) }}" class="btn btn-danger delete-para">Xóa</a>
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
