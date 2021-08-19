@extends('admin.layout')

@section('title')
    Thông số sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH THÔNG SỐ</h4>
                    <?php
                    $message = Session::get('message');
                    if($message)
                    {
                        echo '<span class="text-primary">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên thông số</th>
                                <th>Thuộc loại</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parameters as $parameter)
                                <tr>
                                    <th scope="row">{{ $parameter['ts_id'] }}</th>
                                    <td>{{ $parameter['ts_tenthongso'] }}</td>
                                    <td class="text-primary">{{ $parameter->typeproduct['loaisp_ten'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.para.edit', ['id' => $parameter->ts_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa thông số này không?')" href="{{ route('admin.para.delete', ['id' => $parameter->ts_id]) }}" class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-2">
           <a href="{{ route('admin.cate.hasdelete') }}" class="btn btn-blue">Đã xóa</a>
        </div>
    </div>

@endsection
