<?php
$username = $_POST['username'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$adhar = $_POST['adhar'];
$phone = $_POST['phone'];
if (!empty($username) || !empty($pass) || !empty($email) || !empty($adhar) || !empty($phone)) 
{
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "wthotel";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) 
    {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else 
    {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
      $stmt->close();
      $INSERT = "INSERT INTO register (username, password, email, adhar, phone) VALUES ('$username', '$pass', '$email', '$adhar', '$phone')";
      if(mysqli_query($conn, $INSERT))
      {
        echo "Records added successfully.";
      } 
     }
      else 
      {
        echo "Someone already register using this email";
      }
     
     $conn->close();
    }
}
?>
