<?php

    session_start();

    $error = "";

   

    if (array_key_exists("logout", $_GET)){
        
        unset ($_SESSION['id']);
        
        setcookie ("id", "", time() - 60 * 60);
        $_COOKIE["id"] = "";
        
    } else if(array_key_exists("id", $_SESSION) OR array_key_exists("id", $_COOKIE)){
        
        header("Location: loggedin.php");
        
        
    }

    if ($_POST){
        
            include("connection.php");




            if (!$_POST["email"]){

                $error .= "An email address is required.<br>";

            }

            if (!$_POST["password"]){

                $error .= "A password is required.<br>";

            }


            if ($_POST["email"] && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                $error .= "The email address is invalid. <br>";

            }

            if ($error != ""){
                
                

                $error = '<div><p><strong>There were error(s) in your form:</strong><p>'. $error . '</div>';
                
                


            } else {

                if ($_POST['signUp'] == "1"){




               $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                $row = mysqli_fetch_array($result);

                if(mysqli_num_rows($result) > 0){

                    $error = "That email address is taken";
                    
                    
                    echo ($row['id']);


                } else{


                 $query = "INSERT INTO users (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, md5($_POST['password']))."')";

                

                if(!mysqli_query($link, $query)){


                    $error = "Could not sign you up, try again later";
                    

                } else {

                 $_SESSION['id'] = mysqli_insert_id($link);

                if ($_POST['stayLoggedIn'] == '1') {

                    setcookie("id", mysqli_insert_id($link), time() + 60 * 60 * 24 * 14);
                }  

               
                    
                    
                $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                mysqli_query($link, $query); 

               
                header("Location: loggedin.php");


                }
            }
            
        } else {
                
               $query = "SELECT id, password FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                $result = mysqli_query($link, $query);
                    
                $row = mysqli_fetch_array($result);
                
                if (isset($row)){
                
                    $hashedPassword = md5(md5($row['id']).$_POST['password']);
                    
                    if ($row['password'] == $hashedPassword){
                        
                        
                        
                        $_SESSION['id'] = $row['id'];

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $row['id'], time() + 60 * 60 * 24 * 14);
                        }  

                        header("Location: loggedin.php");
                        
                        
                    } else{
                        
                       $error = "Incorrect Password, try again";
                        
                        
                        
                    }

                 
                    
                } else{
                     
                    $error = "That email could not be found, try signing up";
                    
            
                    
                }
                
                
            
    
        }
    }
        
    }


?>

<?php include("header.php"); ?>
    
  <body>
      
 
     <div class="container formContainer">
         
     <h1>Secret Diary</h1>
    
    <p><strong>Store your thoughts permanently and securely.</strong></p>
         
    
     
     <div id="error"><?php if($error!=""){echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';} ?>     
    
     </div>     
             <form method="post" id="signUpForm" class="form">
                 
                 <p>Interested? Sign up now.</p>

                 <input class="form-control email infoForm" type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="Your Email">

                 <input class="form-control password infoForm" type="password" name="password" id="password" placeholder = "Your Password">
                
                 
                 <div class="form-check">
                    <label class="form-check-label">
                    
                    <input type="checkbox" class="form-check-input" name= "stayLoggedIn" value = "1">
                        
                    Stay logged in
                    
                     </label>
                 </div>

                 <input type = "hidden" name = "signUp" value = "1">

                  <button type="submit" id= "submit" name= "submit" class="btn btn-primary ">Sign Up!</button>
                 
                 <br>
                 
                 <button  id="toggle" type="button" class="btn btn-outline-primary toggle">Log in</button>

              </form>

        
      
          <form method="post" id="loginForm" class="form">
              
               <p>Already have an account? Log in below.</p>

             <input class="form-control email infoForm" type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="Your Email">

             <input class="form-control password infoForm" type="password" name="password" id="password" placeholder = "Your Password">
              
             <div class="form-check">
                <label class="form-check-label">

             <input type="checkbox" class="form-check-input" name= "stayLoggedIn" value = 1>
                    
                Stay logged in
                    
            </label>
                 
            </div>

              <input type = "hidden" name = "signUp" value = "0">

              <button type="submit" id= "submit" name= "submit" class="btn btn-primary">Log In!</button>
              <br>
              <button  id="toggle" type="button" class="btn btn-outline-primary toggle">Sign Up</button>

          </form>
         
         
    
    
         
    </div>
      
      
    
      
      
      
   <?php include("footer.php"); ?>
      

   
    
      
  </body>
    
    
