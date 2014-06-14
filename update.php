<?php
require_once 'core/init.php';
$pagename = "Update";
include_once 'includes/head.php';
include_once 'includes/header.php';

$user = new User();

if (!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check((Input::get('token')))){

		$validate = new Validate();

		$validation = $validate->check($_POST, array(
			'firstname' => array (
				'required' => true,
				'min' => 2,
				'max' => 50
				),
			'lastname' => array (
				'required'	=> true,
				'min'	=> 2,
				'max'	=> 50
				)
			));

		if($validation->passed()){
			
			try {
				$user->update(array(
					'firstname' => Input::get('firstname'),
					'lastname'	=> Input::get('lastname')
					));

				Session::flash('home', $LANG['updatecompl']);
				Redirect::to('index.php');
			} catch(Exception $e){
				die($e->getMessage());
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
		<label for="firstname"><?php echo $LANG['firstname']; ?></label>
		<input type="text" name="firstname" value="<?php echo escape($user->data()->firstname); ?>">
	</div>
	<div class="field">
		<label for="lastname">Lastname</label>
		<input type="text" name="lastname" value="<?php echo escape($user->data()->lastname); ?>">
		
		<input type="submit" value="<?php echo $LANG['update_button']; ?>">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>

<?php
include_once 'includes/bottom.php';
?>