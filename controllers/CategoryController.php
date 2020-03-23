<?php
namespace Controllers;

use Models\Category;

class CategoryController extends BaseController {
    public function list() {
		$categories = Category::all();
		return $this->render('admin.category.list', compact('categories'));
	}

	public function remove($id) {
		Category::destroy($id);
		header('location: '.BASE_URL.'admin/category/list');
		return false;
	}

	public function removeMultiple() {
		$ids = $_POST['ids'] ?? '';
		Category::destroy($ids);
		header('location: '.BASE_URL.'admin/category/list');
		return false;
	}

	public function add() {
		return $this->render('admin.category.add');
	}

	public function saveAdd() {
		$cate_name = $_POST['cate_name'] ?? '';
		$show_menu = $_POST['show_menu'] ?? '';
		$slug = $_POST['slug'] ?? '';

		$category = new Category();
		$category->cate_name = $cate_name;
		$category->show_menu = $show_menu;
		$category->slug = $slug;
		
		$category->save();
		header('location: '.BASE_URL.'admin/category/add');
		return false;
	}

	public function edit($id) {
		$category = Category::find($id);
		return $this->render('admin.category.edit', compact('category'));
	}

	public function saveEdit() {
		$id = $_POST['id'] ?? '';
		$cate_name = $_POST['cate_name'] ?? '';
		$show_menu = $_POST['show_menu'] ?? '';
		$slug = $_POST['slug'] ?? '';

		$category = Category::find($id);
		$category->cate_name = $cate_name;
		$category->show_menu = $show_menu;
		$category->slug = $slug;

		$category->save();
		header('location: '.BASE_URL.'admin/category/edit/'.$id);
		return false;
	}
	
}
?>