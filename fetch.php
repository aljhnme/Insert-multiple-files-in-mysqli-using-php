<?php
 
 include 'mysqli.php';

 $sql="SELECT * FROM `table_file`";

 $result=$connect->query($sql);

  while ($row = $result->fetch_assoc()) 
  {
  	 ?>
  	 <br>
  	 <img src="<?php echo $row['img'];?>">
  	 <br>
  	 <?php

  	 if ($row['mp3'] != "")  
  	 {
  	  ?>
        <audio controls>
        	<source src="<?php echo $row['mp3'];?>" type="audio/ogg">
        </audio>
        <br>
  	  <?php
  	 }

  	 if ($row['mp4'] != "") 
  	 {
  	 	?>
         <video width="320" height="240" controls>
         	 <source src="<?php echo $row['mp4'];?>" type="video/mp4">
         </video>
  	 	<?php
  	 }

  }
?>