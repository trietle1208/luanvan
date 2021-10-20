@extends('admin.layout')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH DANH MỤC</h4>
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
                                <th>Tên danh mục</th>
                                <th>Thuộc danh mục</th>
                                <th>Mô tả</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category['dm_id'] }}</th>
                                    <td>{{ $category['dm_ten'] }}</td>
                                        @if($category['dm_idcha'] == 0)
                                        <td class="text-danger">
                                            Danh mục cha
                                        </td>
                                        @else
                                            @foreach($category_parent as $parent)
                                                @if($parent['dm_id'] == $category['dm_idcha'])
                                                <td class="text-primary">
                                                    {{ $parent['dm_ten'] }}
                                                </td>
                                                @endif
                                            @endforeach
                                         @endif
                                    <td>{{ $category['dm_mota'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.cate.edit', ['id' => $category->dm_id]) }}" class="btn btn-info">Chỉnh sửa</a>
{{--                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{ route('admin.cate.delete', ['id' => $category->dm_id]) }}" class="btn btn-danger">Xóa</a>--}}
                                        <a href="{{ route('admin.cate.delete', ['id' => $category->dm_id]) }}" class="btn btn-danger delete-cate" data-url="{{ route('admin.cate.delete', ['id' => $category->dm_id]) }}" >Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div> <!-- end table-responsive-->
                </div>

            </div> <!-- end card -->
            {{$categories->links()}}
        </div> <!-- end col -->

    </div>

@endsection
