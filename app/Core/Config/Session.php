<?php

session_start();

if (!isset($_SESSION['session_id']))
{
	$_SESSION['session_id'] = sessionIdVal();
	$_SESSION['created_at'] = time();
}

function sessionIdVal() : string
{
	return md5('ProjectA' . session_id());
}

function getSessionId() : string
{
	return $_SESSION['session_id'];
}

function checkSessId($varName = 'session_id') : bool
{
	return (
		$_POST[$varName] === getSessionId()
	);
}