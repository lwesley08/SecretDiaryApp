<?php
    
    session_start();

    $diaryContent = "";

    if (array_key_exists('id', $_COOKIE)){
        
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if (array_key_exists("id", $_SESSION)){
        
       include("connection.php");
        
        $query = "SELECT diary FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
        
        $row = mysqli_fetch_array(mysqli_query($link, $query));
        
        $diaryContent = $row['diary'];
        
    } else{
        
        header("Location: index.php");
    }

?>

<html>
    
      
        
    <?php include("header.php"); ?>
    
    <body>
    
        <nav class="navbar navbar-toggleable-sm navbar-light bg-faded">
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#">Secret Diary</a>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
              
              
              <ul class="navbar-nav mr-auto">
                    
            </ul>
              
            </div>
              
              <a  class="mr-2" href = 'index.php?logout=1'><button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Log Out</button></a>
              
          
            
        </nav>
        
        <div class="container" id="diaryContainer">
            
       
        <textarea class="form-control" name="diary" id="diary"><?php echo $diaryContent; ?></textarea>   
            
        
            
      </div>

        <?php include("footer.php"); ?>
    
    </body>  


    


</html>
