<html>
<head>
<link href="bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<center>
<?php  
	//for connecting to database.
$conn = mysqli_connect('localhost', 'root', '', 'test')
	or die ('Error connecting to mysql');  

$limit = 2;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
	$start_from = ($page-1) * $limit;  
	  
	  //for fetching the data from database.
	$sql = "SELECT * FROM posts ORDER BY title ASC LIMIT ".$start_from.",".$limit;  
	$rs_result = mysqli_query ($conn,$sql); //executing the query 
	$result = array();//creating an array to store result
	$result = mysqli_fetch_all($rs_result,MYSQLI_ASSOC);//storing the results in associative array.
	?>  
	<section>
	<div>
		<table class="table table-bordered table-striped" width="350">  
			<thead>  
			<tr>  
			<th>title</th>  
			<th>body</th>  
			</tr>  
			<thead>  
			<tbody>  
			<?php  
			//displaying the content of database.
				foreach($result as $row) { 				
				?>  
							<tr>  
							<td><?php echo($row['title']); ?></td>  
							<td><?php echo ($row['body']); ?></td>  
							</tr>  
			<?php 
				};  
			?>
			</tbody>  
		</table>
	</div> 
</section>
<?php  
$sql = "SELECT COUNT(id) FROM posts";  
$count_result = mysqli_query($conn,$sql);
$row = mysqli_fetch_row($count_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<div class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
             $pagLink .= '<li><a href="pagination.php?page='.$i.'">'.$i.'</a></li>';  
};  
echo $pagLink . "</div>";  
?>
</center>
</body>
</html>