<?php
session_start();
require_once("Excel/reader.php");
  include("../baseConnect.php");
 connect();
if( isset($_POST['submitted'])&&isset($_GET['set'])&&$_GET['set']==1){
$file= $_FILES["filename"]["tmp_name"];
if(isset($_POST['base'])&&$_POST['base']!='none'){
    $base=$_POST['base'];
}else {
$_SESSION['upload_message']="Целевая база не выбрана";
    header("Location: /index.php");
}
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read($file);
$j=0;

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
$year=$data->sheets[0]['cells'][$i][1];
$subject=$data->sheets[0]['cells'][$i][2];
$name=$data->sheets[0]['cells'][$i][3];
$klass=$data->sheets[0]['cells'][$i][4];
$region=$data->sheets[0]['cells'][$i][5];
$school=$data->sheets[0]['cells'][$i][6];
$total=$data->sheets[0]['cells'][$i][7];
$result=$data->sheets[0]['cells'][$i][8];
if($subject>0){
        $query = "insert into $base values ('$year','$subject', '$klass','$name','$region','$school','$total','$result')";
        $result = mysql_query ($query) or die (mysql_error($link));

        if(mysql_affected_rows()>0){
        $j++;

}
}

}
$_SESSION['upload_message']="Успешно внесено ".$j." учащихся";
  }
    $location="/index.php";
    header("Location: $location");
  ?>
