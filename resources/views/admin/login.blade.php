@extends('admin.layout')

@section('window')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Witaj!</h1>
                  </div>

                  @foreach ($errors->all() as $message)
                    <div class="alert alert-danger">{{ $message }}</div>
                  @endforeach

                  <form class="user" method="POST" action="{{ action('Admin\LoginController@postLogin') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" required class="form-control form-control-user" placeholder="Adres email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" required class="form-control form-control-user" placeholder="Hasło" name="password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember">
                        <label class="custom-control-label" for="rememberMe">Zapamiętaj mnie</label>
                      </div>
                    </div>
                    <div>
                      <div class="g-recaptcha"
                          data-sitekey="{{ config('services.recaptcha.public') }}">
                      </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-user btn-block" value="Zaloguj">
                        Zaloguj
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endpush
