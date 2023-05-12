<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
//echo $startDate;exit;
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);

	//$start_date = $date->format("m/d/Y");

//echo $date;exit;

	$endDate = $_POST['endDate'];
	//$format = DateTime::createFromFormat('m/d/Y',$endDate);
	//$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders WHERE order_date >= '$startDate' AND order_date <= '$endDate' and order_status = 1";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:80%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['grand_total'].'</center></td>
			</tr>';	
			$totalAmount += $result['grand_total'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	
	$print .=
	'<div class="text-center">
        <button onclick="window.print();" style class="btn btn-primary btn-flat m-b-30 m-t-30" id="print-btn">Print</button>
      </div>';
	echo $table;
	echo $print;

	
}
      

?>
<style type="text/css">
    .btn {

        background-color:blueviolet;
		display: flex;
		justify-content: center;
		margin: 10px 0px 0px 50px;
		padding: 5 5 5 5px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>