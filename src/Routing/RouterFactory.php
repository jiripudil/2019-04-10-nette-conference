<?php declare(strict_types = 1);

namespace App\Routing;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;


final class RouterFactory
{

	public function createRouter(): Router
	{
		$router = new RouteList();

		$router[] = new Route('products[/<page \d+>]', 'ProductList:default');
		$router[] = new Route('product/<id \d+>', 'ProductDetail:default');
		$router[] = new Route('basket', 'Basket:default');
		$router[] = new Route('/', 'ProductList:default', Route::ONE_WAY);

		return $router;
	}

}
