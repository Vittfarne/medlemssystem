<?php
require_once 'core/init.php';
$pagename = $LANG['register'];
include_once 'includes/head.php';
include_once 'includes/header.php';

if (Input::exists()) {
	if(Token::check(Input::get('token'))); {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username'		=>	array(
				'required'		=> true,
				'min'			=> 2,
				'max'			=> 20,
				'unique'		=> 'users',
				'notnumeric'	=> true
			),
			'email'			=>	array(
				'required'		=> true,
				'min'			=> 3,
				'max'			=> 60,
				'unique'		=> 'users',
				'email'			=> true
			),
			'password'		=>	array(
				'required'		=> true,
				'min'			=> 6
			),
			'password_again' =>	array(
				'required'		=> true,
				'matches'		=> 'password'
			),
			'name'			=>	array(
				'required'		=> true,
				'min'			=> 2,
				'max'			=> 50
			),
			'phone' 		=>	array(
				'required'		=> true,
				'min'			=> 10,
				'max'			=> 10,
				'unique'		=> 'users',
				'numeric'		=>	true
			)
		));
		if($validation->passed()) {
			$user = new User();

			$salt = Hash::salt(32);
			try {
				$user->create(array(
					'username'	=>	Input::get('username'),
					'email'		=>	Input::get('email'),
					'password'	=>	Hash::make(Input::get('password'), $salt),
					'salt'		=>	$salt,
					'name'		=>	Input::get('name'),
					'joined'	=>	date('Y-m-d H:i:s'),
					'group'		=>	1,
					'phone'		=>	Input::get('phone')
					));
				Session::flash('home', $LANG['youregistered']);
				Redirect::to('index.php');

			} catch(Exception $e){
				die($e->getMessage());
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error, "<br>";
			}
		}
	}
}

	?>
	<form action="" method="POST">
		<div class="field">
			<label for="username"><?php echo $LANG['entera'] ?> <?php echo $LANG['username_lower'] ?></label>
			<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off" placeholder="<?php echo $LANG['username'] ?>">
		</div>
		<div class="field">
			<label for="email"><?php echo $LANG['email']; ?>:</label>
			<input type="email" name="email" id="email" value="<?php echo escape(Input::get('email'));?>" autocomplete="off" placeholder="<?php echo $LANG['email']; ?>">
		</div>
		<div class="field">
			<label for="password"><?php echo $LANG['entera'] ?> <?php echo $LANG['password']; ?></label>
			<input type="password" name="password" id="password" placeholder="<?php echo $LANG['password']; ?>">
		</div>
		<div class="field">
			<label for="password_again"><?php echo $LANG['enterthe']; ?> <?php echo $LANG['password_lower']; ?> <?php echo $LANG['again']; ?></label>
			<input type="password" name="password_again" id="password_again" placeholder="<?php echo $LANG['password']; ?>">
		</div>
		<div class="field">
			<label for="name"><?php echo $LANG['enteryour']; ?> <?php echo $LANG['name_lower']; ?></label>
			<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name'));?>" placeholder="Name">
		</div>
		<div class="field">
			<label for="phone"><?php echo $LANG['enteryour']; ?> <?php echo $LANG['phonenumber_lower']; ?></label>
			<input type="tel" name="phone" id="phone" value="<?php echo escape(Input::get('phone'));?>" autocomplete="off" placeholder="<?php echo $LANG['phonnumber_lower']; ?>">
		</div>
		<div class="field">
			<label for="ssn"><?php echo $LANG['enteryour']; ?> <?php echo $LANG['socialsecurity_number']; ?></label>
			<input type="number" name="ssn" id="ssn" value="<?php echo escape(Input::get('ssn'));?>" autocomplete="off" placeholder="<?php echo $LANG['socialsecurity_number']; ?>">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register">
	</form>
<?php
include_once 'includes/bottom.php';
?>