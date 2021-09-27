@extends('admin.layout')

@section('title')
    SLide
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH SLIDE</h4>
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
                                <th>Tên Slide</th>
                                <th>Hinh ảnh Slide</th>
                                <th>Mô tả</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $slide)
                                <tr>
                                    <th scope="row">{{ $slide['sl_id'] }}</th>
                                    <td>{{ $slide['sl_ten'] }}</td>
                                    <td>
                                        <img src="{{ $slide['sl_hinhanh'] }}" style="width: 400px ; height: 150px">
                                    </td>
                                    <td>{{ $slide['sl_mota'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.slide.edit', ['id' => $slide->sl_id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <a href="" data-url="{{ route('admin.slide.delete', ['id' => $slide->sl_id]) }}" class="btn btn-danger delete-slide">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
        <div class="col-2">
           <a href="{{ route('admin.cate.hasdelete') }}" class="btn btn-blue">Đã xóa</a>
        </div>
    </div>

@endsection
