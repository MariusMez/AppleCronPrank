<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      write(stripslashes($_POST["cmd"]));
}


function write($script) {
    $file = fopen("script.txt", "w") or die("Unable to open file!");
    fwrite($file, $script."\n");
    fclose($file);
    echo $script;

}
?>
