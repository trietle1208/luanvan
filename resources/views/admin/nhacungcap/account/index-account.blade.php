@extends('admin.layout')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH TÀI KHOẢN</h4>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <th scope="row">{{ $account['id'] }}</th>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ $account->email }} </td>
                                    <td>{{ $account->created_at }}</td>
                                    @if($account->trangthai == 1)
                                    <td class="text-success">Hoạt động</td>
                                    @else
                                    <td class="text-danger">Tạm khóa</td>
                                    @endif
                                    <td>
                                        <a href="" class="btn btn-primary detailAccount" 
                                            data-id="{{ $account['id'] }}" 
                                            data-url="{{ route('sup.account.detailAccount') }}">
                                            Chi tiết
                                        </a>
                                        <a href="{{ route('sup.account.addRole',['id' =>$account['id'] ]) }}" class="btn btn-success add-role-account">Gán vai trò</a>
                                        <a href="" class="btn btn-danger ">Khóa tài khoản</a>
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
    <div class="modal fade" id="ganvaitro" tabindex="-1">

    </div>

    <div class="modal fade" id="chitiettaikhoan" tabindex="-1">

    </div>
@endsection
