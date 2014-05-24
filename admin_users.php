<?php
require_once 'core/init.php';
$pagename = "Users";
include_once 'includes/head.php';
include_once 'includes/header.php';


$user = new User();

if ($user->isLoggedIn()){

	if ($user->hasPermission('admin')){
	
	?>

	<p>Hi <a href="#"><?php echo escape($user->data()->username); ?></a>!</p>
	
	

	<?php
	} else {
		Redirect::to('index.php');
	}

} else {
	Redirect::to('index.php');
}



include_once 'includes/bottom.php';
?>