<?php session_start(); ?>

<link rel="stylesheet" href="popup_style.css">
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>Page de connexion</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords" content="Admin , Responsive">
<meta name="author" content="Youness Hamdaoui +212656785099.">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">

<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">

<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body class="fix-menu">

<?php
  include('connect.php');
  extract($_POST);
if(isset($_POST['btn_login']))
{
  $passw = hash('sha256', $_POST['password']);
  function createSalt()
  {
      return '2123293dsj2hu2nikhiljdsd';
  }
  $salt = createSalt();
  $pass = hash('sha256', $salt . $passw);
  if($_POST['user'] == 'admin'){
    $sql = "SELECT * FROM admin WHERE loginid='" .$email . "' and password = '". $pass."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);  
    $_SESSION["adminid"] = $row['id'];
    $_SESSION["id"] = $row['id'];
    $_SESSION["username"] = $row['username'];
    $_SESSION["password"] = $row['password'];
    $_SESSION["email"] = $row['loginid'];
    $_SESSION["fname"] = $row['fname'];
    $_SESSION["lname"] = $row['lname'];
    $_SESSION['image'] = $row['image'];
    $_SESSION['user'] = $_POST['user'];
  }else if($_POST['user'] == 'doctor'){    
    $sql = "SELECT * FROM doctor WHERE loginid='" .$email . "' and password = '". $pass."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);    
    $_SESSION["doctorid"] = $row['doctorid'];
    $_SESSION["id"] = $row['doctorid'];
    $_SESSION["password"] = $row['password'];
    $_SESSION["email"] = $row['loginid'];
    $_SESSION["fname"] = $row['doctorname'];
    $_SESSION['user'] = $_POST['user'];
  }else if($_POST['user'] == 'patient'){    
    $sql = "SELECT * FROM patient WHERE loginid='" .$email . "' and password = '". $pass."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);    
    $_SESSION["patientid"] = $row['patientid'];
    $_SESSION["id"] = $row['patientid'];
    $_SESSION["password"] = $row['password'];
    $_SESSION["email"] = $row['loginid'];
    $_SESSION["fname"] = $row['patientname'];
    $_SESSION['user'] = $_POST['user'];
  }
     $count=mysqli_num_rows($result);
     if($count==1 && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    {       
        ?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Succés 
            </h3>
            <p>Connexion réussie ! </p>
            <p>
             <?php echo "<script>setTimeout(\"location.href = 'index.php';\",1500);</script>"; ?>
            </p>
          </div>
        </div>
     <?php
    }
}
else {?>
     <div class="popup popup--icon -error js_error-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Erreur
        </h3>
        <p>E-mail ou mot de passe incorrect !</p>
        <p>
          <a href="login.php"><button class="button button--error" data-for="js_error-popup">Fermer</button></a>
        </p>
      </div>
    </div>

<?php
      }
    
   }
?>

<?php
$que="select * from manage_website";
$query=$conn->query($que);
while($row=mysqli_fetch_array($query))
{
  extract($row);
  $business_name = $row['business_name'];
  $business_email = $row['business_email'];
  $business_web = $row['business_web'];
  $portal_addr = $row['portal_addr'];
  $addr = $row['addr'];
  $curr_sym = $row['curr_sym'];
  $curr_position = $row['curr_position'];
  $front_end_en = $row['front_end_en'];
  $date_format = $row['date_format'];
  $def_tax = $row['def_tax'];
  $logo = $row['logo'];
}
?>

<section class="login-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="auth-box card">
          <div class="text-center">
            <img class="profile-img" src="uploadImage/Logo/<?php echo $logo; ?>" style="width: 60%">
          </div> 
          <div class="card-block">
            <div class="row m-b-20">
              <div class="col-md-12">
                <h5 class="text-center txt-primary">Bienvenue sur votre plateforme, HealthCare !</h5>
              </div>
            </div>
            <form method="POST">
              <div class="form-group form-primary">
                <select name="user" class="form-control" required="">
                  <option value="">-- Sélectionner votre statut --</option>
                  <option value="admin">Administrateur</option>
                  <option value="doctor">Docteur</option>
                  <option value="patient">Patient</option>
                </select>
                <span class="form-bar"></span>
              </div>
              <div class="form-group form-primary">
                <input type="email" name="email" class="form-control" required="" placeholder="Email">
                <span class="form-bar"></span>
              </div>
              <div class="form-group form-primary">
                <input type="password" name="password" class="form-control" required="" placeholder="Password">
                <span class="form-bar"></span>
              </div>
              <div class="row m-t-25 text-left">
                <div class="col-6">
                  <div class="forgot-phone">
                    <a href="signup.php" class="f-w-600">Créer un compte</a>
                  </div>
                </div>
                <div class="col-6">
                  <div class="forgot-phone text-right f-right">
                    <a href="forgot_password.php" class="f-w-600">Mot de passe oublié ?</a>
                  </div>
                </div>
              </div>
              <div class="row m-t-30">
                <div class="col-md-12">
                  <button type="submit" name="btn_login" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">S'authentifier</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript" src="files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="files/bower_components/modernizr/js/css-scrollbars.js"></script>
<script type="text/javascript" src="files/bower_components/i18next/js/i18next.min.js"></script>
<script type="text/javascript" src="files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="files/assets/js/common-pages.js"></script>

</body>

<!-- for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com -->
</html>
