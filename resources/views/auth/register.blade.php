@include('layout.partials.head')

@include('layout.partials.nav')
<br></br>
<br></br>
<br></br>


 

    <div class="container register" style="background-color:#ffb606; background-image:none">
        <div class="row">
            <div class="col-md-3 register-left" style="background-color:#ffb606; background-image:none">
                <img src="{{asset('images\logo.png')}}" alt=""/>
                <h3>Welcome</h3>
                <p>You are 30 seconds away from Account on your own E-learning System!</p>
                <input type="submit" name="" value="Login"/><br/>
            </div>
            <div class="col-md-9 register-right">
               
                <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Sign Up</h3>
                        <form method="POST" name="register" action="{{route('register')}}">
                            @csrf
                        <div class="row register-form">
                            <div class="col-md-6">  
                                <div class="form-group">
                                    <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name *" value="" />
                                </div>
                                <div class="form-group">
                                        <input type="text" id="name" class="form-control" name="name" placeholder="User Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="Register" class="form-control"  value="register" />
                                    </div>
                                    <div class="form-group">
                                    <input type="radio" id="Teacher" name="account_type" value="1">
                                    <label for="Teacher">Teacher</label><br>
                                    <input type="radio" id="2"name="account_type" value="2">
                                    <label for="Learner">Learner</label>
                                 </div>  
                                  
                                    
                                            
                               
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Your Email *" value="" />
                                </div>
                                <div class="form-group">
                                        <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="Confirm Password *" value="" />
                                    </div>
                               
                               
                                
                                <input type="submit" class="btnRegister" name="register" value="Sign Up"/>
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

<br></br>

    @include('layout.partials.footer')

    @include('layout.partials.footer-scripts')