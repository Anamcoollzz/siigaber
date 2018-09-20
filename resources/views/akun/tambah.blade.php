@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama'])
@include('input',['id'=>'username','label'=>'Username'])
@include('input_pass')
@include('input_pass_conf')
@include('select',['id'=>'role','label'=>'Role','selectData'=>$listRole])
@endsection