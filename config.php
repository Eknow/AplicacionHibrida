<?php
	session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("545854364645-irevvnm71b35c3subfsnfsk0qh2i3abq.apps.googleusercontent.com");
	$gClient->setClientSecret("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");
	$gClient->setApplicationName("CPI Login Tutorial");
	$gClient->setRedirectUri("http://localhost/google/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
