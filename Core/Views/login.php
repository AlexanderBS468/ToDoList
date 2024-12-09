<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

/**
 * @var string $error
 */
?>

	<form method="POST" action="<?=$GLOBALS['DIR_PROJECT']?>index.php?action=login">
		<input type="hidden" id="session_id" name="session_id" value="<?=$_SESSION['session_id']?>">
		<div class="mb-3">
			<label for="username" class="form-label">Username</label>
			<input type="text" class="form-control" id="username" name="username" required>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" id="password" name="password" required>
		</div>
		<button type="submit" name="login" value="submit" class="btn btn-primary">Login</button>
	</form>
