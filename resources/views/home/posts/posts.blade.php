<div class="modal-dialog" role="document" style="width: 80vw">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="baiviet1">{{ $posts->bv_ten }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <style>
                    img {
                        display: block;
                        width: 80% !important;
                        height: auto !important;
                        object-fit: cover;
                        margin: 0 auto;
                    }
                </style>
                {!! $posts->bv_noidung !!}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
    </div>
</div>
