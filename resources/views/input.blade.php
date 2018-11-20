<div class="form-group {{ isset($errors) ? ($errors->has($id) ? 'has-error': '' ) : '' }}">
	<label for="{{ $id }}" 
	@isset($custom)
	class="col-sm-{{$custom[0]}} control-label"
	@else
	class="col-sm-2 control-label" 
	@endisset>{{ $label }}</label>
	<div 
	@if(isset($size))
	class="col-sm-{{$size}}"
	@elseif(isset($custom))
	class="col-sm-{{$custom[1]}}"
	@else
	class="col-sm-6"
	@endif>
		<input 
		@isset($readonly) readonly="readonly" @endisset 
		@isset($required) required="required" @endisset 
		@isset($min) min="{{$min}}" @endisset 
		@isset($max) max="{{$max}}" @endisset 
		name="{{ isset($name) ? $name : (isset($array) ? $id.'[]' : $id) }}" 
		@isset($type)
		type="{{$type}}" 
		@else
		type="text" 
		@endisset
		class="form-control" 
		id="{{ $id }}" 
		placeholder="{{ $label }}" 
		value="{{ old($id) ? (!isset($name) ? (isset($array) ? old($id)[$index] : old($id)) : old($id)[$index]) : (isset($value) ? $value : '') }}">
		@if(isset($errors)) @if($errors->has($id))<span class="help-block">{{$errors->first($id)}}</span>@endif @endif
	</div>
</div>