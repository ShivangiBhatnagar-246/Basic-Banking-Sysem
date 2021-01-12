<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<title>TRANSACTION HISTORY</title>
</head>
<body>
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
<style>
    body{
        background-color:powderblue;
    }
    </style>
<table class="table table-hover table-striped table-condensed table-bordered">
        <thead style="color : black;">
            <tr>
                <th style="text-align:center" class="text-center" style="text-align:centre;">S.No.</th>
                <th style="text-align:center" class="text-center">Sender</th>
                <th style="text-align:center" class="text-center">Receiver</th>
                <th style="text-align:center" class="text-center">Amount Transferred</th>
            </tr>
        </thead>
        <tbody>
        <?php

            include 'config.php';

            $sql ="select * from transactions";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr style="color : black;">
            <td style="text-align:center" class="py-2"><?php echo $rows['sno']; ?></td>
            <td style="text-align:center" class="py-2"><?php echo $rows['sender']; ?></td>
            <td style="text-align:center" class="py-2"><?php echo $rows['receiver']; ?></td>
            <td style="text-align:center" class="py-2"><?php echo $rows['balance']; ?> </td>               
        <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</div>    
</body>
</html>