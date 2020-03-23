<?php 
namespace Controllers;

use Models\Category;
use Models\Product;
use Models\User;

class HomeController extends BaseController
{
	public function index() {
		//Lấy toàn bộ dữ liệu của bảng Products để hiển thị
		$products = Product::orderBy('id', 'desc')->take(10)->get();
		$categories = Category::where('show_menu', 1)->get();
		return $this->render('site.index', compact('products', 'categories'));
	}
	public function admin() {
		$totalProduct = Product::all()->count();
		$totalCategory = Category::all()->count();
		$totalUser = User::all()->count();
		return $this->render('admin.index', compact('totalProduct', 'totalCategory', 'totalUser'));
	}
	public function productDetail($id) {
		$product = Product::find($id);
		$product->views++;
		$product->save();
		$categories = Category::where('show_menu', 1)->get();
		return $this->render('site.product-detail', compact('categories', 'product'));
	}
	public function categoriedProducts($slug) {
		$category_id = Category::where('slug', $slug)->first()->id;
		$category_name = Category::where('slug', $slug)->first()->cate_name;
		$products = Product::where('cate_id', $category_id)->get();
		$categories = Category::where('show_menu', 1)->get();
		return $this->render('site.index', compact('products', 'categories', 'category_name'));

	}
}
