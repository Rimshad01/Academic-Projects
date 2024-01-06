<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname="HMS";
    $name=$_POST["uname"];
    $pass=$_POST["pass"];
    
    
   // Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo "<br>";
$sql = "INSERT INTO admin (name,password)
VALUES ('$name','$pass')";

if ($conn->query($sql) === TRUE) {
    echo "New Admin created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>