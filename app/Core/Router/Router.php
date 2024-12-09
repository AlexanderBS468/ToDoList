<?php

namespace ProjectA\Core\Router;

use ProjectA\Core\Controllers\ActionController;

class Router
{
	private array $routes = [];

	/**
	 * @description Add router
	 *
	 * @param $route
	 * @param $action
	 *
	 * @return void
	 */
	public function addRoute($route, $action) : void
	{
		$this->routes[$route] = $action;
	}

	public function dispatch($url) : void
	{
		$url = $_SERVER['REQUEST_URI'];
		$parsedUrl = parse_url($url);
		$path = $parsedUrl['path'];

		foreach ($this->routes as $route => $action) {
			if (preg_match("~^$route$~", $path)) {
				$this->$action();
				return;
			}
		}

		echo 'Page not found';
	}

	private function home() : void
	{
		ActionController::do();
	}

	private function about() : void
	{
		ActionController::do('static');
		include __DIR__ . '/../Views/about.php';
	}
}