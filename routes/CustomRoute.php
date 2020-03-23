<?php

namespace Routes;

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class CustomRoute
{
	public static function init($url)
	{
		$router = new RouteCollector();

		/**
		 * Danh sách các filter 
		 */
		$router->filter('auth', function () {
			if (!isset($_SESSION['user'])) {
				header('Location: ' . BASE_URL);
				return false;
			}
		});

		//Routes
		$router->get('/', ['Controllers\HomeController', 'index']);

		$router->get('login', ['Controllers\UserController', 'login']);
		$router->post('post-login', ['Controllers\UserController', 'post_login']);
		$router->get('logout', ['Controllers\UserController', 'logout']);

		$router->get('product/{}', ['Controllers\HomeController', 'productDetail']);
		$router->get('category/{}', ['Controllers\HomeController', 'categoriedProducts']);

		$router->get('cart/{}', ['Controllers\CartController', 'add2Cart']);
		$router->get('cart-detail', ['Controllers\CartController', 'showCart']);
		$router->post('check-out', ['Controllers\CartController', 'checkout']);
		$router->get('remove-cart-item/{}', ['Controllers\CartController', 'deleteItemInCart']);
		$router->post('updateQuantity', ['Controllers\CartController', 'updateQuantity']);

		$router->group(['prefix' => 'admin', 'before' => 'auth'], function ($router) {

			$router->get('/', ['Controllers\HomeController', 'admin']);

			$router->group(['prefix' => 'category'], function ($router) {
				$router->get('list', ['Controllers\CategoryController', 'list']);
				$router->get('add', ['Controllers\CategoryController', 'add']);
				$router->post('saveAdd', ['Controllers\CategoryController', 'saveAdd']);
				$router->get('edit/{id:i}', ['Controllers\CategoryController', 'edit']);
				$router->post('saveEdit', ['Controllers\CategoryController', 'saveEdit']);
				$router->get('remove/{id:i}', ['Controllers\CategoryController', 'remove']);
				$router->post('removeMultiple', ['Controllers\CategoryController', 'removeMultiple']);
			});

			$router->group(['prefix' => 'product'], function ($router) {
				$router->get('list', ['Controllers\ProductController', 'list']);
				$router->get('add', ['Controllers\ProductController', 'add']);
				$router->post('saveAdd', ['Controllers\ProductController', 'saveAdd']);
				$router->get('edit/{id:i}', ['Controllers\ProductController', 'edit']);
				$router->post('saveEdit', ['Controllers\ProductController', 'saveEdit']);
				$router->get('remove/{id:i}', ['Controllers\ProductController', 'remove']);
				$router->post('removeMultiple', ['Controllers\ProductController', 'removeMultiple']);
			});

			$router->group(['prefix' => 'invoice'], function ($router) {
				$router->get('list', ['Controllers\InvoiceController', 'list']);
				$router->get('invoice-detail/{id}', ['Controllers\InvoiceController', 'invoiceDetail']);
				$router->get('sendMail/{}', ['Controllers\InvoiceController', 'sendMail']);
				$router->get('remove/{}', ['Controllers\InvoiceController', 'remove']);
			});

			$router->group(['prefix' => 'user'], function ($router) { });
		});



		$dispatcher = new Dispatcher($router->getData());

		$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));

		// Print out the value returned from the dispatched function
		echo $response;
	}
}
