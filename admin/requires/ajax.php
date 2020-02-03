
<?php 
	
require 'functions.php';
require 'edit-functions.php';

use Automation\admin;
	
if(isset($_POST['fileContent'])){
	$file_content = $_POST['fileContent'];
	$file = $_POST['file'];
	$last_index = strripos($file_content, "\n");
	$file_content = substr($file_content, 0, $last_index);
	$action = file_put_contents($file, $file_content);
	if($action){
		echo "Data Successfully Modified";
	}
}
	

?>