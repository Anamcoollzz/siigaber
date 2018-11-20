@extends('create-form')
@section('form')
@method('PUT')
@include('input',['id'=>'nama','label'=>'Nama','value'=>$d->nama])
@endsection