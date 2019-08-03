<?php 
include_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<caption>List of Books</caption>
	<a href="index.php">Add Book</a>
<table width="80%" border="1">
	<th>
		<td>S.No</td>
		<td>Book Name</td>
		<td>Author Name</td>
		<td>Action</td>
	</th>
	<?php 
	$get_data = $conn->prepare("SELECT * FROM books order by id desc"); 
	$get_data->execute();
	$get_count = $get_data->rowCount();
	if($get_count>0){
		$j = 1;
		for($i=0;$result = $get_data->fetch(PDO::FETCH_OBJ);$i++){
			?>
			<tr>
				<td><?php echo $j++; ?></td>
				<td><?php echo $result->book_name;?></td>
				<td><?php echo $result->author_name;?></td>
				<td><a href="edit.php?id=<?php echo $result->id; ?>">Edit</a> <a href="delete.php?id=<?php echo $result->id; ?>">Delete</a> </td>
			</tr>
			<?php
		}
	}
	?>
	

</table>
</body>
</html>




