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
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
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
                                <tr class="body">
                                    <th scope="row">{{ $account['id'] }}</th>
                                    <td>{{ $account->name }}</td>
                                    <td>{{ $account->email }} </td>
                                    <td>{{ $account->created_at }}</td>
                                    @if($account->trangthai == 1)
                                    <td class="text-success textStatus">Hoạt động</td>
                                    @else
                                    <td class="text-danger textStatus">Tạm khóa</td>
                                    @endif
                                    <td>
                                        <a href="" class="btn btn-primary detailAccount" 
                                            data-id="{{ $account['id'] }}" 
                                            data-url="{{ route('sup.account.detailAccount') }}">
                                            Chi tiết
                                        </a>
                                        <a href="{{ route('sup.account.addRole',['id' =>$account['id'] ]) }}" class="btn btn-success add-role-account">Gán vai trò</a>
                                        @if($account->trangthai == 1)
                                            <a class="btn btn-danger blockAccount" data-auth="{{ Auth::id() }}" data-id="{{ $account['id'] }}" data-url="{{ route('sup.account.blockAccount')  }}" style="display : inline-block">Khóa tài khoản</a>
                                            <a class="btn btn-success openAccount" data-id="{{ $account['id'] }}" data-url="{{ route('sup.account.openAccount')  }}" style="display : none">Mở tài khoản</a>
                                        @else
                                            <a class="btn btn-danger blockAccount" data-id="{{ $account['id'] }}" data-url="{{ route('sup.account.blockAccount')  }}" style="display : none">Khóa tài khoản</a>
                                            <a class="btn btn-success openAccount" data-id="{{ $account['id'] }}" data-url="{{ route('sup.account.openAccount')  }}" style="display : inline-block">Mở tài khoản</a>
                                        @endif
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
