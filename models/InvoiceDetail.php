<?php 
namespace Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
	protected $tableName = 'invoice_details';
	public function product() {
		return $this->belongsTo('Models\Product');
	}
}
 ?>