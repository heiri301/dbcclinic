

<?php
if(isset($_POST['create_file']))
{
 $file_name=$_POST['file_name'];
 $folder="files/";
 $ext=".txt";
 $file_name=$folder."".$file_name."".$ext;
 $create_file = fopen($file_name, 'w');
 fclose($create_file);
}

if(isset($_POST['edit_file']))
{
 $file_name=$_POST['file_name'];
 $write_text=$_POST['edit_text'];
 $folder="files/";
 $ext=".txt";
 $file_name=$folder."".$file_name."".$ext;
 $edit_file = fopen($file_name, 'w');
	
 fwrite($edit_file, $write_text);
 fclose($edit_file);
}

if(isset($_POST['delete_file']))
{
 $file_name=$_POST['file_name'];
 $folder="files/";
 $ext=".txt";
 $file_name=$folder."".$file_name."".$ext;
 unlink($file_name);
}
?>

