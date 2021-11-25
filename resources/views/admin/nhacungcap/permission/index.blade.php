@extends('admin.layout')

@section('title')
    Danh sách quyền
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH QUYỀN</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th style="width: 50%">Tên quyền</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{ $permission->id }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ route('sup.permission.edit',['id' => $permission->id]) }}" class="btn btn-primary">Chỉnh sửa</a>
                                        <a href="" class="btn btn-danger deletePermission" data-id="{{ $permission->id }}" data-url="{{ route('sup.permission.delete') }}">Xóa</a>
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
