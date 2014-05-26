
<header>
	<section class="logoarea">
		<h1 class="centeralign">Medlemssystem</h1>
	</section>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="">Info</a></li>
			<li><a href="">Documents</a></li>
			<?php
			if (!$user->isLoggedIn()){?>
			<li><a href="login.php"><?php echo $LANG['login']; ?></a></li>
			<li><a href="register.php"><?php echo $LANG['register']; ?></a></li>
			<?php
			} else {
				if ($user->hasPermission('admin')){
					echo '<li><a href="admin_index.php">Admin area</a></li>';
				}
				?>
			<li><a href="logout.php"><?php echo $LANG['logout']; ?></a>
</li>				<?php
			}
			?>
		</ul>		
	</nav>
	<div class="lang">
		<p>
			<a href="?lang=en"><img src="images/flags/en.png" alt=""></a>
			<a href="?lang=sv"><img src="images/flags/se.png" alt=""></a>
		</p>
	</div>
</header>
