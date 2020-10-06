@extends('admin.index')

@section('content-title')
    @if (strpos(url()->current(), 'edit'))
        Edytuj klienta
    @else
        Dodaj klienta
    @endif
@endsection

@section('content-links')
    @if (strpos(url()->current(), 'edit'))
        <a href="{{ $coursesUrl }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-info fa-sm text-white-50"></i> Kursy</a>
        <a href="{{ $deleteUrl }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#deleteCrmClientModal"><i class="fas fa-trash fa-sm text-white-50"></i> Usuń klienta</a>

        @push('modals')
            <div class="modal fade" id="deleteCrmClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Na pewno usunąć?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Zamknij">
                            <span aria-hidden="true">×</span>
                        </button>
                        </div>
                    <div class="modal-footer" style="border-top: 0">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Anuluj</button>
                        <form action="{{ $deleteUrl }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Usuń</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        @endpush
    @endif
@endsection

@section('content')
    @error('*')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {!! $form->generate($url) !!}
@endsection
