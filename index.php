<?php 
include_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
if(isset($_POST['crud_submit'])){
	$book_name = $_POST['book_name'];
	$author_name = $_POST['author_name'];
	$current_date = date('Y-m-d H:i:s');
	if(empty($book_name)){
		echo "Book name field is empty";
	}else if(empty($author_name)){
		echo "Author name field is empty";
	}else{
		//sql query goes here
		$insert_data = $conn->prepare("INSERT INTO books (book_name, author_name, created_at) values(:book_name, :author_name, :created_at)");
		$insert_data->bindParam(':book_name', $book_name);
		$insert_data->bindParam(':author_name', $author_name);
		$insert_data->bindParam(':created_at', $current_date);
		$insert_data->execute();
		$last_inserted_data = $conn->lastInsertId();
		if($last_inserted_data>0){
			echo "Data has added";
			header("Location: list.php");
		}else{
			echo "Failed to added";
			header("Location: list.php");
		}
	}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="crud_form">
<table>
	<tr>
		<td><label>Book Name</label></td>
		<td><input type="text" name="book_name" value=""></td>
	</tr>
	<tr>
		<td><label>Author Name</label></td>
		<td><input type="text" name="author_name" value=""></td>
	</tr>
	<tr>
		
		<td colspan="2"><input type="submit" name="crud_submit" value="Submit"></td>
	</tr>

</table>
</form>
</body>
</html>