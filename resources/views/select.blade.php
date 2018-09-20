<div class="form-group">
  <label for="{{ $id }}" class="col-lg-{{ isset($size) ? (is_array($size) ? $size[0] : 2) : 2 }} control-label">{{ $label }}</label>
  <div class="col-sm-{{ isset($size) ? (is_array($size) ? $size[1] : 6) : 6 }}">
    <select name="{{ isset($name) ? $name : $id }}" type="text" class="form-control" id="{{ $id }}">
    	@foreach($selectData as $s)
    	<option  
    	@if(old($id)) 
    		@if(!isset($name))
    			@if(old($id) == $s['value'])
    				selected
    			@endif
    		@else
    			@if(old($id)[$index] == $s['value'] )
    				selected
				@endif
			@endif
    	@elseif(isset($selected))
    		@if($selected == $s['value'])
    			selected
    		@endif
    	@endif
    	" value="{{ $s['value'] }}">{{ $s['text'] }}</option>
    	@endforeach
    </select>
  </div>
</div>