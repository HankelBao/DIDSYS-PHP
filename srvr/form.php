<?php
class form {
    public static function invisible($name, $value) {
        return "<input name='".$name."' value='".$value."' style='display:none'\>";
    }

    public static function echoDateSelector($id) {
        echo '<div class="form-group">';
            echo '<div class="input-group">';
                echo '<input type="text" class="form-control">';
                echo '<div class="input-group-addon">y</div>';
                echo '<input type="text" class="form-control">';
                echo '<div class="input-group-addon">m</div>';
                echo '<input type="text" class="form-control">';
                echo '<div class="input-group-addon">d</div>';
            echo '</div>';
        echo '</div>';
    }

    public static function YearSelector(){}
}
?>
