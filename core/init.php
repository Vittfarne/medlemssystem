<?php
session_start();



if (isset($_GET["lang"])){
	if ($_GET["lang"] == "sv" or $_GET["lang"] == "en"){
		$_SESSION["lang"] = $_GET["lang"];
	} else {
		$_SESSION["lang"] = "en";
	}
} elseif (!$_SESSION["lang"]){
	$_SESSION["lang"] = "en";
}
include ("lang/".$_SESSION["lang"].".php");


$GLOBALS['config'] = array(
	'mysql' => array(
		'host'		=>	'', // Fyll i databasserver (T.ex ip-adress till servern, vet du inte denna, testa med 127.0.0.1 eller kontakt din webbhotellsleverantör)
		'username'	=>	'', // Fyll i databasanvändarnamn (Har du ej detta, kontakta din webbhotellsleverantör)
		'password'	=>	'', // Fyll i databaslösenordet (Har du ej detta, kontakta din webbhotellsleverantör)
		'db'		=>	'' // Fyll i databasnamnet (Har du ej detta, kontakta din webbhotellsleverantör)
	),
	'remember' => array(
		'cookie_name'	=>	'hash',
		'cookie_expiry' =>	604800
	),
	'session' => array(
		'session_name'	=>	'user',
		'token_name'	=>	'token'
	)
);


spl_autoload_register(function($class) {
	require_once "classes/".$class.'.php';
});

require_once 'functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

	if($hashCheck->count()){
		$user = new User($hashCheck->first()->user_id);

		$user->login();
	}

}

$user = new User();