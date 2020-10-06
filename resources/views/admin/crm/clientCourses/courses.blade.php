@extends('admin.index')

@section('content-title')
    Klient {{ $client->getFullName() }} - kursy
@endsection

@section('content-links')
        <a href="{{ $clientUrl }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-info fa-sm text-white-50"></i> Powrót</a>
@endsection

@section('content')
    @error('*')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {!! $table->generate() !!}
@endsection
