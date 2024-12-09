<?php

namespace ProjectA\Core\Controllers;

use ProjectA\Core\Model;
use Illuminate\Pagination\Paginator;
use ProjectA\Core\Tools\Validator\Email;

class Task
{
	public function index() : void
	{
		Paginator::currentPageResolver(function () {
			return isset($_GET['page']) ? (int) $_GET['page'] : 1;
		});

		$countOnPage = 3;
		$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'id';
		$direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';
		$page = $_GET['page'] ?? 1;

		$totalTasks = Model\Task::count();
		$totalPages = ceil($totalTasks / $countOnPage);

		$tasks = Model\Task::orderBy($sortBy, $direction)
		                   ->paginate($countOnPage);

		$tasks->appends(['sort' => $sortBy, 'direction' => $direction]);
		include __DIR__ . '/../Views/tasks.php';
	}

	public function create() : array
	{
		$validateEmail = Email::checkMail($_POST['email']);

		$result = [
			'result' => 'error',
			'message' => 'Invalid fields'
		];

		if (!$validateEmail)
		{
			$result = [
				'result' => 'error',
				'message' => 'Invalid email'
			];
		}

		if ($_POST['username'] && $_POST['task_text'])
		{
			Model\Task::create([
				'username' => $_POST['username'],
				'email' => $_POST['email'],
				'task_text' => $_POST['task_text'],
				'status' => 0,
			]);

			$result = [
				'result' => 'success',
				'message' => 'Create task successful'
			];
		}

		return $result;
	}

	public static function updateTask($id)
	{
		$task = Model\Task::find($id);

		$result = [
			'result' => 'error',
			'message' => 'Incorrect fields'
		];

		if ($task && $_POST['username'] && $_POST['email'] && $_POST['task_text'] && isset($_POST['status'])) {
			$task->username = $_POST['username'];
			$task->email = $_POST['email'];
			$task->task_text = $_POST['task_text'];
			$task->status = $_POST['status'];
			$task->save();

			$result = [
				'result' => 'success',
				'message' => 'Update success'
			];
		}

		return $result;
	}
}
