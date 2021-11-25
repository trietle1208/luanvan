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
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên loại</th>
                                <th>Thuộc danh mục</th>
                                <th>Mô tả</th>
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
                                    <td>
                                        <a href="" data-id="{{ $type->loaisp_id }}" class="btn btn-primary para-detail">Chi tiết</a>
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

@endsection
