<div class="form-group {{ isset($errors) ? ($errors->has($id) ? 'has-error': '' ) : '' }}">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <input @isset($readonly) readonly="readonly" @endisset name="{{ isset($name) ? $name : $id }}" type="text" class="form-control" id="{{ $id }}" placeholder="{{ $label }}" value="{{ old($id) ? (!isset($name) ? old($id) : old($id)[$index]) : (isset($value) ? $value : '') }}">
    @if(isset($errors)) @if($errors->has($id))<span class="help-block">{{$errors->first($id)}}</span>@endif @endif
  </div>
</div>