@extends('create-form')
@section('other-box')
<div class="alert alert-info">
	Jika password dikosongi maka tetap seperti sebelumnya alias tidak diubah
</div>
@endsection
@section('form')
@method('PUT')
@include('input',['id'=>'nama','label'=>'Nama','value'=>$d->nama])
@include('input',['id'=>'username','label'=>'Username','value'=>$d->username])
@include('input_pass')
@include('input_pass_conf')
@include('select',['id'=>'role','label'=>'Role','selectData'=>$listRole,'selected'=>$d->role])
@endsection