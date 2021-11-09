@extends('admin.layout')

@section('title')
    Phí vận chuyển
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH THÀNH PHỐ</h4>
                    <div class="table-responsive" >
                        <table class="table mb-0" id="category">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên thành phố</th>
                                <th>Loại</th>
                                <th>Phí vận chuyển</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr class="city">
                                    <th scope="row">{{ $city['tp_id'] }}</th>
                                    <td>{{ $city['tp_ten'] }}</td>
                                    <td>{{ $city['tp_loai'] }}</td>
                                    <td><input id="cost_{{ $city['tp_id'] }}" readonly value="{{ $city['phivanchuyen'] }}"></td>
                                    <td>
                                        <a href="" class="btn btn-info changeCost" data-id="{{ $city['tp_id'] }}" data-url="{{ route('admin.cost.edit') }}" value="0">Chỉnh sửa</a>
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
