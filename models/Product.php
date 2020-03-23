<?php 
namespace Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
	protected $table = "products";
	public function cate() {
		return $this->belongsTo('Models\Category');
	}
}

 ?>