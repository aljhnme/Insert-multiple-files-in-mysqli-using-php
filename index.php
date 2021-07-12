<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>How do I insert multiple files into mysqli</title>
</head>
<body>
  <form method="post" action="index.php" enctype="multipart/form-data">
  	 Select text to upload:
  	 <br>
  	 <label>insert file img</label>
  	 <input type="file" name="img_file">
  	 <br>
  	 <label>insert file mp3</label>
  	 <input type="file" name="mp3_file">
  	 <br>
  	 <label>insert file mp4</label>
  	 <input type="file" name="mp4_file">

  	 <br>
  	 <br>
  	 <input type="submit" name="click">
  </form>
</body>
<?php 
  include 'mysqli.php';
  if (isset($_POST['click'])) 
  {  
   	 $empty_files="";
   	 $d_file="";
   	 $tables="";
  	 for ($i=1; $i < 4; $i++) 
  	 { 
  	 	if ($i == 1) 
  	 	{
  	 	  $files="img_file";
  	 	  $chack_type_file="png jpg jpeg";
  	 	  $alert_ch_file="Please add a valid picture file"."<br>";
  	 	  $table_name='`img`';
  	 	} 
  	   if ($i == 2) 
  	 	{
  	 	  $files="mp3_file";
  	 	  $chack_type_file="mp3";
  	 	  $alert_ch_file="Please add a valid mp3 file"."<br>";
  	 	  $table_name='`mp3`';
  	 	} 
  	 	if ($i == 3) 
  	 	{
  	 	  $files="mp4_file";
  	 	  $chack_type_file="mp4";
  	 	  $alert_ch_file="Please add a valid mp4 file"."<br>";
  	 	  $table_name='`mp4`';

  	 	} 

  	 	if ($_FILES[$files]['name'] != "") 
  	 	{
  	 	  $file_dir="file/";

  	 	  $file_name=$file_dir.$_FILES[$files]['name'];

  	 	  $file_type=strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

  	 	  if (strpos($chack_type_file,$file_type) !== false) 
  	 	  {
  	 	  	move_uploaded_file($_FILES[$files]['tmp_name'],$file_name);
  	 	  	$tables.=$table_name;
  	 	  	$d_file.="'".$file_name."'";
  	 	  }else{
  	 	   echo	$alert_ch_file;
  	 	  }
           
  	 	}else{
  	 		$empty_files.=$i.",";
  	 	}
  	 }
  	 if ($empty_files == "1,2,3,") 
  	 {
  	   echo "Please add at least one file";
  	 }else{

  	   $table=str_replace("``","`,`",$tables);
  	   $FILE=str_replace("''","','",$d_file);
       
       if ($FILE != "") 
       {
         $sql="INSERT INTO `table_file`($table) VALUES ($FILE)";
         if ($connect->query($sql)) 
          {
         	 echo "<br>".str_word_count($tables)." files have been added";
          }
       }
  	 }
  }
?>
</html>
