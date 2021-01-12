<?php
include 'config.php';
if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to= $_POST['to'];
    $amount = $_POST['amount'];
    $sql = "SELECT * from `spark_bank`.`users` where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from `spark_bank`.`users` where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE `spark_bank`.`users` set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
                if (($amount)<0)
                {
                     echo '<script type="text/javascript">';
                     echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
                     echo '</script>';
                 }
             
             
               
                 // constraint to check insufficient balance.
                 else if($amount > $sql1['balance']) 
                 {
                     
                     echo '<script type="text/javascript">';
                     echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
                     echo '</script>';
                 }
             
                 // constraint to check zero values
                 else if($amount == 0){
             
                      echo "<script type='text/javascript'>";
                      echo "alert('Oops! Zero value cannot be transferred')";
                      echo "</script>";
                  }
             
             
                 else {             

                // adding amount to reciever's account
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE `spark_bank`.`users` set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO `spark_bank`.`transactions` (`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transactionhistory.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>MONEY</title>
</head>
<style>
    body{
        background-color:powderblue;
    }
</style>

<body>
<?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  `spark_bank`.`users` where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">THE SPARKS BANK</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="moneytransfer.php">Transfer Money</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="transactionhistory.php">Transfer History</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="userinfo.php">User</a>
        </li>
      </ul>
      <span class="navbar-text">
        BY: SHIVANGI BHATNAGAR
      </span>
    </div>
  </div>
</nav>

<form method="post" name="tcredit" class="tablet" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="color : black;">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr style="color : black;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : black;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM `spark_bank`.`users` where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button style="background-color : #ff6666; " class="btn mt-3" name="submit" type="submit" id="myBtn" >Transfer</button>
            </div>
        </form>
    </div>            
</body>
</html>
