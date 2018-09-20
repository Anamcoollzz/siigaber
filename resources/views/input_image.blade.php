<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <input @isset($readonly) readonly="readonly" @endisset name="{{ isset($name) ? $name : $id }}" type="file" accept="image/*" class="form-control" id="{{ $id }}" placeholder="{{ $label }}" value="{{ old($id) ? (!isset($name) ? old($id) : old($id)[$index]) : (isset($value) ? $value : '') }}">
  </div>
</div>