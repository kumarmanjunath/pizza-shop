<?php 

include ('config/db_connect.php');

//write query for all pizzas
$sql='SELECT title,email,ingredients,id FROM pizzas ORDER BY created_at';

//make query and get result
$result=mysqli_query($conn,$sql);

//fetch the resulting rows as an array
$pizzas=mysqli_fetch_all($result,MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close the connection
mysqli_close($conn)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "template/header.php"?>

<h4 class="center green-text">Pizzas</h4>
<div class="container">
<div class="row">
<?php foreach($pizzas as $pizza):  ?>
<div class="col s6 md3">
<div class="card z-depth-0">
<img src="img/pizza.svg" alt="" class="pizza">
<div class="card-content center">
<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
<ul>
<?php foreach(explode(',',$pizza['ingredients']) as $ing):  ?>
<li><?php echo htmlspecialchars($ing);?></li>
<?php endforeach; ?>
</ul>
</div>
<div class="card-action right-align">
<a class="green-text" href="detail.php?id=<?php echo $pizza['id'] ?>" >More info</a>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
    <?php include "template/footer.php"?>

</body>
</html>