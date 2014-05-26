<?php
$pagename = "Change password";
require_once 'core/init.php';
include_once 'includes/head.php';
include_once 'includes/header.php';

$user = new User();

if (!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
//Used to redirect to index page if not logged in


If(Input::exists()){
	if(Token::check((Input::get('token')))){
		$validate = new Validate();

		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min'	=> 6
				),
			'password_new' => array(
				'required' => true,
				'min'	=> 6
				),
			'password_new_again' => array(
				'required' => true,
				'min'	=> 6,
				'match' => 'password_new'
				)

			));

		if($validation->passed()){
			if(Hash::make(Input::get('password_current'), $user->data()->salt !== $user->data()->password))  {
				echo 'Current password is wrong';
			} else {
				$salt = Hash::salt(32);
				$user->update(array(
					'password'	=> Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
					));

				Session::flash('home', $LANG['pwchanged']);
				Redirect::to('index.php');
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}



?>


<form action="" method="POST">
	<div class="field">
		<label for="password_current"><?php echo $LANG['current']; ?> <?php echo $LANG['password_lower']; ?></label>
		<input type="password" name="password_current" id="password_current">
	</div>	
	<div class="field">
		<label for="password_new"><?php echo $LANG['new']; ?> <?php echo $LANG['password_lower']; ?></label>
		<input type="password" name="password_new" id="password_new">
	</div>
	<div class="field">
		<label for="password_new_again"><?php echo $LANG['repeatthe']; ?> <?php echo $LANG['password_lower']; ?></label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>

	<input type="submit" value="<?php echo $LANG['change_button']; ?>">
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<?php
include_once 'includes/bottom.php';
?>