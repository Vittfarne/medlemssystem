<?php
require_once 'core/init.php';
$pagename = "Profile";
include_once 'includes/head.php';
include_once 'includes/header.php';

if(!$username = Input::get('user')){
	if (!$user->isLoggedIn()){
	Redirect::to('index.php');
	}
} else {
	$profileuser = new User($username);
	if(!$profileuser->exists()){
		Redirect::to(404);
	} else {
		$data = $profileuser->data();
	}
	?>

	<h3><?php echo escape($data->username); ?></h3>
	<p>Firstname: <?php echo escape($data->firstname); ?></p>
	<?php
	if ($user->isLoggedIn()){
	if ($user->hasPermission('moderator')){
		?>
	<p>Lastname: <?php echo escape($data->lastname); ?></p>
	<p>E-mail: <?php echo escape($data->email); ?></p>
	<p>Steamid: <?php echo escape($data->steamid); ?></p>
	<?php
	}

	if ($user->hasPermission('admin')) {
		?>
	<p>Address: <?php echo escape($data->address); ?></p>
	<p>Zip: <?php echo escape($data->zip); ?></p>
	<p>City: <?php echo escape($data->city); ?></p>
	<p>Phone: <?php echo escape($data->phone); ?></p>

		<?php
	}

}
}

include_once 'includes/bottom.php';