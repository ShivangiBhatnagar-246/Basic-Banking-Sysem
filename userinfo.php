<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>USERS</title>
</head>
<body>
<?php
    include 'config.php';
    if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $balance=$_POST['balance'];
    $sql= "INSERT INTO  `spark_bank`.`users` ( `name`, `email`, `balance`) VALUES ('$name','$email', '$balance');";
    //echo $sql;
    $result=mysqli_query($conn,$sql);
    if($result){
               echo "<script> alert('Hurray! User created');
                               window.location='moneytransfer.php';
                     </script>";
                    
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">THE SPARKS BANK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      </ul>
      <span class="navbar-text">
        BY: SHIVANGI BHATNAGAR
      </span>
    </div>
  </div>
</nav>
<style>
    body{
        background-color:powderblue;
    }
    
</style>
<div class="container" >
    <h1>WELCOME USER!</h1>
    <p> ENTER THE BASIC DETAILS</p>
    <form action="userinfo.php"  method="post">
        ENTER NAME:<input type="text" class="form-control" name="name" id="name" placeholder="enter name"><br>
        ENTER EMAIL:<input type="email" class="form-control" name="email" id="email" placeholder="enter email"><br>
        ENTER BALANCE:<input type="number" class="form-control" name="balance" id="balance" placeholder="enter balance"><br>
        <div class="col-12">
  </div>
        <input type="submit" class="btn btn-primary" value="submit" name="submit"></input>
        <input type="reset" class="btn btn-primary" value="reset" name="reset"></input><br>
</form>
    </div>
</body>
</html>