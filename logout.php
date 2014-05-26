<?php
require_once('core/init.php');

$user = new User();
$user->logout();

Session::flash('home', $LANG['youloggedout']);
Redirect::to('index.php');