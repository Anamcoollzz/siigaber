<div class="form-group {{ isset($errors) ? ($errors->has('password') ? 'has-error': '' ) : '' }}">
  <label for="password" class="col-lg-2 control-label">Password</label>
  <div class="col-sm-6">
    <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="{{ old('password') }}">
    @if(isset($hint)) <small><span class="text-muted">{{ $hint }}</span></small> @endif
    @if(isset($errors)) @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span>@endif @endif
  </div>
</div>