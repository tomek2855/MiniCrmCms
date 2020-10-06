@extends('admin.index')

@section('content-title')
    Formularze / Kontaktowe
@endsection

@section('content')
    {{ $table->generate() }}
@endsection
