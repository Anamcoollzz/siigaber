<div class="form-group {{ isset($errors) ? ($errors->has('password_confirmation') ? 'has-error': '' ) : '' }}">
  <label for="password_confirmation" class="col-lg-2 control-label">Konfirmasi Password</label>
  <div class="col-sm-6">
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Konfirmasi Password" value="{{ old('password_confirmation') }}">
    @if(isset($hint)) <small><span class="text-muted">{{ $hint }}</span></small> @endif
    @if(isset($errors)) @if($errors->has('password_confirmation'))<span class="help-block">{{$errors->first('password_confirmation')}}</span>@endif @endif
  </div>
</div>