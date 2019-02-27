<?php
set_time_limit(300);

include ("layout/header.php");
$api = $_SESSION['api'];
$data = array();

$message = NULL;
if (isset($_GET['action']) && isset($_GET['id'])){
	/* Convert Lead to Account */
	$id = $_GET['id'];
	$lead = $api->_ObjectById('lead', $id);
	$dta = $lead->data->$id;

	if ($dta->isConverted==='true' || $dta->isConverted===true || $dta->isConverted===1){
		$message = "Lead already was converted!";
	}else{
		// update Lead to convert lead to account
		$dt = array("isConverted" 	=> "true");
		$res = $api->_Insert('lead', array(array("id" => $id, "data" => $dt)));
		$message = 'Lead was successfully converted!';
	}
}
$res = $api->_AllObjects('lead');
$data = $res->data;

?>
	<div class="content-wrapper">
		<input type="hidden" id="message" value="<?php echo $message; ?>">
		<div class="col-lg-12 grid-margin stretch-card mt-5">
			<div class="table-responsive">
			    <table class="table table-hover">
			      	<thead>
				        <tr>
				        	<th>Lead Name</th>
				          	<th>Last Name</th>
				          	<th>First Name</th>
				          	<th>Lead Status</th>
				          	<th>Email</th>
				          	<th>Converted</th>
				          	<th>Action</th>
				        </tr>
			      	</thead>
			      	<tbody>
			      		<?php 
			      			foreach ($data as $key => $value) {			      				
			      				echo "<tr>";
			      				echo "<td>". $value->Name ."</td>";			      				
			      				echo "<td>". $value->Last_Name ."</td>";
			      				echo "<td>". $value->First_Name ."</td>";
			      				echo "<td>". $value->Lead_Status ."</td>";
			      				echo "<td>". $value->Email ."</td>";
			      				echo "<td>". $value->isConverted ."</td>";
			      				if ($value->isConverted == 'false') 
			      					echo "<td><a class ='convert btn btn-info btn-rounded btn-fw btn-sm' href='leads.php?action=convert&id=" . $key . "'>Convert</a></td>";
			      				else echo "<td></td>";
			      				echo "</tr>";
			      			}
			      		?>
			      	</tbody>
			    </table>
			</div>
		</div>
	</div>

<?php include "layout/footer.php" ;?>