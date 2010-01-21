<?php
session_start();
require_once("Excel/reader.php");
  include("baseConnect.php");
 connect();
if( isset($_POST['submitted'])&&isset($_GET['set'])&&$_GET['set']==1){
$file= $_FILES["filename"]["tmp_name"];
if(isset($_POST['base'])&&$_POST['base']!='none'){
    $base=$_POST['base'];
}else {
$_SESSION['upload_message']="Целевая база не выбрана";
    header("Location: /utils/index.php");
}
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF-8');
$data->read($file);
$dubl=$qty=$j=0;
$list="";
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


$query0 ="select * from $base";
$query0 .=" where name='$name' and year='$year'";
$query0 .=" and subject='$subject' and region='$region'";
$query0 .=" and mark='$total' and position='$result'";
$query0 .=" and class='$klass' and school='$school'";
//$query0 .=" and mark='$total' and position='$result'";
$result0 = mysql_query ($query0) or die (mysql_error($link));
 $qty=mysql_num_rows($result0);

$dubl=$dubl+$qty ;
if($subject>0&&$qty>0){
   $list.="<li class=\"error\">".$name.", ".$klass."кл., ".$region.", ".$result."</li>";
}

if($subject>0&&$qty==0){
        $query = "insert into $base values ('$year','$subject', '$klass','$name','$region','$school','$total','$result')";
        $result = mysql_query ($query) or die (mysql_error($link));

        if(mysql_affected_rows()>0){
        $j++;
         }
        $list.="<li>".$name." ".$klass."кл. ".$region." ".$result."</li>";
}

}

$_SESSION['upload_message']="Успешно внесено ".$j." учащихся";
$_SESSION['saved']="<ul>".$list."</ul>";
$_SESSION['dubl_message']="Обнаружено дублирований ".$dubl;
  }
    $location="/utils/index.php";
    header("Location: $location");
  ?>
