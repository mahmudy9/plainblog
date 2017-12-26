<?php

function rand_sha1($length) {
  $max = ceil($length / 40);

  $random = '';
  for ($i = 0; $i < 1; $i++) {
	$random .= sha1(microtime(true).random_int(10000,90000));
  }
  return substr($random, 0, $length);
}


function addSession($uid, $remember)
{

	//check user exist in database

	$user = $this->getBaseUser($uid);


	if (!$user) {
		return false;
	}

	//site_key against csrf attacks
	$site_key = "site_key";

	//give session hash to prevent csrf attacks

	$_SESSION['hash'] = hash( "sha512", $site_key . session_id() . microtime());
	$_SESSION['ip'] = $this->getIp();
	$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];

	$this->deleteSession($uid);

	if ($remember == true) {
		$expire = date("Y-m-d H:i:s", strtotime($this->config->cookie_remember));
	} else {
		$expire = date("Y-m-d H:i:s", strtotime($this->config->cookie_forget));
	}

   // $data['cookie_crc'] = sha1($data['hash'] . $site_key);

	$query = $this->dbh->prepare("INSERT INTO {$this->config->table_sessions} (uid, hash, expiredate, ip, agent) VALUES (?, ?, ?, ?, ?, ?)");

	if (!$query->execute(array($uid, $_SESSION['hash'], $expire, $_SESSION['ip'], $agent))) {
		return false;
	}


	return $_SESSION;
}


function deleteSession($hash)
{

	session_start();
	$_SESSION = array();
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	session_destroy();

//this part for sessions table

	$query = $this->dbh->prepare("DELETE FROM {$this->config->table_sessions} WHERE hash = ?");
	$query->execute(array($hash));

	return $query->rowCount() == 1;
}

function my_session_regenerate($reload = false)
{
	// This token is used by forms to prevent cross site forgery attempts
	if (!isset($_SESSION['hash']) || $reload) {
		$_SESSION['hash'] = hash( "sha512", $site_key . session_id() . microtime());
	}

	if (!isset($_SESSION['ip']) || $reload) {
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	}

	if (!isset($_SESSION['agent']) || $reload) {
		$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
	}

	if ($reload == true) {
		session_regenerate_id(true);
		return;
	}

	// Set current session to expire in 1 minute
	$_SESSION['expire'] = time() + 300;

	// Create new session id
	$new_session_id = session_create_id();

	// Grab current session ID and close both sessions to allow other scripts to use them
	$_SESSION['new_session_id'] = $new_session_id;

	//write and close session to allow other scripts to use them
	session_commit();

	// Set session ID to the new one, and start it back up again
	ini_set('session.use_strict_mode', 0);

	session_id($new_session_id);
	session_start();

	ini_set('session.use_strict_mode', 1);

	// Don't want this one to expire
	unset($_SESSION['new_session_id']);
	unset($_SESSION['expire']);
	return;
}



function my_session_start()
{
	
	session_start();

	if (isset($_SESSION['expire'])) {
		if ($_SESSION['expire'] < time()) {
			// Should not happen usually. This could be attack or due to unstable network.
			// Remove all authentication status of this users session.
			$_SESSION = array();
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 48000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			session_destroy();

			session_start();
		   
			return;
		}

		if (isset($_SESSION['new_session_id'])) {
			// Not fully expired yet. Could be lost cookie by unstable network.
			// Try again to set proper session ID cookie.
			// NOTE: Do not try to set session ID again if you would like to remove
			// authentication flag.
			session_commit();

			ini_set('session.use_strict_mode', 0);

			session_id($_SESSION['new_session_id']);
			// New session ID should exist
			session_start();

			ini_set('session.use_strict_mode', 1);

			return;
		}
	}
}


/*
example code
for authintecated users
and for annonymous users too
start session

** my_session_start();

add session to database
** addSession( $uid, $remember );

regenerate session id after authorization level change
** regenerateSessionID();

destroy session and delete it from database
** deleteSession();

regenerate session id after authenticating annonymous user and set it to true to delete old session file

** regenerateSessionID(true);

*/
//echo date("Y-m-d H:i:s" , strtotime('+14 days'));

//print_r($_COOKIE);
//echo strtotime(time());
//setcookie("keepme" , "2324354" , time()+3600 , "/" , "" ,0 , 1);


?>