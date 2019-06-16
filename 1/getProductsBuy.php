<?php
require_once "HDatabaseConnection.php";

$mysql = new HDatabaseConnection("127.0.0.1","root","123123","db_h_cashier");

$result = $mysql->query("select * from tbl_products_buy union all select * from tbl_products_buy_archive");
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$arr[] = $row;
	}
	print(json_encode($arr));
}