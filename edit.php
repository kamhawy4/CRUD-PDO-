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

<div id='page'>
<div class="page-header"><h1 class='title'>Books Script</h1></div>
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a href="index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
  <li role="presentation"><a href="addnew.php"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add New</a></li>

</ul>

<?php

require_once "connect.php";
require_once "abstractmodel.php";
require_once "employee.php";


if(isset($_GET['id'])) {
  $id         =  filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT); // filter id  
  $row        =  Employee::getByPk($id); // get Employee by id 
}

?>
<h3>Edit New </h3>

<form class="form-horizontal" action='' method='post'>
<fieldset>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">title</label>
  <div class="controls">
    <input id="textinput" name="title" value="<?= $row->title ?>" type="text" placeholder="title" class="input-xlarge">
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">content</label>
  <div class="controls">
    <textarea id="textinput" name="content"  placeholder="content" class="textare-xlarge" ><?= $row->content ?></textarea>
  </div>
</div>


<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="selectbasic">Select Basic</label>
  <div class="controls">
     <select id="selectbasic" name="type"  class="input-xlarge">
      <?php

      if( $row->type == '1'){

         echo"
          <option value='1'>Active</option>
          <option value='0'>DsActive</option>";

      }else{

        echo"
        <option value='0'>DsActive</option>
        <option value='1' >Active</option>
        ";
      }

      ?>
    </select>
  </div>
</div>



<br/>
<!-- Button -->
<div class="control-group">
  <label class="control-label" for="singlebutton">Single Button</label>
  <div class="controls">
    <button id="singlebutton" name="singlebutton" value='Button' class="btn btn-primary">Edit</button>
  </div>
</div>
</fieldset>
</form>

<?php

if(isset($_POST['singlebutton']) and $_POST['singlebutton'] == "Button") {

$title     =  filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);    // filter title  
$content   =  filter_input(INPUT_POST,'content',FILTER_SANITIZE_STRING);  // filter content  
$type      =  filter_input(INPUT_POST,'type',FILTER_SANITIZE_NUMBER_INT); // filter type  
$id        =  filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);    // filter type  

$employee           =  Employee::getByPk($id);
$employee->title    = $title;
$employee->content  = $content;
$employee->type     = $type;
$save               = $employee->Save();

if($save == true) {
   header('Location: index.php');
   echo '<li class="list-group-item list-group-item-warning title">update done</li><br />';
  }else {
   echo '<li class="list-group-item list-group-item-warning title"> no update</li><br />';
}


}

?>

</div>
<script src='js/bootstrap.min.js'></script>
</body>
</html>	