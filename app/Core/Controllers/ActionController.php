<?php
namespace ProjectA\Core\Controllers;

use ProjectA\Core\Controllers;

class ActionController
{
	public static function do($type = 'all') : void
	{
		$result = self::actionAdmin();
		self::actionUser();

		require_once "Core/header.php";
		if ($result)
		{
			self::response($result);
		}

		if ($type !== 'static')
		{
			switch ($result['typeView'])
			{
				case 'edit':
					$item = $result['item'] ?? [];
					if ($item) {
						(new Admin())->renderAdminEdit($item);
					}
					break;
				default:
				case 'tasks':
					self::renderTasks();
					break;
			}
		}

		require_once 'Core/footer.php';
	}

	public static function actionAdmin() : array
	{
		$adminController = new Controllers\Admin();
		$result = [
			'typeView' => 'tasks',
		];

		if (isset($_GET['action']))
		{
			if ($_GET['action'] === 'login')
			{
				$result = $adminController->login();
			}
			elseif ($_GET['action'] === 'logout')
			{
				$adminController->logOut();
			}
			elseif ($_GET['action'] === 'edit' && $adminController::isAdmin())
			{
				$result = $adminController->edit();
				$result['typeView'] = 'edit';
			}
		}

		return $result;
	}

	public static function actionUser() : void
	{
		$taskController = new Controllers\Task();
		if (isset($_GET['action']) && $_GET['action'] === 'addTask')
		{
			$result = $taskController->create();

			if ($result['result'] === 'success')
			{
				header('Location: index.php');
				exit();
			}

			self::response($result);
		}
	}

	public static function renderTasks() : void
	{
		(new Controllers\Task())->index();
	}

	public static function response($result) : void
	{
		if(isset($result['result']) && $result['result'])
		{
			include __DIR__ . '/../Views/response.php';
		}
	}
}
