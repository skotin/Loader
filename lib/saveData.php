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
$dubl=$qty=$j=0;

for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
$year=mysql_real_escape_string($data->sheets[0]['cells'][$i][1]);
$subject=mysql_real_escape_string($data->sheets[0]['cells'][$i][2]);
$name=mysql_real_escape_string($data->sheets[0]['cells'][$i][3]);
$klass=mysql_real_escape_string($data->sheets[0]['cells'][$i][4]);
$region=mysql_real_escape_string($data->sheets[0]['cells'][$i][5]);
$school=mysql_real_escape_string($data->sheets[0]['cells'][$i][6]);
$total=mysql_real_escape_string($data->sheets[0]['cells'][$i][7]);
$result=mysql_real_escape_string($data->sheets[0]['cells'][$i][8]);

    //Поиск дублирования


$query0="select count(*) from $base where name='$name' and class='$klass' and subject='$subject' and region='$region'";
$result0 = mysql_query ($query0) or die (mysql_error($link));

        while ($row = mysql_fetch_array($result0, MYSQL_ASSOC)) {
            $qty = $row[0];
        }

$qty =$row[0]; 
$dubl=$dubl+$qty ;
if($subject>0&&$qty==0){
        $query = "insert into $base values ('$year','$subject', '$klass','$name','$region','$school','$total','$result')";
        $result = mysql_query ($query) or die (mysql_error($link));

        if(mysql_affected_rows()>0){
        $j++;

}
}

}
$_SESSION['upload_message']="Успешно внесено ".$j." учащихся";
$_SESSION['dubl_message']="Обнаружено дублирований ".$dubl." <br/> Дублированные записи в базу не внесены";
  }
    $location="/index.php";
    header("Location: $location");
  ?>
