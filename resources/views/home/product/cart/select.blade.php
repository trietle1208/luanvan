    <option value="0">Không chọn mã</option>
@foreach($voucher_has_deleted as $row)
    <option value="{{ $row['mgg_id'] }}" id="voucher_{{ $row['mgg_id'] }}">{{ $row['mgg_ten'] }}</option>
@endforeach
