<?php 
if($lists){ 
	if(($this->common->get_particular('mst_product_settings',array('product_settings_name' => 'product_brand'),'product_settings_value')== 1)){
		foreach ($lists as $key => $list) {
			echo '<tr>
			<td>'.next_number($key).'</td>
			<td>'.$list['product_name'].'</td>
			<td>'.$list['product_description'].'</td>
			<td>'.$list['brand_name'].'</td>
			<td>'.$list['quantity'].'</td>
			<td><a href="#" class="btn btn-danger temp_purchase_dc_remove" data-id="'.$list['purchase_dc_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}else{
		foreach ($lists as $key => $list) {
			echo '<tr>
			<td>'.next_number($key).'</td>
			<td>'.$list['product_name'].'</td>
			<td>'.$list['product_description'].'</td>
			<td>'.$list['quantity'].'</td>
			<td><a href="#" class="btn btn-danger temp_purchase_dc_remove" data-id="'.$list['purchase_dc_relation_temp_id'].'"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}
}else{ 
	echo '<tr>
	<td colspan="8">No Products Found</td>
	</tr>';
}
?>