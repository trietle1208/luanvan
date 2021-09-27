@extends('admin.layout')

@section('title')
    Thông tin cá nhân
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Thông tin cá nhân</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">

                    <h4 class="mb-0">Geneva McKnight</h4>
                    <p class="text-muted">@webdesigner</p>

                    <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                    <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button>

                    <div class="text-start mt-3">
                        <p class="text-muted mb-2 font-13"><strong>Họ và tên:</strong> <span class="ms-2">Geneva D. McKnight</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Số điện thoại :</strong><span class="ms-2">(123) 123 1234</span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2">user@email.domain</span></p>

                        <p class="text-muted mb-1 font-13"><strong>Địa chỉ :</strong> <span class="ms-2">USA</span></p>
                    </div>


                </div>
            </div> <!-- end card -->



        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg">

                        <li class="nav-item">
                            <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                Cập nhật thông tin
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- end about me section content -->

                        <!-- end timeline content-->

                        <div class="" id="">
                            <form action="{{ route('sup.account.store_info') }}" method="post">
                                @csrf
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Thông tin cá nhân</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control"
                                                   id="firstname"
                                                   value="{{ $name->name }}"
                                                   placeholder="Nhập vào họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            @if(empty($name->info->tt_gioitinh))
                                                <label for="lastname" class="form-label">Giới tính</label><br>
                                                <input type="radio" id="html" name="sex" value="0">
                                                <label for="html">Nam</label><br>
                                                <input type="radio" id="css" name="sex" value="1">
                                                <label for="css">Nữ</label><br>
                                            @elseif($name->info->tt_gioitinh == 0)
                                                <label for="lastname" class="form-label">Giới tính</label><br>
                                                <input checked type="radio" id="html" name="sex" value="0">
                                                <label for="html">Nam</label><br>
                                                <input type="radio" id="css" name="sex" value="1">
                                                <label for="css">Nữ</label><br>
                                            @elseif($name->info->tt_gioitinh == 1)
                                                <label for="lastname" class="form-label">Giới tính</label><br>
                                                <input  type="radio" id="html" name="sex" value="0">
                                                <label for="html">Nam</label><br>
                                                <input checked type="radio" id="css" name="sex" value="1">
                                                <label for="css">Nữ</label><br>
                                            @endif
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="userbio" class="form-label">Địa chỉ</label>
                                            <input class="form-control"
                                                   required
                                                   id="userbio"
                                                   name = "address"
                                                   value="{{ $name->info->tt_diachi ?? '' }}"
                                                   placeholder="Nhập vào địa chỉ">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="userbio" class="form-label">Số điện thoại</label>
                                            <input class="form-control" id="userbio"
                                                   required
                                                   name = "phone"
                                                   value="{{ $name->info->tt_sdt ?? '' }}"
                                                   placeholder="Nhập vào số điện thoại">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Ngày sinh</label>
                                            <input type="date" class="form-control"
                                                   required
                                                   name = "age"
                                                   id="useremail"
                                                   value="{{ $name->info->tt_ngaysinh ?? '' }}"
                                                   placeholder="Nhập vào họ và tên">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Chức vụ</label><br>
                                            @foreach($roles as $role)
                                            <strong>- {{ $role }}</strong><br>
                                            @endforeach
                                        </div>
                                    </div>

                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success save-info"><i class=""></i> Lưu</button>

                                    </div>
                                </div> <!-- end row -->
                            </form>
                            @role('Admin nhà cung cấp')
                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Thông Tin Nhà Cung Cấp</h5>
                                <form action="{{ route('sup.account.store_ncc') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="companyname" class="form-label">Tên Nhà Cung Cấp</label>
                                                <input type="text" name="name" value="{{ $ncc->ncc_ten }}" class="form-control" id="companyname" placeholder="Enter company name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cwebsite" class="form-label">Địa chỉ</label>
                                                <input type="text" name="address" value="{{ $ncc->ncc_diachi }}" class="form-control" id="cwebsite" placeholder="Enter website url">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cwebsite" class="form-label">Mô tả</label>
                                                <input type="text" name="desc" value="{{ $ncc->ncc_mota }}" class="form-control" id="cwebsite" placeholder="Enter website url">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cwebsite" class="form-label">Số điện thoại</label>
                                                <input type="text" name="phone" value="{{ $ncc->ncc_sdt }}" class="form-control" id="cwebsite" placeholder="Enter website url">
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cwebsite" class="form-label">Hình ảnh</label>
                                                @if($ncc->ncc_hinhanh != null)
                                                <img src="{{ $ncc->ncc_hinhanh}}" style="width: 600px; height: 100%" ><br><br>
                                                @else
                                                    <img src="" ><br><br>
                                                @endif
                                                <input type="file" name="image">
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success"><i class=""></i> Lưu</button>
                                        </div>
                                    </div> <!-- end row -->
                                </form>
                            @endrole
                        </div>
                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->

    </div>

@endsection
