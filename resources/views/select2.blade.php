{{-- {{ dd(old($id)) }} --}}
<div class="form-group">
  <label for="{{ $id }}" class="col-lg-2 control-label">{{ $label }}</label>
  <div class="col-sm-6">
    <select name="{{ isset($name) ? $name : $id.'[]' }}" type="text" class="form-control select2" multiple="multiple" id="{{ $id }}" data-placeholder="{{ $label }}" style="width: 100%;">
    	@foreach($selectData as $s)
    	<option  
    	@if(old($id)) 
    		@if(!isset($name))
                @foreach(old($id) as $d)
        			@if($d == $s['value'])
        				selected
        			@endif
                @endforeach
    		@else
    			@if(old($id)[$index] == $s['value'] )
    				selected
				@endif
			@endif
    	@elseif(isset($selected))
            @foreach($selected as $d)
        		@if($d == $s['value'])
        			selected
        		@endif
            @endforeach
    	@endif
    	" value="{{ $s['value'] }}">{{ $s['text'] }}</option>
    	@endforeach
    </select>
  </div>
</div>