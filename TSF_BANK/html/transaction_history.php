<?php include "./config.php" ?>
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

<nav class="navbar navbar-expand-lg navbar-dark navbar-floating">
  <div class="container">
    <div class="name">
      <a class="navbar-brand" href="#">
      <img src="../assets/favicon.png" alt="" width="60">
      </a> TSF BANK
    </div>
    
    <div class="collapse navbar-collapse" id="navbarToggler">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_customers.php">View Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="transaction_history.php">Transaction History</a>
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
          <h3 class="mb-3 fw-medium">Transaction History</h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark justify-content-center bg-transparent">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Customers</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<div>
  <table align = "center">
    <tr>
        <th>Sr. No.</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Amount</th>
        <th>Time</th>                
    </tr>
    
<?php
  $sql = "SELECT * FROM transaction_history ORDER BY sno DESC";
  $rs = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($rs)) {
?>

    <tr>
        <td class="py-2"><?php echo $row['sno'] ?></td>
        <td class="py-2"><?php echo $row['sender']?></td>
        <td class="py-2"><?php echo $row['receiver']?></td>
        <td class="py-2"><?php echo $row['amount']?></td>
        <td class="py-2"><?php echo $row['datetime']; ?> </td> 
    </tr>
               
<?php
  }
  mysqli_close($con);
?>
</div>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/tsf.js"></script>

</body>
</html>