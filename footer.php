<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      
    <script type= "text/javascript">
        
        $(".toggle").click(function(){
            
            $("#signUpForm").toggle();
            $("#loginForm").toggle();
            
            
        });
       
      $('#diary').on('input propertychange', function() {

          $.ajax({
              method: "POST",
              url: "updatedatabase.php",
              data: { content: $("#diary").val() }
            });

          
      });
        
        
    </script>