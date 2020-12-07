<?php

$name = $_POST['name'];
$contact_no = $_POST['contact_no'];
$whatsapp_no = $_POST['whatsapp_no'];
$email = $_POST['email'];
$Reference_name = $_POST['Reference_name'];
$qualification = $_POST['qualification'];
$Internship_type = $_POST['Internship_type'];
$resume = $_FILES['resume'];

$filename = $resume['name'];
$filepath = $resume['tmp_name'];
$fileerror = $resume['error'];

if($fileerror == 0){
    $destfile = 'upload/'.$filename;
    move_uploaded_file($filepath, $destfile);
}
$conn = new mysqli('localhost','root','root','Form');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into Form(name, contact_no, whatsapp_no, email, Reference_name, qualification, Internship_type, resume)
    values(?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisssss", $name, $contact_no, $whatsapp_no, $email, $Reference_name, $qualification, $Internship_type, $destfile);
    $stmt->execute();
    echo"Submitted Successfully......!!!";
    $stmt->close();
    $conn->close();
}
?>