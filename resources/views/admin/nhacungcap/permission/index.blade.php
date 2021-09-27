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
                                <th style="width: 50%">Mã đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <th scope="row">{{ $permission->id }}</th>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Chỉnh sửa</a>
                                        <a href="" class="btn btn-success">Gán quyền</a>
                                        <a href="" class="btn btn-danger">Xóa</a>
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
    <div class="modal fade" id="chitietdonhang" tabindex="-1">

    </div>
@endsection
