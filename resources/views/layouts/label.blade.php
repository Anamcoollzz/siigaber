@if($label[0] || $label[1])
<span class="pull-right-container">
	{{-- @if($label[2]) <small class="label pull-right bg-green">{{$label[2]}}</small> @endif --}}
	@if($label[1]) <small class="label pull-right bg-yellow">{{$label[1]}}</small> @endif
	@if($label[0]) <small class="label pull-right bg-red">{{$label[0]}}</small> @endif
</span>
@endif