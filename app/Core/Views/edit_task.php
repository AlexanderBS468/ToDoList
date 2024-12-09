<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

use ProjectA\Core\Controllers\Admin;

/**
 * @var Illuminate\Database\Eloquent\Collection|array $task
 * @var array $valuesStatus
 */

if (!Admin::isAdmin()) {
	header('Location: login.php');
	exit();
}
?>

<div class="container my-5">
	<?php
	if ($task)
	{
		?>
		<h2>Edit Task <?=$task['id']?></h2>
		<form method="POST" action="?action=edit">
			<input type="hidden" id="session_id" name="session_id" value="<?=$_SESSION['session_id']?>">
			<input type="hidden" name="task_id" value="<?=$task['id']?>">
			<table class="table table-striped table-bordered table-hover">
				<thead>
				<tr>
					<th scope="col">Username</th>
					<th scope="col">Email</th>
					<th scope="col">Task</th>
					<th scope="col">Status</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="username">
								<input type="text" id="username" name="username" value="<?=$task['username']?>" required>
							</label>
						</td>
						<td>
							<label for="email">
								<input type="email" id="email" name="email" value="<?=$task['email']?>" required>
							</label>
						</td>
						<td>
							<label for="task_text">
								<textarea id="task_text" name="task_text" cols="30" rows="10" required><?=$task['task_text']?></textarea>
							</label>
						</td>
						<td>
							<label for="status">
								<select class="form-select" id="status" name="status">
									<?php

									foreach ($valuesStatus as $value)
									{
										?><option <?=((int)$task['status'] === (int)$value['value'] ? 'selected' : '')?> value="<?=$value['value']?>"><?=$value['title']?></option><?php
									}
									?>
								</select>
							</label>
						</td>
					</tr>
				</tbody>
			</table>
			<button type="submit" class="btn btn-outline-success mb-4" name="update" value="update">Update</button>
		</form>
		<?php
	}
	else
	{
		?><p>Record not found</p><?php
	}
	?>
</div>
