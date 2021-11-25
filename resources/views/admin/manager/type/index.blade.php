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
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên loại</th>
                                <th>Thuộc danh mục</th>
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
                                    <td class="text-success">{{ $type->cate->dm_ten }}</td>
                                    <td>{{ $type['loaisp_mota'] }}</td>
                                    <td>{{ $type['loaisp_slug'] }}</td>
                                    <td>
                                        <a href="" data-id="{{ $type->loaisp_id }}" class="btn btn-primary para-detail">Chi tiết</a>
                                        <a href="{{ route('admin.type.edit', ['id' => $type->loaisp_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a href="" data-url="{{ route('admin.type.delete', ['id' => $type->loaisp_id]) }}" class="btn btn-danger delete-type">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>
    <div class="modal fade" id="chitietthongso" tabindex="-1">

    </div>
@endsection
