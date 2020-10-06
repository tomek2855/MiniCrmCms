<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right" for="input{{ $form->name }}">{{ $form->getAttribute('placeholder') }}</label>
    <div class="form-group row col-sm-7">
        <input type="{{ $form->type }}" id="input{{ $form->name }}" class="form-control form-control-user" @if ($form->getAttribute('required')) required @endif placeholder="{{ $form->getAttribute('placeholder') }}" name="{{ $form->name }}" value="{{ $form->value }}">
    </div>
</div>
