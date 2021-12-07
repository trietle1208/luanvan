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
                    <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <!-- <th>Tên sản phẩm</th> -->
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
                                <!-- <td>{{ $comment->product->sp_ten }}</td> -->
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
                                <td>
                                    <p>{{ $comment->bl_noidung }}</p>
                                    @if($comment->bl_hinhanh != null)
                                        <img src="{{ $comment->bl_hinhanh}}" style="width: 200px; height: 100px" class="img-fuild">
                                    @endif
                                    <div id="formRep_{{ $comment->bl_id }}" style="display: none">
                                        <textarea class="form-control" id="textForm_{{ $comment->bl_id }}" rows="3" placeholder="Viết phản hồi cho bình luận">

                                        </textarea>
                                        <br>
                                        <button class="btn btn-secondary btn-sm closeForm" data-id="{{ $comment->bl_id }}">Đóng</button>

                                        <button class="btn btn-success btn-sm sendForm" 
                                                data-id="{{ $comment->bl_id }}"
                                                data-sp="{{ $comment->product->sp_id }}"
                                                data-url="{{ route('sup.product.repComment') }}"
                                        >Gữi</button>
                                    </div>
                                    
                                </td>
                                <td>{{ $comment->customer->kh_hovaten ?? $comment->admin->name }}</td>
                                <td>{{ $comment->created_at }}</td>
                                <td class="statusComment text-center ">
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
                                        <strong class="text-success ">Đã duyệt</strong><hr>
                                        <button class="btn btn-sm btn-primary list-repComment"
                                                data-id="{{ $comment->bl_id }}"
                                                data-url="{{ route('sup.product.listRepComment') }}"        
                                        ><i class="fe-align-left"></i></button>
                                        <button class="btn btn-sm btn-info repComment"
                                                data-id="{{ $comment->bl_id }}"
                                                data-url="{{ route('sup.product.repComment') }}"        
                                        ><i class="fe-edit"></i></button>
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
<div class="modal fade" id="listRepComment">
  
</div>
@endsection