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
              <center><h3>Step 2 of 3</h3></center>
          </div>
          <div class="card-body">
    @if(isset($course->course_image))
        Course Image:
        <img alt="Course Image" src="/storage/course_image/{{$course->course_image}}"/>
        @endif
        <form action="/create-step-two" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h3>Upload course Image</h3><br/><br/>

            <div class="form-group">
            <input name="course_image" type="file" class="custom-file-input" id="customFile"  {{ (!empty($course->course_image)) ? "disabled" : ''}}>
                  <label class="custom-file-label" for="customFile">Course Image</label><br></br>
                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
            </div>

                <button type="submit" class="btn btn-warning">Next</button> 
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                </div>
            @endif
        </form><br/>
        @if(isset($course->course_image))
        <form action="/remove-image" method="post">
            {{ csrf_field() }}
        <button type="submit" class="btn btn-danger">Remove Image</button>
        </form>
        @endif
    </div>
    </div>
    </div>
    </div>
<br></br>


@include('layout.partials.footer')

@include('layout.partials.footer-scripts')