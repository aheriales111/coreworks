<?php
include('SimpleXLSX.php');
?>

<!DOCTYPE html>
<html>
<title>:::::: Xlsx to PHP Project ::::::::::</title>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script src="gen_js/jquery.js"></script>
 <script src="gen_js/bootstrap.min.js"></script>
 <script src="gen_js/sweetalert-dev.js"></script>
 <script src="gen_js/abrajsonlib.js"></script>
<body>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
			<div class="col-lg-12">
                <h1 class="page-header">Upload form</h1>
				<div id="formholder">
					<form action="#" method="post"  id="fileToUpload" enctype="multipart/form-data">
						Select file to upload:
						<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Upload" name="submit">
					</form>
				</div>
			</div>
		</div>
	
	    <div id="displaycontents">
			 <div class="row">
				<div class="col-lg-12">
					<div id="salesdbgrid">
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example1" border="1" cellspacing="2" cellpadding="5">
							<?php
								 if(isset($_POST["submit"])) {
								     $key3 = 0;
									 $key4 = 0;
									 $key5 = 0;
									 $key6 = 0;
									 $key7 = 0;
									  $target_dir = "uploads/";
									  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
									   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
											echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
										}
										
										 $xslx = new SimpleXLSX($target_file);
											if ($xslx->success()){
											   $mydata = $xslx->rows();
											    echo "<thead id='theadsales'>";
													echo "<tr>";
													    foreach($mydata[0] as $key=>$value)
														{
														   if(is_null($value) || $value == ''){
														     // do nothing
														   }
														   else{
														    echo "<td style='background-color:#006688; color:#fff''>" . $value . "</td>";
														   }
														}
													echo "</tr>";
												echo "</thead>";
											    echo "<tbody id='tbodysales'>";
												 for($i = 1; $i<= sizeof($mydata) - 1; $i++){
													 echo "<tr>";
													 if(is_null($mydata[$i][0]) || $mydata[$i][0] == ''){
													   //do nothing
													 }
													 else{
														foreach($mydata[$i] as $key=>$value)
														{
															 if(is_null($value) || $value == ''){
															   //do nothing
															}
															else{
																echo "<td>";
																echo  $value;
																echo "</td>";
															}
															switch($key){
															  case 3:
															    $key3 += $value;
															  break;
															  case 4:
															    $key4 += $value;
															  break;
															  case 5:
															    $key5 += $value;
															  break;
															case 6:
															    $key6 += $value;
															  break;
															  case 7:
															    $key7 += $value;
															  break;
															}
														}													
													}
													 echo "</tr>";
												}
													 echo "<tr>";
													 echo "<td>Total</td>";
													 echo "<td></td>";
													 echo "<td></td>";
													 echo "<td>" . number_format($key3) . "</td>";
													 echo "<td>" . number_format($key4) . "</td>";
													 echo "<td>" . number_format($key5) . "</td>";
													 echo "<td>" . number_format($key6) . "</td>";
													 echo "<td>" . number_format($key7) . "</td>";
													 echo "</tr>";
												echo "</tbody>";
											}
											else{
												echo 'xlsx error: '.$xslx->error();
											}
								}
							?>
						 </table>
					</div>
				</div>
			</div><!--- end of salesdbgrid---->
			
			<div class="row">
				<div class="col-lg-12">
					<div id="googledonutchart">
					   <div id="donutchart" style="width: 900px; height: 500px;"></div>
					</div>
				</div>
			</div><!--- end of googledonutchart---->
		</div><!--- end of displaycontents---->
    </div>
</div>
</body>
<script type="text/javascript">

 /*=======================================================================================================================
|  for google donut
|=======================================================================================================================*/	
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
		 ['Sales', 'Total sales'],
		 ['HSBC', 11],
		 ['CMHK',8],
		 ['SmarTone',5],
		 ['Telekom Malaysia',3],
		 ['Eastern Telecoms',2]
		]);
        var options = {
          title: 'TOP 5 FOR 2017',
		  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

        chart.draw(data, options);
      }
	  

    </script>
</html>


