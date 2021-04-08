<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user_details where id=$from";
    $query = mysqli_query($con,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user_details where id=$to";
    $query = mysqli_query($con,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
    {
      echo '<script>alert("Negative amount cannot be transferred.")</script>';
    }

    else if($amount > $sql1['balance']) 
    {
      echo '<script>alert("Transaction cannot take place. Insufficient Balance")</script>';      
    }
    
    else if($amount == 0)
    {
      echo '<script>alert("Zero amount cannot be transferred")</script>';
    }

    else 
    {
      $newbalance = $sql1['balance'] - $amount;
      $sql = "UPDATE user_details set balance=$newbalance where id=$from";
      mysqli_query($con,$sql);
             
      $newbalance = $sql2['balance'] + $amount;
      $sql = "UPDATE user_details set balance=$newbalance where id=$to";
      mysqli_query($con,$sql);
                                           
      $sender = $sql1['name'];
      $receiver = $sql2['name'];
      $date = date('Y/m/d h:i:s');
      $sql = "INSERT INTO transaction_history(sender, receiver, amount, datetime) VALUE ('$sender','$receiver','$amount','$date')";
      $query=mysqli_query($con,$sql);

      if($query) {
                    echo "<script> alert('Transaction Successful');
                                     window.location='transaction_history.php';
                           </script>";
      }

      $newbalance= 0;
      $amount =0;
    }
    
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>TSF Bank</title>

  <link rel="shortcut icon" href="../assets/favicon.png" type="image/x-icon">

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.min.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/css/style.css"> 

  <style>

    th, td {
     border: 2px solid black;
    }

  </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-floating" style = "background : #ffff4d;">
  <div class="container">
    <div class="name">
      <a class="navbar-brand" href="#"><img src="../assets/favicon.png" alt="" width="60"></a> 
      TSF BANK
    </div>
        
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-lg-5 mt-3 mt-lg-0">
        
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="view_customers.php">View Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transaction_history.php">Transaction History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact</a>
        </li>
      </ul>      
    </div>

  </div>
</nav>


<div class="bg-light">

<div class="page-hero-section bg-image hero-mini" style="background-image: url(../assets/img/hero_mini.svg);">
  <div class="hero-caption">
    <div class="container fg-white h-100">
      <div class="row justify-content-center align-items-center text-center h-100">
        <div class="col-lg-6">
          <h3 class="mb-3 fw-medium">Customer Details</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="view_customers.php">View Customers</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div>
  <h2 class="text-center pt-4">Customer Details</h2>
  <?php
    $sid=$_GET['id'];
    $sql = "SELECT * FROM  user_details where id=$sid";
    $result=mysqli_query($con,$sql);
    if(!$result)
    {
      echo "Error : ".$sql."<br>".mysqli_error($con);
    }
    $rows=mysqli_fetch_assoc($result);
  ?>
  <form method="post" name="tcredit"><br>
    <div>
      <table align="center">
        <tr>
          <th class="text-center">Id</th>
          <th class="text-center">Name</th>
          <th class="text-center">Email</th>
          <th class="text-center">Balance</th>
          </tr>
        <tr>
          <td class="py-2"><?php echo $rows['id'] ?></td>
          <td class="py-2"><?php echo $rows['name'] ?></td>
          <td class="py-2"><?php echo $rows['email'] ?></td>
          <td class="py-2"><?php echo $rows['balance'] ?></td>
        </tr>
      </table>
    </div>
    <br><br>
    <div style="width: 50%;margin: auto;">
      <label><b>Transfer To</b></label>
      <select name="to" class="form-control" required>
          <option value="" disabled selected>Choose</option>
          <?php
              include 'config.php';
              $sid=$_GET['id'];
              $sql = "SELECT * FROM user_details where id!=$sid";
              $result=mysqli_query($con,$sql);
              if(!$result)
              {
                  echo "Error ".$sql."<br>".mysqli_error($con);
              }
              while($rows = mysqli_fetch_assoc($result)) {
          ?>
              <option class="table" value="<?php echo $rows['id'];?>" >                
                  <?php echo $rows['name'] ;?>                 
              </option>
          <?php 
              } 
          ?>
      </select>
      <br><br>
      <label><b>Enter Amount</b></label>
      <input type="number" class="form-control" name="amount" required>   
      <br><br>
      <div class="text-center" >
      <button  name="submit" type="submit" id="myBtn">Transfer</button>
      </div>
      </div>
      </form>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/tsf.js"></script>

</body>
</html>