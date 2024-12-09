<?php
if (!defined("PROLOG_INCLUDED") || PROLOG_INCLUDED!==true) { die(); }

use ProjectA\Core\Controllers\Admin;

		if (!Admin::isAdmin()): ?>
			<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="loginModalLabel">Login</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<?php
							include __DIR__ . '/../../login.php'
							?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form method="POST" action="<?=$GLOBALS['DIR_PROJECT']?>index.php?action=addTask">
							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" id="username" name="username" required>
							</div>
							<div class="mb-3">
								<label for="username" class="form-label">email</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="mb-3">
								<label for="task_text" class="form-label">Task Text</label>
								<textarea class="form-control" id="task_text" name="task_text" required></textarea>
							</div>
							<button type="submit" name="add_task" class="btn btn-primary">Add Task</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>