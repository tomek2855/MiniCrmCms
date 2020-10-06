@extends('admin.index')

@section('content-title')
    Formularze / Kursy
@endsection

@section('content')
    {{ $table->generate() }}
@endsection
