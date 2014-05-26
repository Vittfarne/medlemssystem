<?php
require_once 'core/init.php';
$pagename = $LANG['login'];
include_once 'includes/head.php';
include_once 'includes/header.php';


if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));
		if($validation->passed()){
			$user = new User();

			$remember = Input::get('remember') === 'on' ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login) {
				Session::flash('home', 'Logged in!');
				Redirect::to('index.php');
			} else {
				echo "<p class=\"error\">{$LANG['loginfailed']}</p>";
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
		<label for="username"><?php echo $LANG['username']; ?></label>
		<input type="text" name="username" id="username" placeholder="<?php echo $LANG['username']; ?>" autocomplete="off">
	</div>
	<div class="field">
		<label for="password"><?php echo $LANG['password']; ?></label>
		<input type="password" name="password" id="password" placeholder="<?php echo $LANG['password']; ?>"  autocomplete="off">
	</div>
	<div class="field">
		<label for="remember">
		<input type="checkbox" name="remember" id="remember" autocomplete="off"> <?php echo $LANG['rememberme']; ?>
		</label>
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="<?php echo $LANG['login']; ?>">
</form>
<p><i><a href="#"><?php echo $LANG['resetpw']; ?></a></i></p>

<?php
include_once 'includes/bottom.php';
?>