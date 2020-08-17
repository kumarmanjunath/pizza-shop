<?php 

include('config/db_connect.php');

if(isset($_POST['delete'])) {

    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
   
    $sql="DELETE  FROM pizzas  WHERE id=$id_to_delete";

    if(mysqli_query($conn,$sql)) {
       //success 
       header('Location:index.php');
    } {
        //failure
        echo 'query error : ' . mysqli_error($conn);
    }
}

//check get request id parama (checking id exist or not)
if(isset($_GET['id'])) {
    $id=mysqli_real_escape_string($conn,$_GET['id']);

    //make sql
    $sql="SELECT * FROM pizzas WHERE id=$id";

    //get the query result
    $result=mysqli_query($conn,$sql);
    

    //fetch result in array format
    $pizza=mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);

    // print_r($pizza);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include ("template/header.php");?>

<div class="container center black-text">
<?php if($pizza):?>

<h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
<p>Created By:<?php echo htmlspecialchars($pizza['email']); ?></p>
<p><?php echo  date($pizza['created_at']);?></p>
<h5>Ingredients</h5>
<p><?php echo htmlspecialchars($pizza['ingredients']);?></p>
<!-- Delete form -->
<form action="detail.php" method="POST">
<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>">
<input type="submit" name="delete" value="delete" class="btn red z-depth-0">
</form>
<?php else:?>
<h4>No such pizza exists</h4>
<?php endif;?>

</div>
<?php include ("template/footer.php")?>


</body>
</html>