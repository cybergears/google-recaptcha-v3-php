<?php

    define('SITE_KEY','YOUR_SITE_KEY'); // add your site key
    define('SECRET_KEY','YOUR_SECRET_KEY'); //add your secret key

    if(isset($_POST['name'])){
        $name  = $_POST['name'];
        $token = $_POST['token'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.SECRET_KEY.'&response='.$token.'&remoteip='.$_SERVER['REMOTE_ADDR'].'';

        $res = file_get_contents($url);

        $response = json_decode($res);

        if($response->success==true){
            // save data in the database
        }else{
            // show error in case the result is false
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Google reCaptcha V3</title>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
    </head>
    <body>
        <form name="repatcha_test_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <input type="text" id="name" name="name" value="" />
            <input type="hidden" id="token" name="token" value="" />
            <input type="submit" name="save" value="save" />
        </form>
    </body>
</html>
<script>
        grecaptcha.ready(function() {
          grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'submit'}).then(function(token) {
              var response = document.getElementById("token");
              response.value = token;
          });
        });
  </script>
