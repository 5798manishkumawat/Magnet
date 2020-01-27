

<?php 
include("Functions.php");
include("connection.php"); 
include("Sessions.php");
?>

<?php
				if(!empty($_GET['Download']))
			{

				global $link;
				$DownloadFromURL=$_GET['Download'];
				$query="SELECT*FROM `doc` WHERE id='$DownloadFromURL'";
				$execute=mysqli_query($link,$query);
				$Rows=mysqli_fetch_array($execute);
				$Filename=$Rows['name'];

				$FilePath='uploads/'.$Filename;
				if(!empty($Filename) && file_exists($FilePath)){
	 

   
    

					header("Cache-Control:public");
					header("Content-Description:File Transfer");
					header("Content-Disposition: attachment; filename=$Filename");
					 header('Expires: 0');
    					header('Pragma: public');
					header("Content-Type: application/octet-stream");
					header('Cache-Control: must-revalidate');
					header('Content-Length: ' . filesize($FilePath));
					ob_end_clean();
					readfile($FilePath);
					exit;
				}else{
					$_SESSION["ErrorMessage"]="Sorry.This file does not exit!";
					Redirect_to("loggedinpage.php");
				}
			}	
?>
