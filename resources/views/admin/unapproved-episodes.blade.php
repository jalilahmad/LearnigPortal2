<html>
<head>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
    <div class="container">
        <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Title</th>
                  <th>Course</th>
                  <th>Approval</th>
               </tr> 
            </thead>
            <tbody>
               @foreach($episodes as $episode)
                  <tr>
                     <td>{{ $episode->episode_title }}</td>
                     <td>{{ $episode->course->course_title }}</td>
                     <td>
                        <input data-id="{{$episode->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $episode->isApproved ? 'checked' : '' }}>
                     </td>
                  </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var isApproved = $(this).prop('checked') == true ? 1 : 0; 
        var episode_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/approve-episode',
            data: {'isApproved': isApproved, 'episode_id': episode_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
</html> 