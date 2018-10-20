@extends('create-form')
@section('form')
@include('input',['id'=>'nama','label'=>'Nama'])
@include('input',['id'=>'bidang','label'=>'Bidang'])
@include('input',['id'=>'kontak','label'=>'Kontak'])
@include('textarea',['id'=>'deskripsi','label'=>'Deskripsi'])
@include('textarea',['id'=>'alamat','label'=>'Alamat'])
@endsection