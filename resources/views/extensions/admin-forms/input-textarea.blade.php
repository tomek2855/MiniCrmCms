<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right" for="textarea{{ $form->name }}">{{ $form->getAttribute('placeholder') }}</label>
    <div class="form-group row col-sm-7">
        <textarea class="form-control form-control-user" id="textarea{{ $form->name }}" @if ($form->getAttribute('required')) required @endif placeholder="{{ $form->getAttribute('placeholder') }}" name="{{ $form->name }}">{{ $form->value }}</textarea>
    </div>
</div>
