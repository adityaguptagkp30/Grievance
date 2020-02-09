<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="bg-success p-4">
    <div class="container w-50 p-3 bg-white d-flex align-items-center" style="border: 2px solid white; border-radius: 50px 20px;">
    <h1>AKGEC GRIEVANCE</h1>
        <form class="form-group" action="test.php" method="post" enctype="multipart/form-data">
        <label for="complainant">Complainant: </label>
            <select class="form-control col-12" name="complainant" required>
                <option value="none" disabled selected>none</option>
                <option value="faculty">faculty</option>
                <option value="staff">staff</option>
                <option value="student">student</option>
                <option value="employer">employer</option>
                <option value="alumini">alumni</option>
                <option value="parents">parents</option>
            </select>
            <label for="yname">Name: </label>
            <input class="form-control col-12" type="text" name="yname" autocomplete="off" required>
            <label for="mobile">Mobile: </label>
            <input class="form-control col-12" type="number" name="mobile" autocomplete="off" required>
            <label for="email">Email: </label>
            <input class="form-control col-12" type="email" name="email" autocomplete="off" required>
            <label for="address">Address: </label>
            <input class="form-control col-12" type="text" name="address" autocomplete="off" required>
            <label for="complaint">Complaint: </label>
            <input class="form-control col-12" type="text" name="complaint" autocomplete="off" required>
            <label for="image">Select image to upload: </label>
            <input class="form-control col-12 mb-2" type="file" name="image" required/>
            <input class="btn btn-primary" type="submit" name="submit" value="SUBMIT" />
        </form>
    </div>
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
            echo "<script> alert('File uploaded successfully.');</script>";
        } else {
            echo "<script> alert('File upload failed, please try again.');</script>";
        }   
     }else echo "Please select an image file to upload.";
                            
     require './phpm/helo.php';
     // $email1='adityaguptagkp08@gmail.com';
     $mail = new PHPMailer;
     //$mail->SMTPDebug = 4;                               // Enable verbose debug output
     $mail->isSMTP();                                      // Set mailer to use SMTP
     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
     $mail->SMTPAuth = true;                               // Enable SMTP authentication
     $mail->Username = 'adityaguptagkp30@gmail.com';                 // SMTP username
     $mail->Password = 'Tt2338627*';                           // SMTP password
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
         echo "<script> alert('Message could not be sent.');</script>";
         echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
         echo 'Message has been sent to your email:';
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
}
?>