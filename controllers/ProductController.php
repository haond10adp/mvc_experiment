<?php 
namespace Controllers;

use Models\Category;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Models\Product;
class ProductController extends BaseController
{
	public function list() {
		$products = Product::orderBy('id', 'desc')->get();
		return $this->render('admin.product.list', compact('products'));
	}

	function remove($id) {
		Product::destroy($id);
		header('location: '.BASE_URL.'admin/product/list');
		return false;
	}

	public function removeMultiple() {
		$ids = $_POST['ids'] ?? '';
		Product::destroy($ids);
		header('location: '.BASE_URL.'admin/product/list');
		return false;
	}

	public function add() {
		$categories = Category::all();
		return $this->render('admin.product.add', compact('categories'));
	}
	
	public function saveAdd() {
		$image = save_file('image', BASE_URL.'public/images/products');
		$name = $_POST['name'] ?? '';
		$cate_id = $_POST['cate_id'] ?? '';
		$price = $_POST['price'] ?? '';
		$short_desc = $_POST['short_desc'] ?? '';
		$detail = $_POST['detail'] ?? '';
		
		$product = new Product();
		$product->name = $name;
		$product->image = $image;
		$product->cate_id = $cate_id;
		$product->price = $price;
		$product->short_desc = $short_desc;
		$product->detail = $detail;
		$product->save();
		header('location: '.BASE_URL.'admin/product/add');
		return false;
	}

	public function edit($id) {
		$product = Product::find($id);
		$categories = Category::all();
		return $this->render('admin.product.edit', compact('product', 'categories'));
	}

	public function saveEdit() {
		$image = save_file('image', BASE_URL.'public/images/products');
		$id = $_POST['id'] ?? '';
		$name = $_POST['name'] ?? '';
		$cate_id = $_POST['cate_id'] ?? '';
		$price = $_POST['price'] ?? '';
		$short_desc = $_POST['short_desc'] ?? '';
		$detail = $_POST['detail'] ?? '';
		
		$product = Product::find($id);
		$product->name = $name;
		if ($image) {
			$product->image = $image;
		}
		$product->cate_id = $cate_id;
		$product->price = $price;
		$product->short_desc = $short_desc;
		$product->detail = $detail;
		$product->save();
		header('location: '.BASE_URL.'admin/product/edit/'.$id);
		return false;
	}
	
}
 ?>