<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<?require_once 'engine/class/table.php';?>
<html>
    <style>
 table {
     border-collapse: collapse; /* Отображать двойные линии как одинарные */
    }
	th, td{
		padding: 5px;
border: 3px solid #080707;
	}
	th{
		background:#00ffff; 
		color: #000000;
	}
	td{
	}
</style>
    <body>
        <?
            echo("<div>");
            $queryTab = "Banks";
            $headText = "Таблица Банки";
            $arrayTitle = array("№", "Наименование", "ИНН", "страна", "класс надежности", " объем активов", "Изменить", "Удалить");
            $query = "SELECT * FROM $database.$queryTab";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("<div> <a href='new.php?Index="."Banks"."'> Добавить новый банк</a> </div>");
            echo("</div>");
            
            $queryTab = "deposit_programs_info";
            $headText = "Таблица Программы депозитов";
            $arrayTitle = array("№", "Название", "% годовых", "Банк", "Изменить", "Удалить");
            $query = "SELECT * FROM $database.$queryTab";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("<div> <a href='new.php?Index="."deposit_programs"."'> Добавить нового программу депозита</a> </div>");
            echo("</div>");
            
            $queryTab = "сontribution_info";
            $headText = "Таблица зачетная ведомость";
            $arrayTitle = array("№", "Дата создания вклада", "Программа депозита", "Стартовая сумма вклада", "Изменить", "Удалить");
            $query = "SELECT * FROM $database.$queryTab";
            $result = mysqli_query($link, $query) or die("Не могу выполнить запрос!");
            echo("<div>");
            $a = new Table($headText, $arrayTitle, $result, $queryTab, true);
            echo("<div> <a href='new.php?Index="."сontribution"."'> Добавить новый вклад</a> </div>");
            echo("</div>");
            echo("</div>");
           
            echo("<div>");
            echo("<div> <a href='gen_pdf.php'> Открыть PDF - файл </a> </div>");
            echo("<div> <a href='gen_xls.php'> Загрузить XLS - файл </a> </div>");
            echo("</div>");
            echo("</div>");
        ?>
    </body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>