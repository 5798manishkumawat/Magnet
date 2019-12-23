<?php 
include("Functions.php");
include("connection.php"); ?>
<?php
			global $link;
			$DeleteFromURL=$_GET['Delete'];
			$query="SELECT*FROM `doc` WHERE id='$DeleteFromURL'";
						$execute=mysqli_query($link,$query);
						$Rows=mysqli_fetch_array($execute);
						$FileName=$Rows['name'];
						$Path="uploads/".$FileName."";
							

							$Querydelete="SELECT*FROM doc WHERE name='".$FileName."' ";
							$Executedelete=mysqli_query($link,$Querydelete);
							$Rowsdelete=mysqli_num_rows($Executedelete);
							if($Rowsdelete==1){
										unlink($Path);
									}
						
			// $Target="deletedfiles/".($FileName);
			// move_uploaded_file($FileName,$Target);
						
			
			$query="DELETE FROM doc WHERE id='$DeleteFromURL'";
			$execute=mysqli_query($link,$query);
			
		if($execute){
			$_SESSION["SuccessMessage"]="Post Deleteded Successfully";
			Redirect_to("loggedinpage.php");
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong.Try Again!";
			Redirect_to("loggedinpage.php");
		}
?>
