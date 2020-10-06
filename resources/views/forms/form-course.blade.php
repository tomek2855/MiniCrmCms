<section id="formularz">
    <div class="container">
        <div class="section-title"><i class="fas fa-align-justify">&nbsp;</i>Formularz</div>
        <hr>

        <div class="row">
            <div class="col-lg-4">
                Soooo beautifull HTML
            </div>
            <div class="col-lg-8">
                <form method="POST" action="{{ action('Web\FormController@postCourse') }}">
                    @csrf

                    @error('first_name', 'last_name', 'email', 'number', 'address_number', 'address_street', 'address_city', 'address_zipcode', 'pesel', 'course_id', 'g-recaptcha-response')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if ($errors->has('g-recaptcha-response'))
                        <div class="alert alert-danger">{{ \App\Rules\ReCaptchaValidator::getMessage() }}</div>
                    @endif

                    @if ($errors->has('pesel'))
                        <div class="alert alert-danger">{{ \App\Rules\PeselValidator::getMessage() }}</div>
                    @endif

                    @if (session()->has('course-success'))
                        <div class="alert alert-success">{{ session()->get('course-success', 'Ok') }}</div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="first_name">Imię</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required value="{{ old('first_name') }}">
                            </div></div>
                        <div class="col">
                            <div class="form-group">
                                <label for="last_name">Nazwisko</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required value="{{ old('last_name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required value="{{ old('email') }}">
                            </div></div>
                        <div class="col">
                            <div class="form-group">
                                <label for="number">Nr telefonu</label>
                                <input type="text" class="form-control" name="number" id="number" required value="{{ old('number') }}">
                            </div></div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <label for="address_number">Numer domu/mieszkania</label>
                            <input type="text" class="form-control" name="address_number" id="address_number" required value="{{ old('address_number') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="address_street">Ulica</label>
                            <input type="text" class="form-control" name="address_street" id="address_street" value="{{ old('address_street') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="address_city">Miejscowość</label>
                            <input type="text" class="form-control" name="address_city" id="address_city" required value="{{ old('address_city') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="address_zip_code">Kod pocztowy</label>
                            <input type="text" class="form-control" name="address_zipcode" id="address_zip_code" required value="{{ old('address_zipcode') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pesel">Pesel</label>
                        <input type="text" class="form-control" name="pesel" id="pesel" required value="{{ old('pesel') }}" onkeypress="checkPesel()" onchange="checkPesel()">
                        <small id="pesel-info" style="display: none; color: red;">Podany PESEL jest nieprawidłowy!</small>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="course_id">Kurs</label>
                                <select type="select" class="form-control" name="course_id" id="course_id" required>
                                    <?php foreach ($courses as $key => $course): ?>
                                        <option value="{{ $key }}" @if(old('course_id') == $key) selected="selected" @endif>{{ $course }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="g-recaptcha"
                                    data-sitekey="{{ config('services.recaptcha.public') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <button id="send-join-form" class="button" style="margin-top: 22px; min-width: 100px;">Wyślij</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        setInterval(checkPesel, 1000);

        function isValidPesel(pesel) {
            if(typeof pesel !== 'string')
                return false;

            if (pesel.length != 11) return false;

            let weight = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
            let sum = 0;
            let controlNumber = parseInt(pesel.substring(10, 11));
            for (let i = 0; i < weight.length; i++) {
                sum += (parseInt(pesel.substring(i, i + 1)) * weight[i]);
            }
            sum = sum % 10;
            return 10 - sum === controlNumber;
        }

        function checkPesel() {
            let pesel = $('#pesel').val();

            if (pesel.length == 0) return;

            if (isValidPesel(pesel)) {
                $('#pesel-info').hide();
                $('#send-join-form').removeAttr("disabled");
            } else {
                $('#pesel-info').show();
                $('#send-join-form').attr("disabled", true);
            }
        }
    </script>
</section>
