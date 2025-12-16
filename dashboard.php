<?php session_start(); if (!isset($_SESSION['admin'])) header('Location: login.php'); ?>
<!DOCTYPE html>
<html>
<head>
<title>Student Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
  <span class="navbar-brand">Student CRUD</span>
  <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</nav>

<div class="container mt-4">

<div class="card shadow mb-4">
  <div class="card-header bg-primary text-white">Add / Edit Student</div>
  <div class="card-body">
    <form id="studentForm" class="row g-3">
      <input type="hidden" name="id" id="id">
      <div class="col-md-4">
        <input type="text" name="name" id="name" class="form-control" placeholder="Student Name" required>
      </div>
      <div class="col-md-4">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
      </div>
      <div class="col-md-3">
        <input type="text" name="course" id="course" class="form-control" placeholder="Course" required>
      </div>
      <div class="col-md-1 d-grid">
        <button class="btn btn-success">Save</button>
      </div>
    </form>
  </div>
</div>

<div class="card shadow">
  <div class="card-header bg-dark text-white">Student List</div>
  <div class="card-body">
    <table class="table table-bordered table-hover">
      <thead class="table-secondary">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Course</th>
          <th width="150">Action</th>
        </tr>
      </thead>
      <tbody id="studentData"></tbody>
    </table>
  </div>
</div>

</div>

<script>
function loadStudents() {
  $.get("student_ajax.php",{action:'fetch'},function(data){
    $('#studentData').html(data);
  });
}
loadStudents();

$('#studentForm').submit(function(e){
  e.preventDefault();
  $.post("student_ajax.php", $(this).serialize()+"&action=save", function(){
    loadStudents();
    $('#studentForm')[0].reset();
  });
});

function editStudent(id,name,email,course){
  $('#id').val(id);
  $('#name').val(name);
  $('#email').val(email);
  $('#course').val(course);
}

function deleteStudent(id){
  if(confirm("Delete this student?")){
    $.post("student_ajax.php",{action:'delete',id:id},function(){
      loadStudents();
    });
  }
}
</script>

</body>
</html>