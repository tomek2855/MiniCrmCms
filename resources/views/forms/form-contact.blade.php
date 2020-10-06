<section id="kontakt">
    <div class="container">
        Soooo beautifull HTML
        <div class="row">
            <div class="col-lg-6 col-md-12" id="write-mail">
                <h3>Napisz do nas:</h3>

                <form method="POST" action="{{ action('Web\FormController@postContact') }}">
                    @csrf

                    @error('name', 'email', 'content', 'g-recaptcha-response')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if ($errors->has('g-recaptcha-response') && !strpos(url()->current(), 'formularz-zgloszeniowy'))
                        <div class="alert alert-danger">{{ \App\Rules\ReCaptchaValidator::getMessage() }}</div>
                    @endif

                    @if (session()->has('contact-success'))
                        <div class="alert alert-success">{{ session()->get('contact-success', 'Ok') }}</div>
                    @endif

                    <div class="form-group">
                        <label for="name">Imię i Nazwisko</label>
                        <input type="text" class="form-control" name="name" id="name" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Treść wiadomości</label>
                        <textarea class="form-control" name="content" id="content" value="{{ old('content') }}" required></textarea>
                    </div>

                    <div class="row">
                        <div class="form-group col-9 col-md-9 ">
                            <div class="g-recaptcha"
                                data-sitekey="{{ config('services.recaptcha.public') }}">
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <button class="button" style="min-width: 100px;">Wyślij</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>
