<?php

session_start();
//$diarycontent="";

if(array_key_exists("email",$_COOKIE))
{

	$_SESSION['email']=$_COOKIE['email'];
}
if(!(array_key_exists("email",$_SESSION)))
{
	//echo "<p>Logged In!<a href='first.php?logout=1'>Logout</a></p>";

	// include("connection.php");

	// $query="SELECT notes FROM `diary` WHERE email=".mysqli_real_escape_string($link,$_SESSION['email'])." LIMIT 1";
	//  $row = mysqli_fetch_array(mysqli_query($link,$query));
	// $diarycontent=$row['notes'];
// }
// else
// {
	header("Location:index.php");
}

include("header.php");
?>



<?php

if(isset($_POST['submit'])){

	$file=$_FILES['file'];
	$fileName=$_FILES['file']['name'];
	$fileTmpName=$_FILES['file']['tmp_name'];
	$fileSize=$_FILES['file']['size'];
	$fileError=$_FILES['file']['error'];
	$fileType=$_FILES['file']['type'];

	$fileExt=explode('.',$fileName);
	$fileActualExt=strtolower(end($fileExt));

	$allowed=array('jpg','jpeg','png','pdf','docx','txt','js','cpp','c','mp3','mp4','mkv','zip','sql','pptx','php','mpa','rar','z','csv','sql','xml','exe','py','gif','css','html','xls','xlr');
	if(in_array($fileActualExt,$allowed))
	{
		if($fileError === 0){
					if($fileSize<900000000)
					{
						// $fileNameNew=uniqid('',true).".".$fileActualExt;
						$fileDestination='uploads/'.basename($fileName);
						move_uploaded_file($fileTmpName, $fileDestination);
						include('connection.php');
						$query="INSERT INTO doc (name,mail,status) VALUES ('$fileName','".mysqli_real_escape_string($link,$_SESSION['email'])."','ON')";
						mysqli_query($link,$query);

						header("Location:loggedinpage.php");

					}else
					{
						echo '<div class="alert alert-danger" role="alert">Your file is too big!</div>';			
					}
		}else{
			echo '<div class="alert alert-danger" role="alert">There was an error uploading your file!</div>';
		}
	}else
	{
		echo '<div class="alert alert-danger" role="alert">You cannot upload files of this type!</div>';
	 }


}



?>
<?php
include("footer.php");



?>
