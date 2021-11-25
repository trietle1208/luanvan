@extends('admin.layout')

@section('title')
    Danh sách vai trò
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH VAI TRÒ</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th style="width: 50%">Tên vai trò</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('sup.role.edit',['id' => $role->id]) }}" class="btn btn-primary">Chỉnh sửa</a>
                                        <a href="{{ route('sup.role.addPermission',['id' => $role->id]) }}" class="btn btn-success add-permission">Gán quyền</a>
                                        <a class="btn btn-danger deleteRole" data-id="{{ $role->id }}" data-url="{{ route('sup.role.delete') }}">Xóa</a>
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
    <div class="modal fade" id="ganquyen" tabindex="-1">

    </div>
    
@endsection
