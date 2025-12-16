<?php
include 'db.php';


if ($_REQUEST['action'] == 'fetch') {
$q = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
while ($r = mysqli_fetch_assoc($q)) {
echo "<tr>
<td>{$r['id']}</td>
<td>{$r['name']}</td>
<td>{$r['email']}</td>
<td>{$r['course']}</td>
<td>
<button onclick=\"editStudent('{$r['id']}','{$r['name']}','{$r['email']}','{$r['course']}')\">Edit</button>
<button onclick=\"deleteStudent('{$r['id']}')\">Delete</button>
</td>
</tr>";
}
}


if ($_REQUEST['action'] == 'save') {
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$course = $_POST['course'];


if ($id == '') {
mysqli_query($conn, "INSERT INTO students (name,email,course) VALUES ('$name','$email','$course')");
} else {
mysqli_query($conn, "UPDATE students SET name='$name', email='$email', course='$course' WHERE id='$id'");
}
}


if ($_REQUEST['action'] == 'delete') {
$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM students WHERE id='$id'");
}
?>