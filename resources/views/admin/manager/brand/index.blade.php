@extends('admin.layout')

@section('title')
    Thương hiệu sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH THƯƠNG HIỆU</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên thương hiệu</th>
                                <th>Hinh ảnh thương hiệu</th>
                                <th>Mô tả</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brand['th_id'] }}</th>
                                    <td>{{ $brand['th_ten'] }}</td>
                                    <td>
                                        <img src="{{ $brand['th_hinhanh'] }}" style="width: 180px ; height: 120px">
                                    </td>
                                    <td>{{ $brand['th_mota'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.brand.edit', ['id' => $brand->th_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a data-url="{{ route('admin.brand.delete', ['id' => $brand->th_id]) }}" class="btn btn-danger delete-brand">Xóa</a>
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
