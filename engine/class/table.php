<?
class Table{
    
    function __construct($headText, $arrayTitle, $result, $queryTab, $switch){
        echo("<div>");
        $this->text($headText);
        $this->generate($queryTab, $arrayTitle, $result, $switch);
        echo("</div>");
    }
    
    private function text($headText){
        echo ("<h1>$headText</h1>");
    }
    
    private function generate($queryTab, $arrayTitle, $result, $switch){
        $this->generateTableBegin();
        $this->generateTitle($arrayTitle);
        $this->generateRow($queryTab, $result, $switch);
        $this->generateTableEnd();
        $this->generateNumRows($result);
    }
    
    private function generateTableBegin(){
        echo("<table border='1' width='30%'>");
    }
    
    private function generateTableEnd(){
        echo("</table>");
    }
    
    private function generateTitle($array){
        echo("<tr>");
        for($i = 0; $i < count($array); $i++){
            $text = $array[$i];
            echo("<th width='10%'>$text</th>");
        }
        echo("<tr>");
    }
    
    private function generateNumRows($result){
        $num_rows = mysqli_num_rows($result);
        echo("<input type='hidden' name='value' value='".$num_rows."'> <br>");
    }
    
    private function generateRow($queryTab, $result, $switch){
        $j = 0;
        while ($row=mysqli_fetch_array($result)){
            echo "<tr align='center'>";
            for($i = 0; $i < count($row)/2; $i++){
                $text = $row[$i];
                echo("<td>$text</td>");
            }
            if($switch){
                echo "<td><a href='/lab5/edit.php?id=". $row[0]. "& query=".$queryTab. "'>Изменить</a></td>";
				echo "<td><a href='/lab5/delete.php?id=". $row[0]. "& query=". $queryTab. "'>Удалить</a></td>";
            }
			echo "</tr>";
        }
    }
}
?>