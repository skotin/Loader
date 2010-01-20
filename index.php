<?php
session_start();
  include("baseConnect.php");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Загрузка данных в базу "Всероссийская олимпиада и Областная олимпиада</title>
  <link rel="stylesheet" href="style.css"/>
</head>

<body class="loader">
<div  id="container">

<div id="content">

<!--<h2 class="edit">Редактирование данных слушателя </h2>-->


   <h1>Загрузка данных из Excel</h1>
   <div class="uploader">
 <form action="lib/saveData.php?set=1" method="post" enctype="multipart/form-data">
 <label for="base">База</label>
 <select name="base" id="base">
     <option value="none">Выберите целевую базу</option>
     <option value="olymp">Всероссийская олимпиада</option>
     <option value="rolymp">Областная олимпиада</option>
 </select>
  <input type="hidden" name="submitted" value="yes" />
      <input type="file" class="fileselect" name="filename" value="Выбрать файл "/>
      <input type="submit" class="btn" value="Загрузить файл"/>
   </form>
 <?
  if(isset($_SESSION['upload_message'])){
    echo "<p class=\"message\">".$_SESSION['upload_message']."</p>";
  }
if(isset($_SESSION['dubl_message'])){
    echo "<p class=\"dubl\">".$_SESSION['dubl_message']."</p>";
  }
?>


 </div>

</div>

<?
  if(isset($_SESSION['upload_message'])){
    unset($_SESSION['upload_message']);
  }
  if(isset($_SESSION['dubl_message'])){
    unset($_SESSION['dubl_message']);
  }
  if(isset($_POST['submitted'])){
    $_POST['submitted']=0;
  }

?>

</div>
</body>
</html>
