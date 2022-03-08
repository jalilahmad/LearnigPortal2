@include('layout.partials.head')

@include('layout.partials.nav')
<br></br>
<br></br>
<br></br>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                    <form role="form" method="POST" action="{{ route("register") }}">
                        
                        @csrf

                        <div class="form-group row">
                            <label for="First_Name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="First_Name" type="text" class="form-control @error('FirstName') is-invalid @enderror" name="First_Name" value="{{ old('FirstName') }}" required autocomplete="FirstName" autofocus>

                                @error('FirstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="Last_Name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="Last_Name" type="text" class="form-control @error('Last_Name') is-invalid @enderror" name="Last_Name" value="{{ old('LastName') }}" required autocomplete="LastName" autofocus>
    
                                    @error('Last_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
        
                                        @error('user_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="Qualifications" class="col-md-4 col-form-label text-md-right">{{ __('Qualification') }}</label>
    
                                <div class="col-md-6">
                                    <input id="Qualifications" type="text" class="form-control @error('Qualifications') is-invalid @enderror" name="Qualifications" value="{{ old('Qualifications') }}" required autocomplete="Qualifications" autofocus>
    
                                    @error('Qualifications')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="Brief_Intro" class="col-md-4 col-form-label text-md-right">{{ __('Brief Introduction') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="Brief_Intro" type="text" class="form-control @error('Brief_Intro') is-invalid @enderror" name="Brief_Intro" value="{{ old('Brief_Intro') }}" required autocomplete="Brief_Intro" autofocus>
        
                                        @error('Brief_Intro')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br></br>

    @include('layout.partials.footer')

    @include('layout.partials.footer-scripts')