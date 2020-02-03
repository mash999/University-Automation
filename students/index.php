<?php session_start(); 

include_once('requires/functions.php'); 
unset($_SESSION['User_id']);
session_destroy();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = ($_POST['name']);
    $password = ($_POST['password']);

    $sql="SELECT * FROM `accounts` WHERE username='$name'";
    foreach ($con->query($sql) as $row) 
    {
        $user=$row['id'];
        $user_pass=$row['password'];
        if(hash('sha256', $password)==$user_pass){
            session_start();
            $_SESSION['User_id']=$name;
            header("Location: views/students-profile.php");  
        }

        else{
            ?>
                <script> location.replace("index.php?status=1"); </script>
            <?php
        }
    }
}

$status="";
if(isset($_GET['status'])){
    $status = $_GET['status'];   
    if ($status==1) {
        $status= "Wrong Username or Password!";
    }
}
?>

<html>

<style type="text/css">
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.fullscreen_bg {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-size: cover;
    background-position: 50% 50%;
    background-image: url('../img/bg.jpg');
    background-repeat:repeat;
  }

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


</head>

<div id="fullscreen_bg" class="fullscreen_bg"/>

	<div class="container" style="margin-top:150px;">
	    <div class="card card-container">
	        <h2 style=" text-align: center; text-shadow: 0 2px 2px rgba(0,0,0,0.5);">Sign In</h2>
            
            
	        <form class="form-signin" action="" method="post">
            <h4 style="color:#AB5958; font-weight:bold; padding-bottom:10px;" >      
              <?php echo $status; ?>
            </h4>
	            <input type="text" name="name" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
	            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	            <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin"> Sign In </button>
	        </form><!-- /form -->
	    </div>
	</div>

</div>
</html>