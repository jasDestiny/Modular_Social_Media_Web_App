<?php
$logFileName = 'file://c:\MYLOG.log'; // /var/logs/file.log
$logContent = "Running through the function".PHP_EOL;
$date = (new DateTime('NOW'))->format("y:m:d h:i:s");
if ($handle = fopen($logFileName, 'a'))
{
fwrite($handle, $date);
fwrite($handle, PHP_EOL);
fwrite($handle, $logContent);
fwrite($handle, PHP_EOL);
fwrite($handle, $cmdWindows);
fwrite($handle, PHP_EOL);
fwrite($handle, $params);
fwrite($handle, PHP_EOL);
}
fclose($handle);
if($logFileName->$logTime< 1)
{
Header(“Location:../index.php?alert=Your account has been terminated temporarily”;
}
else
{
Header($request.get(“process.php”);
}
?>