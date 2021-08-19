@extends('admin.layout')

@section('title')
    Danh mục sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 pt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">DANH SÁCH DANH MỤC BỊ XÓA</h4>
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
                                    <td class="text-primary">
                                        @if($category['dm_idcha'] == 0)
                                            Danh mục cha
                                        @else
                                            @foreach($category_parent as $parent)
                                                @if($parent['dm_id'] == $category['dm_idcha'])
                                                    {{ $parent['dm_ten'] }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $category['dm_mota'] }}</td>
                                    <td>
                                        <a href="" class="btn btn-info">Khôi phục</a>
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
