@extends('admin.layout')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH TÀI KHOẢN</h4>
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
                                <th>Ho và tên</th>
                                <th>Email</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row" class="user_id_" >{{ $user['id'] }}</th>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    @if($user['trangthai'] == 0)
                                    <td>
                                        <button class="btn btn-info change-status" id="status_{{ $user['id'] }}" data-id= "{{ $user['id'] }}">Duyệt</button>
                                    </td>
                                    @else
                                        <td>
                                        <button class="btn btn-success change-status" id="status_1_{{ $user['id'] }}" data-id= "{{ $user['id'] }}">Đã duyệt</button>
                                        </td>
                                    @endif
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
