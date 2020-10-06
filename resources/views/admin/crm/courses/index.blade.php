@extends('admin.index')

@section('content-title')
    CRM / Kursy
@endsection

@section('content-links')
    <a href="/admin/crm/courses/add" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj kurs</a>
@endsection

@section('content')
    {!! $table->generate() !!}
@endsection
