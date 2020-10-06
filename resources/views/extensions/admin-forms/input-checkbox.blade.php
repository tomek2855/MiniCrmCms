<div class="form-group row">
    <label class="col-sm-2 form-check-label text-right" for="checkbox{{ $form->name }}">{{ $form->getAttribute('placeholder') }}</label>
    <input type="checkbox" class="form-group-input" id="checkbox{{ $form->name }}" name="{{ $form->name }}" @if ($form->value) checked @endif>
</div>
