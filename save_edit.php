<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
        <?
            if((isset($_POST['id']))&&(isset($_POST['index']))){
                $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_POST['index']));
                switch($index){
                    case "Banks":
                        if((isset($_POST['bank_name']))&&(isset($_POST['bank_INN']))&&(isset($_POST['bank_strana']))&&(isset($_POST['bank_class']))&&(isset($_POST['bank_obiem']))){
                            $bank_name = htmlentities(mysqli_real_escape_string($link, $_POST['bank_name']));
                            $bank_INN = htmlentities(mysqli_real_escape_string($link, $_POST['bank_INN']));
                            $bank_strana = htmlentities(mysqli_real_escape_string($link, $_POST['bank_strana']));
                            $bank_class = htmlentities(mysqli_real_escape_string($link, $_POST['bank_class']));
                            $bank_obiem = htmlentities(mysqli_real_escape_string($link, $_POST['bank_obiem']));
                            if((strlen($bank_name)==0)||(strlen($bank_INN)==0)||(strlen($bank_strana)==0)||(strlen($bank_class)==0)||(strlen($bank_obiem)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET bank_name = '$bank_name', bank_INN = '$bank_INN', bank_strana = '$bank_strana', bank_class = '$bank_class', bank_obiem = '$bank_obiem' WHERE $database.$index.id_bank = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                header('location:index.php'); 
                              //  echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                    case "deposit_programs":
                        if((isset($_POST['Banks']))&&(isset($_POST['deposit_name']))&&(isset($_POST['percent']))){
                            $Banks = htmlentities(mysqli_real_escape_string($link, $_POST['Banks']));
                            $deposit_name = htmlentities(mysqli_real_escape_string($link, $_POST['deposit_name']));
                            $percent = htmlentities(mysqli_real_escape_string($link, $_POST['percent']));
                            if(($Banks=="")||(strlen($deposit_name)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET deposit_name = '$deposit_name' ,percent = '$percent', id_bank = '$Banks' WHERE $database.$index.id_deposit = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                               header('location:index.php'); 
                                //echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                     case "сontribution":
                         if((isset($_POST['deposit_programs']))&&(isset($_POST['count']))&&(isset($_POST['date']))){
                            $deposit_programs = htmlentities(mysqli_real_escape_string($link, $_POST['deposit_programs']));
                            $count = htmlentities(mysqli_real_escape_string($link, $_POST['count']));
                            $date = htmlentities(mysqli_real_escape_string($link, $_POST['date']));
                            if(($deposit_programs=="")||(strlen($count)==0)){
                                die("Ошибка значения пусты");
                            }
                            $query = "UPDATE $database.$index SET date = '$date', id_deposit = '$deposit_programs', count='$count' WHERE $database.$index.id_сontribution = '$id'";
                            mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                            if(mysqli_affected_rows($link)>0){
                                header('location:index.php'); 
                                //echo "<p><a href=\"index.php\"> Return</a>"; 
                            } else { 
                                echo("Saving error. <a href=\"index.php\"> Return</a>");
                            }
                        }
                    break;
                }
            }
        ?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>