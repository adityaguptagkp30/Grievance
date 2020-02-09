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
</select><br/><br/>

Name: <input type="text" name="yname"><br/><br/>
Mobile:<input type="text" name="mobile"><br/><br/>
Email:<input type="email" name="email"><br/><br/>
Address:<input type="text" name="address"><br/><br/>
Complaint:<input type="text" name="complaint"><br/><br/>

        Select image to upload:
        <input type="file" name="image"/>
        </br>
        <input type="submit" name="submit" value="SUBMIT"/>
    </form>
</body>
</html>
<?php
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
        }else{
            echo "File upload failed, please try again.";
        } 
    }else{
        echo "Please select an image file to upload.";
    }
}
?>