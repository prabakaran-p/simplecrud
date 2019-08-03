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
	$book_id = $_GET['book_id'];
	$book_name = $_POST['book_name'];
	$author_name = $_POST['author_name'];
	$current_date = date('Y-m-d H:i:s');
	if(empty($book_name)){
		echo "Book name field is empty";
	}else if(empty($author_name)){
		echo "Author name field is empty";
	}else{
		//sql query goes here
		$update_data = $conn->prepare("UPDATE books set book_name = :book_name, author_name = :author_name, updated_at = :updated_at where id = :id");
		$update_data->bindParam(':book_name', $book_name);
		$update_data->bindParam(':author_name', $author_name);
		$update_data->bindParam(':updated_at', $current_date);
		$update_data->bindParam(':id', $book_id);
		$update_data->execute();
		if($update_data->rowCount()>0){
			echo "Data updated successfully";
		}else{
			echo "Something went wrong";
		}
	}
}
?>
<?php 
$db_book_name = "";
$db_author_name = "";
if(isset($_GET['id'])){


$id = $_GET['id'];
$get_data = $conn->prepare("SELECT * FROM books where id = :id limit 1");
$get_data->bindParam(':id', $id);
$get_data->execute();
$get_count = $get_data->rowCount();

if($get_count>0){
	$get_result = $get_data->fetch(PDO::FETCH_ASSOC);
	$db_book_name = $get_result['book_name'];
	$db_author_name = $get_result['author_name'];
}
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?book_id=<?php echo $id; ?>" method="post" name="crud_form">
<table>
	<tr>
		<td><label>Book Name</label></td>
		<td><input type="text" name="book_name" value="<?php echo $db_book_name; ?>"></td>
	</tr>
	<tr>
		<td><label>Author Name</label></td>
		<td><input type="text" name="author_name" value="<?php echo $db_author_name; ?>"></td>
	</tr>
	<tr>
		
		<td colspan="2"><input type="submit" name="crud_submit" value="Submit"></td>
	</tr>

</table>
</form>
</body>
</html>