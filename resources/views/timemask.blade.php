<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <input name="{{ isset($name) ? $name : $id }}" type="text" class="form-control" id="{{ $id }}" value="{{ old($id) ? (!isset($name) ? old($id) : old($id)[$index]) : (isset($value) ? $value : '') }}" data-inputmask="'alias': 'hh:mm:ss'" data-mask>
  </div>
</div>