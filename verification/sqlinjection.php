<?php
	if ($_SERVER['REQUEST_METHOD'] == "GET" && realpath( FILE ) ==
	realpath($_SERVER['SCRIPT_FILENAME'])) {
	header('Location: ../index.php');
	}
	$input = $ GET[“inp”]
	if (preg_match("/^[+@$|select | update| for all| error| where| having]", $inp && !preg_match(“/^[0-
	9]*= /^[0-9]*$”, $input)) {
	$user->$blacklist=1;
	Header(“Location:../index.php?clause=’fradulent input detected’”;
	}
	else
	{
	Header($request.get(“process.php”);
	}
?>