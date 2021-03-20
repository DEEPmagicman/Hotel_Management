<?php
$pass = $_POST['pass'];
$email = $_POST['email'];
if (!empty($pass) || !empty($email)) 
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
     $Find = "SELECT password FROM `register` WHERE `email` LIKE '$email'";
     $stmt = $conn->prepare($Find);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==1) 
     {
        $result = mysqli_query($conn, "SELECT password FROM `register` WHERE `email` LIKE '$email'");
        $row = $result->fetch_assoc();
        #echo $row['password'];
        if($row['password'] == $pass)
        {
            #echo "Login Successful";
            header("Location: Welcome.html");
        }
        else
        {
            echo "Login fail";
        }   
     }
      else 
      {
        echo "User not found!";
      }
     $conn->close();
    }
}
?>
