<div class="form-group row">
    <label class="col-sm-2 form-check-label text-right" for="radio{{ $form->name }}">{{ $form->getAttribute('placeholder') }}</label>

    @foreach ($form->values as $key => $value)
        <div class="form-check" style="padding-right: 0.3rem">
            <input class="form-check-input" type="radio" name="{{ $form->name }}" id="radio{{ $form->name }}{{ $key }}" value="{{ $key }}" @if ($form->value == $key) checked @endif>
            <label class="form-check-label" for="radio{{ $form->name }}{{ $key }}">
                {{ $value }}
            </label>
        </div>
    @endforeach
</div>
