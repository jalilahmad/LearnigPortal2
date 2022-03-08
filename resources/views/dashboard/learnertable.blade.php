<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/all.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
        {{Auth::user()->first_name}}
          <!-- <div class="logo-image-big">
            <img src="assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./home">
            <i class="far fa-columns"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="{{url('/')}}">
            <i class="far fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li>
            @if(Auth::user()->hasRole('admin'))
              <a href="{{url('/teacher-table')}}">
              @else
              <a href="{{url('/teachers')}}">
                @endif
                <i class="far fa-chalkboard-teacher"></i>
              <p>Teachers</p>
            </a>
          </li>
          <li class="active ">
            @if(Auth::user()->hasRole('admin'))
            <a href="{{url('learner-table')}}">
            <i class="far fa-user-graduate"></i>
              <p>Learners</p>
            </a>
          </li>
            @endif
          <li>
            @if(Auth::user()->hasRole('admin'))
              <a href="{{url('/course-table')}}">
              @else
              <a href="{{url('courses')}}">
              @endif
              <i class="far fa-books"></i>
              <p>Courses</p>
            </a>
          </li>
          <li>
              @if(Auth::user()->hasRole('admin'))
            <a href="{{url('/episode-table')}}">
            <i class="far fa-book"></i>
              <p>Episodes</p>
            </a>
          </li>
          <li>
            <a href="{{url('/unapproved-table')}}">
            <i class="far fa-badge-check"></i>
              <p>Unapproved</p>
            </a>
          </li>
            @endif
            @if(Auth::user()->hasRole('learner'))
            <li>
            <a href="{{url('/bookmarks')}}">
            <i class="far fa-bookmark"></i>
              <p>Saved Courses</p>
            </a>
            </li>
            <li>
            <a href="{{url('/watchlist')}}">
            <i class="far fa-list-ul"></i>
              <p>WatchList</p>
            </a>
            </li>
            @endif
            @if(Auth::user()->hasRole('teacher'))
            <li>
            <a href="{{url('/create-step-one')}}">
            <i class="far fa-file-plus"></i>
              <p>Create Course</p>
            </a>
            </li>
            <li>
            <a href="{{url('/my-courses')}}">
            <i class="far fa-book"></i>
              <p>My Courses</p>
            </a>
            </li>
            @endif
            
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form action="{{url('/search')}}" method="post">
            @csrf
              <div class="input-group no-border">
                <input name="search-query" type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                  <i class="far fa-search"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-user-cog"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Learner List</h4>
              </div>
              
                
                
                    <iframe src="/learners-list" style="border:none;height:800px" title="Iframe Example"></iframe>
                    
              
            
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Sebghatullah Shahnan
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assetsassets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>
