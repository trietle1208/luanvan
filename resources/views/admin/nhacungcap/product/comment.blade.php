@extends('admin.layout')

@section('title')
Bình luận sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 pt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">DANH SÁCH SẢN PHẨM</h4>
                <div class="table-responsive">
                    <table class="table mb-0" id="comment">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh sản phẩm</th>
                                <th>Sao đánh giá</th>
                                <th>Nội dung</th>
                                <th>Người đăng</th>
                                <th>Thời gian đăng tải</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->bl_id }}</td>
                                <td>{{ $comment->product->sp_ten }}</td>
                                <td><img src="{{ $comment->product->sp_hinhanh }}" style="width: 180px ; height: 120px"></td>
                                @if($comment->bl_sosao)
                                <td style="color : #ffcc00; font-size : 20px">
                                    @for($i = 0 ; $i < $comment->bl_sosao ; $i++)
                                        &#9733;
                                    @endfor
                                </td>
                                @else
                                <td><strong class="text-primary">Bình luận phản hồi</strong></td>
                                @endif
                                <td>{{ $comment->bl_noidung }}</td>
                                <td>{{ $comment->customer->kh_hovaten ?? $comment->admin->name }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td class="statusComment">
                                    @if($comment->trangthai == 0)
                                        <button class="btn btn-success confirmComment"
                                            data-id="{{ $comment->bl_id }}"
                                            data-url="{{ route('sup.product.confirmComment') }}">
                                            Duyệt
                                        </button>
                                        <button class="btn btn-danger deleteComment"
                                            data-id="{{ $comment->bl_id }}"
                                            data-url="{{ route('sup.product.deleteComment') }}">
                                            Xóa
                                        </button>
                                    @else
                                        <strong class="text-success">Đã duyệt</strong>
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
@endsection