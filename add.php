<?php

include('config/db_connect.php');
$email=$title=$ingredients='';
$errors=array('email'=>'','title'=>'','ingredients'=>'');

if(isset($_POST['submit'])) {
    //check mail
    if(empty($_POST["email"])){
        $errors['email']= 'Email is required <br>';
    } else {
       $email=$_POST["email"];
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors['email']= 'mail must be valid mail address';
       }
    }

    //check title
    if(empty($_POST["title"])){
        $errors['title']= 'Title is required <br>';
    } else {
        $title=$_POST["title"];
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)) {
            $errors['title']= 'title must be letters and spaces only';
        }
    }
    if(empty($_POST["ingredients"])){
        $errors['ingredients']= 'Ingredients is required <br>';
    } else {
        $ingredients=$_POST["ingredients"];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)) {
            $errors['ingredients']= 'ingredients must be letters and spaces only';
        }
    }
    if(array_filter($errors)) {
        //form is not valid
    }else {
        //form is valid
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);


        //create sql
        $sql="INSERT INTO pizzas(title,ingredients,email) VALUES('$title','$ingredients','$email')";

        //save db check
        if(mysqli_query($conn,$sql)) {
            //success
            header('Location: index.php');

        } else {
            //fail
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    
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
    <?php include "template/header.php"?>

    <section class="container grey-text">
    <h4 class="center">Add a pizza</h4>
    <form action="" class="white" method="POST">
    <label>Your Email:</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
    <div class="red-text"><?php echo $errors['email']; ?></div>
    <label>Pizza Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
    <div class="red-text"><?php echo $errors['title']; ?></div>

    <label>Ingredients(comma seprated):</label>
    <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
    <div class="red-text"><?php echo $errors['ingredients']; ?></div>

    <div class="center">
    <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></div>
    </form>
    </section>

    <?php include "template/footer.php"?>

</body>
</html>