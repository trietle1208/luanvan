<div class="table-responsive">
                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                <thead class="table-light">
                                    <tr>
                                        <th colspan="2">Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Loại</th>
                                        <th>Bảo hành</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ $product->sp_hinhanh }}" alt="contact-img" title="contact-img" class="rounded-circle avatar-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 fw-normal">{{ $product->sp_ten }}</h5>
                                            <p class="mb-0 text-muted"><small>{{ $product->created_at }}</small></p>
                                        </td>
                                        <td>
                                            {{ number_format($product->sp_giabanra) }} VNĐ
                                        </td>
                                        <td>
                                        {{ $product->type->loaisp_ten }}
                                        </td>
                                        <td>
                                            {{ $product->sp_thoigianbaohanh }} tháng
                                        </td>
                                        <td>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-light"><i class="mdi mdi-plus"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>