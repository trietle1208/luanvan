@extends('admin.layout')

@section('title')
    Hình thức thanh toán
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH HÌNH THỨC</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên hình thức</th>
                                <th>Hinh ảnh </th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ships as $ship)
                                <tr>
                                    <th scope="row">{{ $ship['ht_id'] }}</th>
                                    <td>{{ $ship['ht_ten'] }}</td>
                                    <td>
                                        <img src="{{ $ship['ht_hinhanh'] }}" style="width: 180px ; height: 120px">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.ship.edit', ['id' => $ship->ht_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a data-url="{{ route('admin.ship.delete', ['id' => $ship->ht_id]) }}" class="btn btn-danger delete-brand">Xóa</a>
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
