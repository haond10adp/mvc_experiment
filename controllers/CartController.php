<?php

namespace Controllers;

use Models\{Product, Invoice, InvoiceDetail, Category};
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class CartController extends BaseController
{

	public function add2Cart($id)
	{
		$pro = Product::find($id);
		if ($pro == null) {
			header('location: ' . BASE_URL);
			die;
		}
		$item = [
			'id' => $pro->id,
			'name' => $pro->name,
			'image' => $pro->image,
			'price' => $pro->price,
			'quantity' => 1
		];

		if (!isset($_SESSION[CART]) || count($_SESSION[CART]) == 0) {
			$_SESSION[CART][] = $item;
		} else {
			$cart = $_SESSION[CART];
			$existed = false;

			for ($i = 0; $i < count($cart); $i++) {
				if ($cart[$i]['id'] == $pro->id) {
					$existed = true;
					$cart[$i]['quantity'] += 1;
					break;
				}
			}

			if ($existed == false) {
				$cart[] = $item;
			}

			$_SESSION[CART] = $cart;
		}
		header('location: ' . BASE_URL);
		die;
	}

	public function showCart()
	{
		$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		if (count($cart) <= 0) {
			header('location: ' . BASE_URL);
			die;
		}
		$categories = Category::where('show_menu', 1)->get();

		return $this->render('site.cart-detail', compact('cart', 'categories'));
	}

	public function deleteItemInCart($id)
	{
		$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		$index = false;
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['id'] == $id) {
				$index = $i;
				break;
			}
		}

		if ($index !== false) {
			array_splice($cart, $index, 1);
		}

		$_SESSION[CART] = $cart;
		if (count($cart) == 0) {
			header('location: ' . BASE_URL);
			die;
		} else {
			header('location: ' . BASE_URL . 'cart-detail');
			die;
		}
	}

	public function updateQuantity()
	{
		$quantity = $_POST['quantity'] ?? '';
		$cart = &$_SESSION[CART];
		$i = 0;
		foreach ($cart as &$value) {
			$value['quantity'] = intval($quantity[$i]);
			$i++;
		}

		echo '$' . getCartTotalPrice();
	}

	public function checkout()
	{
		// lấy data từ form gửi lên
		$customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : "";
		$customer_phone_number = isset($_POST['customer_phone_number']) ? $_POST['customer_phone_number'] : "";
		$customer_email = isset($_POST['email']) ? $_POST['email'] : "";
		$customer_address = isset($_POST['customer_address']) ? $_POST['customer_address'] : "";
		$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "";

		$customer = new \stdClass;
		$customer->name = $customer_name;
		$customer->phone_number = $customer_phone_number;
		$customer->email = $customer_email;
		$customer->address = $customer_address;
		$customer->payment_method = $payment_method;

		$customerValidator = v::attribute('name', v::notEmpty())
			->attribute('phone_number', v::phone())
			->attribute('email', v::email())
			->attribute('address', v::notEmpty()->length(5, null))
			->attribute('payment_method', v::numeric()->positive());

		try {
			$customerValidator->assert($customer);
		} catch (NestedValidationException $exception) {
			$messages = $exception->getMessages();
			foreach ($messages as $message) {
				$key = strtok($message, " ");
				switch ($key) {
					case 'name':
						$errors['name'][] = $message;
						break;
					case 'phone_number':
						$errors['phone_number'][] = $message;
						break;
					case 'email':
						$errors['email'][] = $message;
						break;
					case 'address':
						$errors['address'][] = $message;
						break;
					case 'payment_method':
						$errors['payment_method'][] = $message;
						break;
					default:
						# code...
						break;
				}
			}
		}

		if ($errors) {
			$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
			if (count($cart) <= 0) {
				header('location: ' . BASE_URL);
				die;
			}
			$categories = Category::where('show_menu', 1)->get();

			return $this->render('site.cart-detail', compact('cart', 'categories', 'customer', 'errors'));
		} else {
			$total_price = getCartTotalPrice();

			// lưu thông tin vào bảng invoices
			$invoice = new Invoice();
			$invoice->customer_name = $customer_name;
			$invoice->customer_phone_number = $customer_phone_number;
			$invoice->customer_email = $customer_email;
			$invoice->customer_address = $customer_address;
			$invoice->payment_method = $payment_method;
			$invoice->total_price = $total_price;
			$invoice->save();

			$newInvoice = Invoice::find($invoice->id);

			$cart = $_SESSION[CART];
			foreach ($cart as $pro) {
				$invoiceDetail = new InvoiceDetail();
				$invoiceDetail->invoice_id = $newInvoice->id;
				$invoiceDetail->product_id = $pro['id'];
				$invoiceDetail->quantity = $pro['quantity'];
				$invoiceDetail->unit_price = $pro['price'];
				$invoiceDetail->save();
			}

			unset($_SESSION[CART]);
			header('location: ' . "admin/invoice/sendMail/$invoice->id");
			die;
		}
	}
}
