<?php
$pagename = "Startpage";
require_once 'core/init.php';
include_once 'includes/head.php';
include_once 'includes/header.php';

if (Session::exists('home')){
	echo '<p>'. Session::flash('home') . '</p>';
}



if ($user->isLoggedIn()){
	?>

	<p>Hi <a href="#"><?php echo escape($user->data()->username); ?></a>!</p>

	<ul>
	<li><a href="logout.php">Logout</a></li>
	<li><a href="update.php">Update details</a></li>
	<li><a href="changepassword.php">Change Password</a></li>
</ul>

	<?php

	if ($user->hasPermission('moderator')){
		echo "Yes";
	}

} else {
	echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
}



include_once 'includes/bottom.php';
?>