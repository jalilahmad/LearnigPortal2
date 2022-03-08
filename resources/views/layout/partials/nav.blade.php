<div class="super_container">
<header class="header d-flex flex-row">
    <div class="header_content d-flex flex-row align-items-center">
        <!-- Logo -->
        <div class="logo_container">
            <div class="logo">
                <img src="images/logo.png" alt="">
                <span>course</span>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="main_nav_container">
            <div class="main_nav">
                <ul class="main_nav_list">
                @if(Auth::user())
                <li class="main_nav_item"><a href="/home">Profile</a></li>
                @endif
                    <li class="main_nav_item"><a href="/">home</a></li>
                    <li class="main_nav_item"><a href="/courses">courses</a></li>
                    <li class="main_nav_item"><a href="contact.html">contact</a></li>
                    <li class="main_nav_item"><a href="#">about us</a></li>
                    @if(!Auth::guest())
                        <li class="main_nav_item"><span><a href="{{route('logout')}}">Logout</a></span></li>
                        
                        <li class="main_nav_item"><span><a href="{{route('home')}}">{{Auth::user()->user_name}}</a></span></li>
                      
                    @else
                    <li class="main_nav_item"><span><a href="register">Sign UP</a></span></li>
                    <li class="main_nav_item"><a href="" data-target="#login" data-toggle="modal">Log in</a></li>
                    @endif

                </ul>
            </div>
        </nav>
    </div>
    <div class="header_side d-flex flex-row justify-content-center align-items-center">
        <img src="images/phone-call.svg" alt="">
        <span>+93 790 062 330</span>
    </div>

    <!-- Hamburger -->
    <div class="hamburger_container">
        <i class="fas fa-bars trans_200"></i>
    </div>
</header>


<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-body" style="background-color:#ffb606">
          <button data-dismiss="modal" class="close">&times;</button>
          <h4 style="color:white">Login </h4>
          <form method="POST" action="{{route('login')}}" name="login">
            @csrf
            <input type="email" name="email" class="username form-control" placeholder="E-mail"/>
            <input type="password" name="password" class="password form-control" placeholder="password"/>
            <br></br>
            <button type="submit" style="background-color:white; border:none" class="button button_line_2 text-center trans_200">Log in</button>
            <a href="{{route('password.request')}}"><button type="button" style="background-color:white; border:none" class="button button_line_2 text-center trans_200">Forget My Password</button></a>
          </form>
        </div>
      </div>
    </div>
  </div>
  

  