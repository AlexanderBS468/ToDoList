<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

/**
 * @var Illuminate\Pagination\LengthAwarePaginator $tasks
 */

?>
<style>
	.pagination .active a {
		color: red;
	}
</style>
<ul class="pagination">
	<?php if ($tasks->onFirstPage()): ?>
		<li class="disabled"><span class="mx-2">&laquo; Previous</span></li>
	<?php else: ?>
		<li><a class="mx-2"href="<?= $tasks->previousPageUrl() ?>">&laquo; Previous</a></li>
	<?php endif; ?>

	<?php foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url): ?>
		<li class="<?= ($page == $tasks->currentPage()) ? 'active' : '' ?>">
			<a class="mx-2" href="<?= $url ?>"><?= $page ?></a>
		</li>
	<?php endforeach; ?>

	<?php if ($tasks->hasMorePages()): ?>
		<li><a class="mx-2" href="<?= $tasks->nextPageUrl() ?>">Next &raquo;</a></li>
	<?php else: ?>
		<li class="disabled"><span class="mx-2">Next &raquo;</span></li>
	<?php endif; ?>
</ul>