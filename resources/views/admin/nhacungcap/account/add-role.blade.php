<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Gán vai trò cho tài khoản</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('sup.account.storeRole',['id' => $user->id]) }}" method="POST">
            @csrf
            <div class="modal-body">

                    @foreach($roles as $role)
                        <div class="form-check">
                            <input class="form-check-input" name="role[]" type="checkbox"
                                   value="{{ $role->id }}" id="flexCheckDefault_{{$role->id}}"
                            {{ $user->roles->contains($role->id) ? "checked" : "" }}>
                            <label class="form-check-label" for="flexCheckDefault_{{$role->id}}">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
