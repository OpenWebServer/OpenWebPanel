<?php
$username = "admin";
$password = "admin";
$randomword = "applebanannabubblechoochoo";

if (isset($_COOKIE['MyLoginPage'])) {
   if ($_COOKIE['MyLoginPage'] == md5($password.$randomword)) {
?>



<?php
// start of  Control panel




print "<h1>OpenWebServer</h1>";
print "<h2>Monitor</h2>";
print "Monitor Ram/Swap\n";
print "</br>";
// get used memory
$mem_use = memory_get_usage(true) . "\n"; // 57960
// get memory percentage
function get_memory() {
  foreach(file('/proc/meminfo') as $ri)
    $m[strtok($ri, ':')] = strtok('');
  return 100 - round(($m['MemFree'] + $m['Buffers'] + $m['Cached']) / $m['MemTotal'] * 100);
}
$tot_mem = get_memory();
//percentage bar varibles
$image = "http://www.yarntomato.com/percentbarmaker/button.php?barPosition=";
$image2 = "&leftFill=%23CC0000";

//plain text memory (Old)
//echo $tot_mem."%";

//percentage bar (Default) 
echo '<img src="'.$image.$tot_mem.$image2.'" alt="random image" />'."<br /><br />"; 











// end of Control Panel
?>





<?php
      exit;
   } else {
      echo "<p>Bad cookie. Clear please clear them out and try to login again.</p>";
      exit;
   }
   
   
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
   if ($_POST['name'] != $username) {
      echo "<p>Sorry, that user or password does not match. Use your browser back button to go back and try again.</p>";
      exit;
   } else if ($_POST['pass'] != $password) {
      echo "<p>Sorry, that user or password does not match. Use your browser back button to go back and try again.</p>";
      exit;
   } else if ($_POST['name'] == $username && $_POST['pass'] == $password) {
      setcookie('MyLoginPage', md5($_POST['pass'].$randomword));
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "<p>Sorry, you could not be logged in at this time. Refresh the page and try again.</p>";
   }
   
   
   
   
   
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post"><fieldset>
<label><input type="text" name="name" id="name" /> Name</label><br />
<label><input type="password" name="pass" id="pass" /> Password</label><br />
<input type="submit" id="submit" value="Login" />
</fieldset></form>





