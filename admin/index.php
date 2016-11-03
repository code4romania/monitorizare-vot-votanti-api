<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/monitorizare-vot-votanti/db_connect.php' );
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         header("location: admin.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   <head>
      <title>Login moderatori</title> 
   </head>
   <body >     
               <form action = "" method = "post">
                  <label>Username  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>       
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
           </body>
</html>