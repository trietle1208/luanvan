<div class="table-responsive">
    <table class="table table-borderless table-hover table-nowrap table-centered m-0">

        <thead class="table-light">
            <tr>
                <th colspan="2">Hình ảnh</th>
                <th>Loại</th>
                <th>Bảo hành</th>
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
                {{ $product->type->loaisp_ten }}
                </td>
                <td>
                    {{ $product->sp_thoigianbaohanh }} tháng
                </td>
                
            </tr>  
            @endforeach
        </tbody>
    </table>
</div>