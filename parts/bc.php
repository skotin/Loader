 <?if($access!="all"){
     switch($role){
                  case 1:?>
                    <a href="index.php" class="home">Сводная таблица</a>  <a href="editor.php?unit=<?=$access?>" class="region"><?=$regions[$access]?></a>
                   <? break;
                  case 2:?>
                    <a href="index.php" class="home">Сводная таблица</a>  <a href="editor.php?school=<?=$access?>" class="lesson"><?=$schools[$access]?> </a> 
                  <? break;
                  case 3:?>
                    <a href="index.php" class="home">Сводная таблица</a>  <a href="editor.php?lesson=<?=$les?>" class="account">Список учащихся</a>  
                  <? break;
                  case 4:?>
                    <a href="index.php" class="home">Сводная таблица</a>  <a href="curator.php" class="curator">Список учащихся</a>
                  <? break;?>
                  <? default: echo "&nbsp;";?>
                  <?}
                  }             

     elseif($access=="all"){?>
                   <a href="index.php" class="home">Сводная таблица</a>
                   <a href="superedit.php?unit=<?=$access?>&role=<?=$role?>" class="quotas">Квоты</a>
                   <a href="editor.php" class="reports">Отчеты</a>
                   <a href="info.php" class="info">Общая информация</a>
                  <?}?>


