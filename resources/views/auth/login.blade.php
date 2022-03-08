@include('layout.partials.head')

@include('layout.partials.nav')
<br></br>
<br></br>
<br></br>


 

    <div class="container register" style="background-color:#ffb606; background-image:none">
        <div class="row">
            <div class="col-md-3 register-left" style="background-color:#ffb606; background-image:none">
                <img src="{{asset('images\logo.png')}}" alt=""/>
                <h3>Login</h3>
                <p>You are 30 seconds away from Account on your own E-learning System!</p>
                <input type="submit" name="" value="Login"/><br/>
            </div>
            <div class="col-md-9 register-right">
               
                <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <form method="POST" name="register" action="" aria-label="{{ __('Login') }}">
                            @csrf
                        <div class="row register-form">
                           
                            <div class="col-md-6">
                            <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Your Email *" value="" />
                                </div>
                                <div class="form-group">
                                        <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password *" value="" />
                                    </div>
                                    <input type="submit" class="btnRegister" name="register" value="Login"/>
                                    <div class="form-group">
                                        <input type="hidden" name="Register" class="form-control"  value="register" />
                                    </div>
                        </div>
                        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                    </form>
                    </div>  
                </div>
            </div>
        </div>

    </div>
</div>
<br></br>

    @include('layout.partials.footer')

    @include('layout.partials.footer-scripts')

