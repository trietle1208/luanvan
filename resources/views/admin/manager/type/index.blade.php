@extends('admin.layout')

@section('title')
    Loại sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH LOẠI</h4>
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
                                <th>Tên loại</th>
                                <th>Mô tả</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <th scope="row">{{ $type['loaisp_id'] }}</th>
                                    <td>{{ $type['loaisp_ten'] }}</td>

                                    <td>{{ $type['loaisp_mota'] }}</td>
                                    <td>{{ $type['loaisp_slug'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.type.edit', ['id' => $type->loaisp_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa loại này không?')" href="{{ route('admin.type.delete', ['id' => $type->loaisp_id]) }}" class="btn btn-danger">Xóa</a>
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