@isset($array)

<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <textarea name="{{ $id }}[]" type="text" class="form-control" id="{{ $id }}" placeholder="{{ $label }}">{{ old($id) ? (is_array(old($id)) ? old($id)[$index] : old($id)) : (isset($value) ? $value : '') }}</textarea>
  </div>
</div>

@else

<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <textarea readonly="readonly" name="{{ $id }}" type="text" class="form-control" id="{{ $id }}" placeholder="{{ $label }}">{{ old($id) ? old($id) : (isset($value) ? $value : '') }}</textarea>
  </div>
</div>

@endisset