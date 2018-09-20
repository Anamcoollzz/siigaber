<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-{{ isset($size) ? $size : 6 }}">
    <input data-toggle="datepicker" name="{{ isset($name) ? $name : $id }}" type="text" class="form-control" id="{{ $id }}" placeholder="{{ $label }}" value="{{ old($id) ? (!isset($name) ? old($id) : old($id)[$index]) : (isset($value) ? $value : '') }}" @isset($required) required="required" @endisset>
  </div>
</div>