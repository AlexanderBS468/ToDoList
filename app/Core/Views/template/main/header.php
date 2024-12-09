<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

use ProjectA\Core\Controllers\Admin;

const LANGUAGE_ID = 'ru';

$mainPathAssets = $GLOBALS['DIR_PROJECT'] . 'Core/';
$mainPage = $GLOBALS['DIR_PROJECT'];
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo List</title>
	<link rel="stylesheet" href="<?=$mainPathAssets?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
	<script src="<?=$mainPathAssets?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="container">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
			<div class="col-md-3 mb-2 mb-md-0">
				<a href="<?=$mainPage?>" class="d-inline-flex link-body-emphasis text-decoration-none">ToDo List</a>
			</div>

			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				<li><a href="<?=$mainPage?>" class="nav-link px-2 link-secondary">Home</a></li>
				<li><a href="<?=$mainPage?>about" class="nav-link px-2">About</a></li>
			</ul>

			<div class="col-md-3 text-end">
				<?php if (Admin::isAdmin()): ?>
					<a href="?action=logout" class="btn btn-outline-danger me-2">Logout</a>
				<?php else: ?>
					<button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
				<?php endif; ?>
			</div>
		</header>
	</div>
