@extends('create-form')
@section('form')
@method('put')
@include('input',['value'=>Auth::user()->nama_lengkap,'id'=>'nama_lengkap','label'=>'Nama Lengkap'])
@include('input',['value'=>Auth::user()->jabatan,'id'=>'jabatan','label'=>'Jabatan'])
@include('input_email',['value'=>Auth::user()->email,'id'=>'email','label'=>'Email'])
@include('input_password',['id'=>'password','label'=>'Password','hint'=>'* Jika password dikosongi maka tidak akan diubah'])
@endsection