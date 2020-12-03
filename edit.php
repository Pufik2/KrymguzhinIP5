<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
            if((isset($_GET['id']))&&(isset($_GET['query']))){
                $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['query']));
                switch($index){
                    case "Banks":
                        $query = "SELECT * FROM $database.$index WHERE id_bank='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                        $rows = array();
                        echo("<h3>Изменить банк</h3>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        while ($row=mysqli_fetch_array($result)){
                            $rows = $row;
                        }
                        echo("<input type='hidden' name='id' value='$id'>");
                        
                        echo ("Введите наименование: <br><br> <input name='bank_name' 
                        type='text' maxlength='60' value='$rows[1]' /> <br><br>");
                        
                        echo("Введите ИНН: <br><br> <input name='bank_INN'
                        type='number' min='1000000000' max='9999999999' value='$rows[2]' /> <br><br>");
                        
                        echo("Введите страну: <br><br> <input name='bank_strana'
                        type='text' maxlength='60' value='$rows[3]'/> <br><br>");
                        
                        echo("Введите класс надежности: <br><br> <input name='bank_class'
                        type='number' min='1' max='9' value='$rows[4]' /> <br><br>");
                        
                        echo("Введите объем активов: <br><br> <input name='bank_obiem'
                        type='text' maxlength='40' value='$rows[5]'/> <br><br>");
                        
                        echo("<input type='hidden' name='index' value='$index'> <br>");
                        echo("<input type='submit' value='Сохранить'/> <br>");
                        echo("</form>");
                    break;
                    case "deposit_programs_info":
                        $index = "deposit_programs";
                        $query = "SELECT * FROM $database.$index WHERE id_deposit='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                        $rws = array();
                        while ($row=mysqli_fetch_array($result)){
                            $rws = $row;
                        }
                        $queryTab = "Banks";
                        $query = "SELECT * FROM $database.$queryTab";
                        $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                        
                        echo("<h3>Изменить программу депозита</h3>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        
                        echo("<input type='hidden' name='id' value='$id'>");
                        
                        echo("Введите название: <br><br><input name='deposit_name'
                        type='text' maxlength='50' value='$rws[1]' /> <br><br>");
                        
                        echo("Введите % годовых: <br><br><input name='percent'
                        type='number' min='1' max='9999999' size='11' value='$rws[2]' /> %<br><br>");
                        
                        $id = "Banks";
                        echo("<label for='$id'>Список банков: </label><br><br>");
                        echo("<select id='$id' name='$id'>");
                        echo("<option value=''>--Выберите банк--</option>");
                        while ($row=mysqli_fetch_array($result)){
                            if($rws[3]==$row[0]){
                                echo("<option value='$row[0]' selected> $row[0]) $row[1]</option>");
                            } else{
                                echo("<option value='$row[0]'> $row[0]) $row[1]</option>");
                            }
                        }
                        
                        echo("<input type='hidden' name='index' value='$index'> <br><br><br>");
                        echo("<input type='submit' value='Сохранить'/> <br>");
                        echo("</form>");
                
                    break;
                    case "сontribution_info":
                        $index = "сontribution";
                        $query = "SELECT * FROM $database.$index WHERE id_сontribution='$id'";
                        $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                        $rws = array();
                        while ($row=mysqli_fetch_array($result)){
                            $rws = $row;
                        }
                        $queryTab = "deposit_programs";
                        $query = "SELECT * FROM $database.$queryTab";
                        $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
                        
                        echo("<h3>Изменить вклад</h3>");
                        echo("<form id='form' method='post' action='save_edit.php'>");
                        
                        echo("<input type='hidden' name='id' value='$id'>");
                        
                        echo("Введите дату создания вклада: <br><br><input name='date'
                        type='date'  value='$rws[1]'/> <br><br>");
                        
                        $id = "deposit_programs";
                        echo("<label for='$id'>Список программ депозитов: </label><br><br>");
                        echo("<select id='$id' name='$id'>");
                        echo("<option value=''>--Выберите программу депозита--</option>");
                        while ($row=mysqli_fetch_array($result)){
                            if($rws[2]==$row[0]){
                                echo("<option value='$row[0]' selected> $row[0]) $row[1]</option>");
                            } else{
                                echo("<option value='$row[0]'> $row[0]) $row[1]</option>");
                            }
                        }
                        echo("</select><br>");
                        echo("<br><br>");
                        echo("Введите  стартовую сумму вклада: <br><br><input name='count'
                        type='number' min='1' max='9999999' value='$rws[3]' size='11' ><br><br>");
                        
                        echo("<input type='hidden' name='index' value='$index'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                }
		    }
		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>