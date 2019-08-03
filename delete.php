<?php 
include_once('config.php');
if(isset($_GET['id'])){
	$book_id = $_GET['id'];
	$delete_data = $conn->prepare("DELETE FROM books where id = :id");
	$delete_data->bindParam(':id', $book_id);
	$delete_data->execute();
	$get_count = $delete_data->rowCount();
	if($get_count>0){
		echo "Data Deleted successfully";
		header("Location: list.php");
	}else{
		echo "Failed to delte";
		header("Location: list.php");
	}
}
?>
