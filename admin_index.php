<?php
require_once 'core/init.php';
$pagename = "Admin-page";
include_once 'includes/head.php';
include_once 'includes/header.php';


$user = new User();

if ($user->isLoggedIn()){

	if ($user->hasPermission('admin')){
	
	?>

	<p>Hi <a href="#"><?php echo escape($user->data()->username); ?></a>!</p>
	<p>User actions effecting you.</p>
	<ul>
	<li><a href="../logout.php">Logout</a></li>
	<li><a href="../update.php">Update details</a></li>
	<li><a href="../changepassword.php">Change Password</a></li>
	</ul>
	
	<p>Actions on other users</p>
	<ul>
		<li><a href="users.php">Useractions</a></li>
		<li><a href="#"></a></li>
		<li><a href="#"></a></li>
	</ul>

	<?php
	} else {
		Redirect::to('index.php');
	}

} else {
	Redirect::to('index.php');
}



include_once 'includes/bottom.php';
?>