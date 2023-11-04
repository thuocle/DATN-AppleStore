<?php session_start();
    require_once('../define.php');
    /**
     * SET CONNECT
     */
    $conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);
    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    /**
     * CALL GOOGLE API
     */
    require_once '../vendor/autoload.php';
    $client = new Google_Client();
    $client->setClientId(GOOGLE_APP_ID);
    $client->setClientSecret(GOOGLE_APP_SECRET);
    $client->setRedirectUri(GOOGLE_APP_CALLBACK_URL);
    $client->addScope("email");
    $client->addScope("profile");
    
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
       // print_r($token);
        $client->setAccessToken($token['access_token']);
 
        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
       // print_r($google_account_info);
       /**
        * CHECK EMAIL AND NAME IN DATABASE
        */
        $check = "SELECT * FROM `google_users` WHERE `google_email`='".$email."' and `google_name`='".$name."'";

        $result = mysqli_query($conn,$check);
        if (!$result) {
            // handle query error
            echo "Error: " . mysqli_error($conn);
            exit;
        }
        $rowcount=mysqli_num_rows($result);
        if($rowcount>0){
            /**
             * USER EXISTS
             */
            $_SESSION['user'] = $name;
            header(('Location:../index.php'));
        }
        else{
            /**
             * INSERT USER TO DATABASE
             * AFTER INSERT, YOU CAN HEADER TO HOME
             */
            // INSERT USER TO DATABASE
            $insert = "INSERT INTO `google_users`(`google_name`, `google_email`) VALUES ('".$name."','".$email."')";
            if(mysqli_query($conn,$insert)){
                $user_id = mysqli_insert_id($conn);
                // do something with $user_id, such as redirect to home page
                $_SESSION['user'] = $name;
                header(('Location:../index.php'));
            } else {
                // handle query error
                echo "Error: " . mysqli_error($conn);
                exit;
            }
        }     
    } else {
        ?>
        
        
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login-Signup</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../double-slider-registration-and-login-page-main/style.css">
</head>
<body>
  <div class="container" id="container">

    <div class="form-container register-container">
      <form action="../admin/register.php" method="POST">
        <h1>Register</h1>
        <input type="text" placeholder="Full Name" name="hoten">
        <input type="text" placeholder="User Name" name="user">
        <input type="email" placeholder="Email">
        <input type="text" placeholder="Address">
        <input type="password" placeholder="Password" name="pass1">
        <input type="password" placeholder="Confirm Password" name="pass2">
       
        <button type="submit" name="submit">Register</button>
        <span>or use your account</span>
        <div class="social-container">
          <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
          <a href="<?php echo $client->createAuthUrl(); ?>" class="social"><i class="lni lni-google"></i></a>
          <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
        </div>
      </form>
    </div>

    <div class="form-container login-container">
      <form action="../admin/login.php" method="post">
        <h1>Login hire.</h1>
        <input type="text" placeholder="Email or Username" name="email">
        <input type="password" placeholder="Password" name="pass">
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label>Remember me</label>
          </div>
          <div class="pass-link">
            <a href="#">Forgot password?</a>
          </div>
        </div>
        <button type="submit">Login</button>
        <span>or use your account</span>
        <div class="social-container">
          <a href="#" class="social"><i class="lni lni-facebook-fill"></i></a>
          <a href="<?php echo $client->createAuthUrl(); ?>" class="social"><i class="lni lni-google"></i></a>
          <a href="#" class="social"><i class="lni lni-linkedin-original"></i></a>
        </div>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Hello <br> friends</h1>
          <p>if Yout have an account, login here and have fun</p>
          <button class="ghost" id="login">Login
            <i class="lni lni-arrow-left login"></i>
          </button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Start yout <br> journy now</h1>
          <p>if you don't have an account yet, join us and start your journey.</p>
          <button class="ghost" id="register">Register
            <i class="lni lni-arrow-right register"></i>
          </button>
        </div>
      </div>
    </div>

  </div>

  <script src="../double-slider-registration-and-login-page-main/script.js"></script>

</body>
</html>
<?php
         /**
         * IF YOU DON'T LOGIN GOOGLE
         * YOU CAN SEE AGAIN GOOGLE_APP_ID, GOOGLE_APP_SECRET, GOOGLE_APP_CALLBACK_URL
         */
        // echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
    }

    mysqli_close($conn);
?>