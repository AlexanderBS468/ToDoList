<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

use ProjectA\Core\Controllers\Admin;

/**
 * @var Illuminate\Database\Eloquent\Collection $tasks
 */

$isAdmin = Admin::isAdmin();
?>

<div class="container my-5">
	<h2>Task List</h2>
	<?php

	if ($tasks->count() === 0)
	{
		?><p>Add new tasks</p><?php
	}
	else
	{
		?>
		<div class="sort-dropdown mb-5">
			<span>Sort by</span>
			<select class="form-select" aria-label="Sort tasks" onchange="window.location.href = window.location.pathname + '?sort=' + this.value;">
				<?php
				foreach (['username', 'email', 'status'] as $value)
				{
					?><option <?=(isset($_GET['sort']) && $_GET['sort'] === $value ? 'selected' : '')?> value="<?=$value?>"><?=$value?></option><?php
				}
				?>
			</select>
		</div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Task</th>
				<th scope="col">Status</th>
				<?php if($isAdmin):?>
					<th scope="col">Action</th>
				<?php endif;?>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($tasks as $task)
			{
				$status = match($task['status']) {
					0 => ['class' => 'bg-danger', 'text' => 'Not Started'],
					1 => ['class' => 'bg-warning', 'text' => 'In Progress'],
					2 => ['class' => 'bg-success', 'text' => 'Completed'],
				};

				?>
				<tr>
					<td><?=$task['username']?></td>
					<td><?=$task['email']?></td>
					<td><?=$task['task_text']?></td>
					<td><span class="badge <?=$status['class']?>"><?=$status['text']?></span></td>
					<?php
					if($isAdmin)
					{
						?><td><form method="POST" action="?action=edit"><input type="hidden" id="session_id" name="session_id" value="<?=$_SESSION['session_id']?>"><button type="submit" class="btn btn-outline-success mb-4" name="edit_id" value="<?=$task['id']?>">Update</button></form></td><?php
					}
					?>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php
		include 'pagination.php';
	}
	?>
	<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add Task</button>
</div>
