<?php
require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<input type="text" name="mname" placeholder="enter module name">
<button type="submit">Submit</button>
</form>
<table border="1">
<tr>
<th>Id</th>
<th>Module Name</th>
<th>update</th>
<th>Delete</th>
</tr>
</table>    
</body>
</html>



<?php
if (isset( $_POST['mname']) ) {
   $mname =$_POST['mname'];
   $query = "INSERT INTO modules (m_name) VALUES ('$mname')";
   $c_module = $conn->query("select * from modules where m_name='$mname'");

if ($c_module->num_rows > 0)
{
    echo "This module already exist";
    exit();
}
if ($conn->query($query)) {
    echo "new module added succesfully";
}
}
?>