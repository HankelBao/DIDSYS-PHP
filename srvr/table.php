<?php
class table {
    public static function echoHead($item) {
        echo "<table border='1'>";
        echo "<tr>";//row!
            echo "<th> </th>";//item
            for($i=0; $i<count($item); $i++) {
                echo "<th>".$item[$i]."</th>";//item
            }
        echo "</tr>";//row
    }
    public static function echoRow($firstRow, $item) {
        echo "<tr>";//tr!
        echo "<th>";//th!
        echo $firstRow;
        echo "</th>";//th
        for ($i = 0; $i < count($item); $i++) {
            echo "<th>";//th!
            echo $item[$i];
            echo "</th>";//th
        }
        echo "</tr>";//tr
    }
    public static function echoEnd() {
        echo "</table>";
    }
}
?>
