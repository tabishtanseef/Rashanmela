<?php
$to = 'tabishtanseef@gmail.com'; // replace this mail with yours
$firstname = $_POST["name"];
$message = $_POST["message"];
$email= $_POST["email"];
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= "From: " . $email . "\r\n"; // Sender's E-mail
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
$message ='<table style="width:100%">
    <tbody><tr>
        <td>Name: '.$firstname.'</td>
    </tr>
    <tr><td>Email: '.$email.'</td></tr> 
    
    <tr><td>Message: '.$message.'</td></tr>
</tbody></table>';
 
if (@mail($to, $email, $message, $headers))
{
    echo "<script>alert('The message has been sent.');</script>";
    header("Location: index.php");
}else{
    echo 'failed';
}
?>