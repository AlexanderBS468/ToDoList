<?php

namespace ProjectA\Core\Controllers;

use JetBrains\PhpStorm\NoReturn;
use ProjectA\Core\Model;

class Admin
{
	public static function isAdmin() : bool
	{
		return !(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true);
	}

	public function login() : array
	{
		$sessionValid = checkSessId();
		$errorMsg = 'Error fields';
		$isValid = null;
		if (isset($_POST['username']) && $_POST['password'])
		{
			if (!$sessionValid)
			{
				$errorMsg = 'Error session';
			}
			elseif ($_POST['username'] === 'admin' && $_POST['password'] === '123')
			{
				$isValid = true;
			}
			else
			{
				$errorMsg = 'Error user and password';
			}
		}

		if ($isValid)
		{
			$_SESSION['isAdmin'] = true;
			header('Location: index.php');
			exit();
		}

		return [
			'result' => 'error',
			'message' => $errorMsg
		];
	}

	#[NoReturn] public function logOut() : void
	{
		session_unset();

		session_destroy();

		header('Location: index.php');
		exit();
	}

	public function edit()
	{
		if (!checkSessId())
		{
			header('Location: index.php');
			exit();
		}

		if (isset($_POST['update']) && $updateId = $_POST['task_id'])
		{
			return Task::updateTask($updateId);
		}
		else
		{
			$id = $_POST['edit_id'];
			if ($id && $id > 0)
			{
				if($result = Model\Task::getTaskById($id))
				{
					return [
						'result' => 'success',
						'item' => $result
					];
				}
			}
		}

		return [
			'result' => 'error',
			'message' => 'Undefined element'
		];
	}

	public function renderAdminEdit($task) : void
	{
		$valuesStatus = [
			[
				'value' => 0,
				'title' => 'Not Completed',
			],
			[
				'value' => 1,
				'title' => 'In Progress',
			],
			[
				'value' => 2,
				'title' => 'Completed',
			],
		];
		include __DIR__ . '/../Views/edit_task.php';
	}
}