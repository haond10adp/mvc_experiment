<?php 
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
	public $tableName = "categories";
	public function countProducts() {
		$count = Product::where('cate_id', $this->id)->count();
		return $count;
	}
}

 ?>