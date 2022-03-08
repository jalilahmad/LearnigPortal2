@include('layout.partials.head')

@include('layout.partials.nav')
<br></br>
<br></br>
<br></br>
<br></br>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
      <div class="card">
          <div class="card-header">
              <center><h3>New Course</h3></center>
          </div>
        <div class="card-body">
              
              
            <form action="/create-step-one" method="post">
            {{ csrf_field() }}
              <div class="form-group">
                  <label for="FormControlInput1">Course Name</label>
                  <input name="course_title" value="{{ session()->get('course.course_title') }}" type="text" class="form-control" id="FormControlInput1" placeholder="Example - java , python , ..." maxlength="50" required>
                </div>
                <div class="form-group">
                  <label for="FormControlTextarea1">Course Description</label>
                  <textarea name="course_intro" value="{{ session()->get('course.course_intro') }}" class="form-control" id="FormControlTextarea1" rows="10" required></textarea>
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
        <button type="submit" class="btn btn-warning">Next</button>
            </form>
        </div>
      </div>
      </div>  
    </div>
</div>
<br></br>


                  


@include('layout.partials.footer')

@include('layout.partials.footer-scripts')