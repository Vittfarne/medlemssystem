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
			'firstname'			=>	array(
				'required'		=> true,
				'min'			=> 2,
				'max'			=> 50
			),
			'lastname'			=>	array(
				'required'		=> true,
				'min'			=> 2,
				'max'			=> 50
			),
			'address'			=>	array(
				'required'		=> true,
				'min'			=> 2,
				'max'			=> 50
			),
			'zip'			=>	array(
				'required'		=> true,
				'min'			=> 5,
				'max'			=> 5,
				'numeric'		=> true
			),
			'ssn'			=>	array(
				'required'		=> true,
				'min'			=> 10,
				'max'			=> 10,
				'pnum'			=> true,
				'unique'		=> 'users'
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
					'username'		=>	Input::get('username'),
					'email'			=>	Input::get('email'),
					'password'		=>	Hash::make(Input::get('password'), $salt),
					'salt'			=>	$salt,
					'firstname'		=>	Input::get('firstname'),
					'lastname'		=>	Input::get('lastname'),
					'address'		=>	Input::get('address'),
					'zip'			=>	Input::get('zip'),
					'city'			=>	Input::get('city'),
					'ssn'			=>	Input::get('ssn'),
					'steamid'		=>	Input::get('steamid'),
					'phone'			=>	Input::get('phone'),
					'joined'		=>	date('Y-m-d H:i:s'),
					'group'			=>	1
					));

				//Send confirm email.
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
			<label for="firstname"><?php echo $LANG['enteryour']; ?> <?php echo $LANG['firstname_lower']; ?></label>
			<input type="text" name="firstname" id="firstname" value="<?php echo escape(Input::get('firstname'));?>" placeholder="<?php echo $LANG['firstname']; ?>">
		</div>
		<div class="field">
			<label for="lastname"><?php echo $LANG['enteryour']; ?> Lastname</label>
			<input type="text" name="lastname" id="lastname" value="<?php echo escape(Input::get('lastname'));?>" placeholder="Lastname">
		</div>
		<div class="field">
			<label for="gender"><?php echo $LANG['enteryour']; ?> Gender</label>
			<select name="gender" id="gender">
				<option value="m">Male</option>
				<option value="f">Female</option>
			</select>
		</div>
		<div class="field">
			<label for="address"><?php echo $LANG['enteryour']; ?> address</label>
			<input type="text" name="address" id="address" value="<?php echo escape(Input::get('address'));?>" placeholder="address">
		</div>
		<div class="field">
			<label for="phone"><?php echo $LANG['enteryour']; ?> phone number</label>
			<input type="tel" name="phone" id="phone" value="<?php echo escape(Input::get('phone'));?>" autocomplete="off" placeholder="Phone number">
		</div>
		<div class="field">
			<label for="ssn"><?php echo $LANG['enteryour']; ?> <?php echo $LANG['socialsecurity_number']; ?></label>
			<input type="number" name="ssn" id="ssn" value="<?php echo escape(Input::get('ssn'));?>" autocomplete="off" placeholder="<?php echo $LANG['socialsecurity_number']; ?>">
			<br><i>Entered in the format of yymmddxxxx (9512124554)</i>
		</div>
		<div class="field">
			<label for="steamid"><?php echo $LANG['enteryour']; ?> steamid</label>
			<input type="text" name="steamid" id="steamid" value="<?php echo escape(Input::get('steamid'));?>" placeholder="steamid">
			<br><a href="#" target="_blank"><i>Find out how to find your steamid?</i></a>
		</div>
		<div class="field">
			<label for="agree">Accept <a href="#" target="_blank">agreement?</a></label>
			<input type="checkbox" name="agree" id="agree">
		</div>
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register">
		<input type="reset" value="Clear form">
	</form>
<?php
include_once 'includes/bottom.php';
?>