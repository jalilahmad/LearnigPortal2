<!DOCTYPE html>
<html>
<head>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
<a class="btn btn-success mb-2" id="new-user" data-toggle="modal">New User</a>
</div>
</div>
</div>

<table class="table table-bordered data-table" id="users_table">
<thead>
<tr id="">
<th width="5%">No</th>
<th width="5%">Id</th>
<th width="20%">UserName</th>
<th width="30%">Email</th>
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
<form name="userForm" action="{{ route('teachers.store') }}" method="POST">
<input type="hidden" name="user_id" id="user_id" >
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Name:</strong>
<input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>First Name:</strong>
<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Last Name:</strong>
<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" onchange="validate()" >
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Email:</strong>
<input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Password:</strong>
<input type="password" id="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password *"onchange="validate()" />
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Save</button>
<a href="{{ route('teachers.index') }}" class="btn btn-danger">Cancel</a>
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
<tr height="50px"><td><strong>FirstName:</strong></td><td id="fname"></td></tr>
<tr height="50px"><td><strong>LastName:</strong></td><td id="lname"></td></tr>
<tr height="50px"><td><strong>UserName:</strong></td><td id="sname"></td></tr>
<tr height="50px"><td><strong>Email:</strong></td><td id="semail"></td></tr>

<tr><td></td><td style="text-align: right "><a href="{{ route('teachers.index') }}" class="btn btn-danger">OK</a> </td></tr>
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
ajax: "{{ route('teachers.index') }}",
columns: [
{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
{data: 'id', name: 'id'},
{data: 'name', name: 'name'},
{data: 'email', name: 'email'},
{data: 'action', name: 'action', orderable: false, searchable: false},
]
});

/* When click New user button */
$('#new-user').click(function () {
$('#btn-save').val("create-user");
$('#user').trigger("reset");
$('#userCrudModal').html("Add New User");
$('#crud-modal').modal('show');
});

/* Edit user*/
$('body').on('click', '#edit-user', function () {
var user_id = $(this).data('id');
$.get('teachers-list/'+user_id+'/edit', function (data) {
$('#userCrudModal').html("Edit User");
$('#btn-update').val("Update");
$('#btn-save').prop('disabled',false);
$('#crud-modal').modal('show');
$('#user_id').val(data.id);
$('#first_name').val(data.first_name);
$('#last_name').val(data.last_name);
$('#name').val(data.name);
$('#email').val(data.email);
$('#password').val(data.password);

})
});
/* Show user */
$('body').on('click', '#show-user', function () {
var user_id = $(this).data('id');
$.get('users/'+user_id, function (data) {

$('#fname').html(data.first_name);
$('#lname').html(data.last_name);
$('#sname').html(data.name);
$('#semail').html(data.email);

})
$('#userCrudModal-show').html("User Details");
$('#crud-modal-show').modal('show');
});

/* Delete user */
$('body').on('click', '#delete-user', function () {
var user_id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");
confirm("Are You sure want to delete !");

$.ajax({
type: "DELETE",
url: "users/" +user_id,
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