<div class="form-group">
	<label for="{{ $id }}" 
	@isset($custom)
	class="col-lg-{{$custom[0]}} control-label"
	@else
	class="col-lg-2 control-label" 
	@endisset>{{ $label }}</label>
	<div 
	@if(isset($size))
	class="col-sm-{{$size}}"
	@elseif(isset($custom))
	class="col-sm-{{$custom[1]}}"
	@else
	class="col-sm-6"
	@endif>
	<input data-toggle="datepicker" name="{{ isset($name) ? $name : $id }}" type="text" class="form-control" id="{{ $id }}" placeholder="{{ $label }}" value="{{ old($id) ? (!isset($name) ? old($id) : old($id)[$index]) : (isset($value) ? $value : '') }}" @isset($required) required="required" @endisset>
</div>
</div>