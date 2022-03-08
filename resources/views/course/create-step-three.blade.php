@include('layout.partials.head')

@include('layout.partials.nav')
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</head>
<br></br>
<br></br>
<br></br>
<br></br>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
      <div class="card">
          <div class="card-header">
              <center><h3>Step 3 of 3</h3></center>
          </div>
        <div class="card-body">
              
              
            <form action="/create-step-three" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div  id="episode-container">
                  <h3>Episode Video</h3>
                  <div class="form-group">
                  <label for="FormControlInput1">Episode Name</label>
                  <input name="episode_title" type="text" class="form-control" placeholder="Example - java , python , ..." maxlength="50" required>
                  </div>
                  <div class="form-group">
                  <label for="FormControlTextarea1">Episode Description</label>
                  <textarea name="episode_description" class="form-control" id="FormControlTextarea1" rows="10" required></textarea>
                  </div>
                  <div class="custom-file">
                  <input name="episode_video" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Episode Video</label>
                  </div><br></br>
                  <div class="form-group">
                  <label for="FormControlTextarea1">Tags</label>
                  <input data-role="tagsinput" type="text" name="tags" >
                  </div>

            
             
            </div>
                <br></br>
                  </div>
                  <button class="btn btn-warning" type="submit">Submit</button>
            </form>
        </div>
      </div>
      </div>  
    </div>
</div>
<br></br>

                  


@include('layout.partials.footer')

@include('layout.partials.footer-scripts')