<!DOCTYPE html>
<html>
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://github.com/Nodws/bootstrap4-tagsinput/raw/master/tagsinput.css" />


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

<script src="https://github.com/Nodws/bootstrap4-tagsinput/raw/master/tagsinput.js"></script>


<script>
error=false

function validate()
{
if(document.userForm.name.value !='' && document.userForm.email.value !='' )
document.userForm.btnsave.disabled=false
else
document.userForm.btnsave.disabled=true
}
</script>


</head>
<body>

<div class="container">
<br/>
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right">
<a class="btn btn-success mb-2" id="new-user" data-toggle="modal">New Course</a>
</div>
</div>
</div>

<table class="table table-bordered data-table" id="users_table">
<thead>
<tr id="">
<th width="3%">No</th>
<th width="5%">ID</th>
<th width="15%">Title</th>
<th width="15%">Teacher</th>
<th width="15%">Tags</th>
<th width="20%">Action</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>

<!-- Add and Edit user modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="userCrudModal"></h4>
</div>
<div class="modal-body">
<form name="userForm" action="{{ route('admincourses.store') }}" method="POST">
<input type="hidden" name="user_id" id="user_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Title:</strong>
<input type="text" name="course_title" id="course_title" class="form-control" placeholder="Course Title" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Description:</strong>
<input type="textarea" name="course_intro" id="course_intro" class="form-control" placeholder="Course Description" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Tags:</strong>
<input data-role="tagsinput" type="text" name="tags" id="tags" class="form-control"  onchange="validate()" >
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" >Save</button>
<a href="{{ route('admincourses.index') }}" class="btn btn-danger">Cancel</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<!-- Show user modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="userCrudModal-show"></h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2"></div>
<div class="col-xs-10 col-sm-10 col-md-10 ">

<table class="table-responsive ">
<tr height="50px"><td><strong>Title:</strong></td><td id="ctitle"></td></tr>
<tr height="50px"><td><strong>Description:</strong></td><td id="cintro"></td></tr>
<tr height="50px"><td><strong>Tags:</strong></td><td id="ctags"></td></tr>
<tr height="50px"><td><strong>Teacher:</strong></td><td id="cteacher"></td></tr>

<tr><td></td><td style="text-align: right "><a href="{{ route('admincourses.index') }}" class="btn btn-danger">OK</a> </td></tr>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

</body>

<script type="text/javascript">

$(document).ready(function () {

var table = $('#users_table').DataTable({
processing: true,
serverSide: true,
ajax: "{{ route('admincourses.index') }}",
columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
{data: 'id', name: 'id'},
{data: 'course_title', name: 'course_title'},
{data: 'users', name: 'users'},
{data: 'tags', name: 'tags.name'},
{data: 'action', name: 'action', orderable: false, searchable: false},
]
});

/* When click New user button */
$('#new-user').click(function () {
$('#btn-save').val("create-user");
$('#user').trigger("reset");
$('#userCrudModal').html("Add New Course");
$('#crud-modal').modal('show');
});

/* Edit user*/
$('body').on('click', '#edit-user', function () {
var user_id = $(this).data('id');
$.get('admincourses/'+user_id+'/edit', function (data) {
$('#userCrudModal').html("Edit Course");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#user_id').val(data.id);
$('#course_title').val(data.course_title);
$('#course_intro').val(data.course_intro);
$('#tags').val(tags.name);


})
});
/* Show user */
$('body').on('click', '#show-user', function () {
var user_id = $(this).data('id');
$.get('admincourses/'+user_id, function (data) {

$('#ctitle').html(data.course_title);
$('#cintro').html(data.course_intro);
$('#cteacher').html(data.user.name);
$('#ctags').html(data.tags.name);


})
$('#userCrudModal-show').html("Course Details");
$('#crud-modal-show').modal('show');
});

/* Delete user */
$('body').on('click', '#delete-user', function () {
var user_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "admincourses/" +user_id,
data: {
"id": user_id,
"_token": token,
},
success: function (data) {

//$('#msg').html('Customer entry deleted successfully');
//$("#customer_id_" + user_id).remove();
table.ajax.reload();
},
error: function (data) {
console.log('Error:', data);
}
});
});
});

</script>
</html>