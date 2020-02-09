<!DOCTYPE html>
<html lang="en">

<body>
    <form action="test.php" method="post" enctype="multipart/form-data">

        complainant:<select name="complainant">
            <option value="none">none</option>
            <option value="faculty">faculty</option>
            <option value="staff">staff</option>
            <option value="student">student</option>
            <option value="employer">employer</option>
            <option value="alumini">alumni</option>
            <option value="parents">parents</option>
        </select><br /><br />

        Name: <input type="text" name="yname"><br /><br />
        Mobile:<input type="text" name="mobile"><br /><br />
        Email:<input type="email" name="email"><br /><br />
        Address:<input type="text" name="address"><br /><br />
        Complaint:<input type="text" name="complaint"><br /><br />

        Select image to upload:
        <input type="file" name="image" />
        </br>
        <input type="submit" name="submit" value="SUBMIT" />
    </form>
</body>

</html>
<?php
$email;
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    $complainant=$_POST['complainant'];
    $name=$_POST['yname'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $complaint=$_POST['complaint'];
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        /*
         * Insert image data into database
         */
        //DB details
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'form';
        //Create connection and select DB
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        // Check connection
        if($db->connect_error){
            die("Connection failed: " . $db->connect_error);
        }
        $dataTime = date("Y-m-d H:i:s");
        //Insert image content into database
        $insert = $db->query("INSERT into images (image, created,complainant,name,mobile,email,address,complaint) VALUES ('$imgContent', '$dataTime','$complainant','$name','$mobile','$email','$address','$complaint')");
        if($insert){
            echo "File uploaded successfully.";
        } else {
            echo "File upload failed, please try again.";
        }   
     }else echo "Please select an image file to upload.";
}
                             
require './phpm/helo.php';
// $email1='adityaguptagkp08@gmail.com';
$mail = new PHPMailer;
//$mail->SMTPDebug = 4;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'adityaguptagkp30@gmail.com';                 // SMTP username
$mail->Password = '****';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->setFrom('adityaguptagkp30@gmail.com', 'AKGEC GRIEVANCE');
$mail->addAddress($email);     // Add a recipient              // Name is optional
$mail->addAddress('indiaetoos1@gmail.com');  
$mail->addAddress('indiaetoos1@gmail.com');  
//$mail->addReplyTo(EMAIL);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'AKGEC GRIEVANCE GUIDE WELCOMES';

$mail->Body    = 'Your response has been submitted sucessfully.';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent please verify your email:';
    echo $email;
}


                    $correct_response = 'Registration successfull...';
                    // header("refresh:3;url=tlogin.php");

                    // to take to login page within 2 sec
                 //                
              
                // else
                // {
                //     $response = 'Something went wrong';
                // }
            
                
    
?>