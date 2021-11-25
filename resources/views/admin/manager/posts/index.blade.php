@extends('admin.layout')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH BÀI VIẾT</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="basic-datatable">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên bài viết</th>
                                <th>Hình ảnh</th>
                                <th>Thuộc danh mục</th>
                                <th>Slug</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post['bv_id'] }}</th>
                                    <td>{{ $post['bv_ten'] }}</td>
                                    <td><img src="{{ $post['bv_hinhanh'] }}" style="width: 200px; height: 150px" class="img-fluid"></td>
                                    <td><strong>{{ $post->cateposts->dmbv_ten }}</strong></td>
                                    <td>{{ $post->bv_slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', ['id' => $post->bv_id]) }}" class="btn btn-info">Chỉnh sửa</a>
{{--                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{ route('admin.cate.delete', ['id' => $category->dm_id]) }}" class="btn btn-danger">Xóa</a>--}}
                                        <a href="{{ route('admin.posts.delete', ['id' => $post->bv_id]) }}" class="btn btn-danger delete-cate" data-url="{{ route('admin.posts.delete', ['id' => $post->bv_id]) }}" >Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>

            </div> <!-- end card -->
{{--            {{$categories->links()}}--}}
        </div> <!-- end col -->

    </div>

@endsection
