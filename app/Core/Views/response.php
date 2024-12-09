<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

/**
 * @var array $result
 */

$mainPage = $GLOBALS['DIR_PROJECT'];
$class = $result['result'] === 'error' ? 'alert-danger' : 'alert-success';
?>
<div class="container my-5">
	<?php if (isset($result['message']) && $result['message']): ?>
		<div class="alert <?=$class?>"><?= $result['message'] ?></div>
	<?php endif; ?>
	<a href="<?=$mainPage?>" class="btn btn-outline-success mb-4">Back</a>
</div>

