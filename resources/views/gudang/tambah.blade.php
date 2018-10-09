@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama'])
@include('input_number',['id'=>'kapasitas','label'=>'Kapasitas'])
@include('textarea',['id'=>'lokasi','label'=>'Lokasi'])
@endsection