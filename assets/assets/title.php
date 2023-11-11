        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Apple Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="shortcut icon" href="../assets/fonts/apple.ico" type="image/x-icon">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <?php session_start();
                            if(isset($_SESSION['admin']))
                            {
                                 echo $_SESSION['admin'];
                            
                                 }     else
                            {
                                header(('Location:../Login/GoogleLogin.php'));
                            }
                        ?>