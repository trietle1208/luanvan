<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm quyền vào vai trò</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('sup.role.storePermission',['id' => $role->id]) }}" method="POST">
            @csrf
            <div class="modal-body">

                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" name="permission[]" type="checkbox"
                                   value="{{ $permission->id }}" id="flexCheckDefault_{{$permission->id}}"
                            {{ $role->permissions->contains($permission->id) ? "checked" : "" }}>
                            <label class="form-check-label" for="flexCheckDefault_{{$permission->id}}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
