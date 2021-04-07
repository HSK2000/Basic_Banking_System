<?php
    define("HOSTNAME", "localhost:3307");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "tsf_bank_db2021");

    $con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME) or die ("cannot connect to database.");
    
?>