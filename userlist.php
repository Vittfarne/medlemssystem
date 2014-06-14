<?php
require_once 'core/init.php';
$pagename = $LANG['homepage'];
include_once 'includes/head.php';
include_once 'includes/header.php';

if (Session::exists('home')){
	echo '<p>'. Session::flash('home') . '</p>';
}



if ($user->isLoggedIn()){

	?>
	<table border="1">
		<tr>
			<th>Username</th>
			<th>First name</th>
			<?php
			if ($user->hasPermission('moderator')){
				?>
			<th>E-mail</th>
			<th>Steamid</th>
				<?php
			}

			?>
			<?php 
      	if ($user->hasPermission('admin')){
				?>
		<th>Address</th>
		<th>Zip</th>
		<th>City</th>
		<th>Phone</th>
				<?php
			}
			?>

		</tr>



	<?php

$user_id = array(1,2,3);
	foreach($user_id as $user_id) {
      $profileuser = new User($user_id);
      ?>

      <tr>
      	<td><?php echo escape($profileuser->data()->username); ?></td>
      	<td><?php echo escape($profileuser->data()->firstname); ?></td>
      	<?php 
      	if ($user->hasPermission('moderator')){
				?>
		<td><?php echo escape($profileuser->data()->email); ?></td>
		<td><?php echo escape($profileuser->data()->steamid); ?></td>
				<?php
			}
			?>
		<?php 
      	if ($user->hasPermission('admin')){
				?>
		<td><?php echo escape($profileuser->data()->address); ?></td>
		<td><?php echo escape($profileuser->data()->zip); ?></td>
		<td><?php echo escape($profileuser->data()->city); ?></td>
		<td><?php echo escape($profileuser->data()->phone); ?></td>
				<?php
			}
			?>
      </tr>
      <?php
	}

	?>


</table>

	<?php

print_r($user->countregusers()->count());




} else {
	echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>';
}



include_once 'includes/bottom.php';