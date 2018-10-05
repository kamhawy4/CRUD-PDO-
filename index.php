<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />

<link type="text/css" rel="stylesheet" href='css/bootstrap.min.css' />

<link type="text/css" rel="stylesheet" href='css/style.css' />

<title>PDO</title>

<link href='http://fonts.googleapis.com/css?family=Lato:700,400,300' rel='stylesheet'

type='text/css'> 

</head>
<body>

<?php


  require_once 'connect.php';
  require_once 'employee.php';
  require_once 'abstractmodel.php';
  $allData    = Employee::GetAll(); 

  if(isset($_GET['action'])  and $_GET['action'] == 'delete') {
	$id        =  filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT); // filter id  
    $employee  =  Employee::getByPk($id); // get Employee by id 
    $delete    =  $employee->delete(); // delete Employee 
	if($delete == true){
	header('Location: index.php');
	}else{
	   echo '<li class="list-group-item list-group-item-warning title"> no delete</li><br />';
	}
}

?>
<div id='page'>

<div class="page-header"><h1 class='title'>Books Script</h1></div>
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
  <li role="presentation"><a href="addnew.php"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add New</a></li>

</ul>


<table class="table">

<tr>
<td><h3>title</h3></td>
<td><h3>content</h3></td>
<td><h3>status</h3></td>
<td><h3>options</h3></td>
</tr>
	<?php
	foreach ($allData  as $data) {
    ?>
     <tr>
	         <td><?=$data->title?></td>
			 <td><?=$data->content?></td>
			 <td><?= ($data->type == 0)?'Inactive':'active' ?></td>
			 <td>
			 	<?php
			     echo "<a class='btn btn-info'   href='edit.php?action=edit&id=".$data->id."'>تعديل<a/>
			          <a class='btn btn-danger' href='?action=delete&id=".$data->id."'>حذف<a/>";
			    ?>
			 </td>
	   </tr>
	<?php
	  } 
	?>
</table>

</div>
<script src='js/bootstrap.min.js'></script>
</body>
</html>	
