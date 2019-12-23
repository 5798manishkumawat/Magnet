<?php



include('connection.php');

				

						$query="SELECT * FROM `doc` WHERE mail='".mysqli_real_escape_string($link,$_SESSION['email'])."' and status='ON' ";
						$res=mysqli_query($link,$query);
						echo "<center>";
						echo "<br><br><br><div class='selection'><h1 style='color: white;'>Uploaded files:</h1></div>";
						while($row=mysqli_fetch_array($res))
						{
							$ID=$row['id'];
							echo "<div style='background-color:#dddddd;border:1px solid black;'><div style='text-align:left;'>";
							echo $row['name'];
							echo '</div><div style="text-align:right;"><a href="Downloadfile.php?Download='?><?php echo $ID;?><?php echo '"><input type="submit" style"text-align:right;" class="btn btn-success" name="submit" value="Download!!"></a>&nbsp;<a href="Deletefile.php?Delete='?><?php echo $ID;?><?php echo '"><input type="submit" style"text-align:right;" class="btn btn-danger" name="submit" value="Delete!!"></a>';
							echo '&nbsp;<a href="Sharefile.php?Share='?><?php echo $ID;?><?php echo '"><input type="submit" style"text-align:right;" class="btn btn-primary" name="submit" value="Share!!"></a>';

							echo "</div></div>";
						}



						echo "<br><br><br><div class='selection'><h1 style='color:white;'>Shared files:</h1></div>";

						$Query="SELECT * FROM `doc` WHERE mail='".mysqli_real_escape_string($link,$_SESSION['email'])."' and status='OFF' ";
						$Res=mysqli_query($link,$Query);
						while($Row=mysqli_fetch_array($Res))
						{
							$ID=$Row['id'];
							echo "<div style='background-color:#dddddd;border:1px solid black;'><div style='text-align:left;'>";
							echo $Row['name'];
							echo '</div><div style="text-align:right;"><a href="Downloadfile.php?Download='?><?php echo $ID;?><?php echo '"><input type="submit" style"text-align:right;" class="btn btn-success" name="submit" value="Download!!"></a>&nbsp;<a href="Deletefile.php?Delete='?><?php echo $ID;?><?php echo '"><input type="submit" style"text-align:right;" class="btn btn-danger" name="submit" value="Delete!!"></a>';
							echo "</div></div>";
						}







						echo "</center>";

?>