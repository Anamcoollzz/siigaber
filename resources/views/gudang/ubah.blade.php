@extends('create-form')
@section('form')
@method('PUT')
@include('input',['id'=>'nama','label'=>'Nama','value'=>$d->nama])
@include('input_number',['id'=>'kapasitas','label'=>'Kapasitas','value'=>$d->kapasitas])
@include('textarea',['id'=>'lokasi','label'=>'Lokasi','value'=>$d->lokasi])
@endsection