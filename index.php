
<!DOCTYPE html>
<html lang="en">
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');?>

 <?php
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $row1=mysqli_fetch_array($result);

 ?>


<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper full-calender">
<div class="page-body">
<div class="row">
<?php
$sql_manage = "select * from manage_website";
$result_manage = $conn->query($sql_manage);
$row_manage = mysqli_fetch_array($result_manage);
?>

<?php if($_SESSION['user'] == 'admin'){ ?>
<div class="col-xl-3 col-md-6">
<div class="card bg-c-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
    <?php
    $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
    ?>
</h4>
<h6 class="text-white m-b-0">Total de Patients</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-2" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-pink update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
    $sql = "SELECT * FROM doctor WHERE status='Active' and delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Total des docteurs</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-3" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-lite-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
    $sql = "SELECT * FROM admin WHERE delete_status='0'";
    $qsql = mysqli_query($conn,$sql);
    echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Administrateurs en cours de fonction
</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-4" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-yellow update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">	&#x20B9;.
    <?php
          $sql = "SELECT sum(bill_amount) as total  FROM `billing_records` ";
          $qsql = mysqli_query($conn,$sql);
          while ($row = mysqli_fetch_assoc($qsql))
          {
           echo $row['total'];
         }
    ?>
</h4>
<h6 class="text-white m-b-0">Les revenus </h6>
 </div>
<div class="col-4 text-right">
<canvas id="update-chart-1" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>



<?php }else if($_SESSION['user'] == 'doctor'){ ?>
<div class="row col-sm-12"><h3>Bienvenue <?php echo ''.$_SESSION['fname']; ?></h3><br><br></div>
<div class="col-xl-3 col-md-6">
<div class="card bg-c-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
    <?php
        $sql = "SELECT * FROM appointment WHERE `doctorid`=1 AND appointmentdate=' ".date("Y-m-d")."' and delete_status='0'";
        $qsql = mysqli_query($conn,$sql);
        echo mysqli_num_rows($qsql);
    ?>
</h4>
<h6 class="text-white m-b-0">Nouveau pointage</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-2" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-pink update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
  $sql = "SELECT * FROM patient WHERE status='Active' and delete_status='0'";
  $qsql = mysqli_query($conn,$sql);
  echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Numéro des patients</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-3" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-lite-green update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">
<?php
  $sql = "SELECT * FROM appointment WHERE status='Active' AND `doctorid`=1 AND appointmentdate=' ".date("Y-m-d")."' and delete_status='0'" ;
  $qsql = mysqli_query($conn,$sql);
  echo mysqli_num_rows($qsql);
?>
</h4>
<h6 class="text-white m-b-0">Consultations d'aujourd'hui
</h6>
</div>
<div class="col-4 text-right">
<canvas id="update-chart-4" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<div class="col-xl-3 col-md-6">
<div class="card bg-c-yellow update-card">
<div class="card-block">
<div class="row align-items-end">
<div class="col-8">

<h4 class="text-white">&#x20B9;.
<?php
    $sql = "SELECT sum(bill_amount) as total  FROM `billing_records` WHERE `bill_type` = 'Consultancy Charge'" ;
    $qsql = mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($qsql))
    {
      echo $row['total'];
    }
?>
</h4>
<h6 class="text-white m-b-0">Total des revenus</h6>
 </div>
<div class="col-4 text-right">
<canvas id="update-chart-1" height="50"></canvas>
</div>
</div>
</div>
</div>
</div>

<?php }else if($_SESSION['user'] == 'patient'){

    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatient = mysqli_query($conn,$sqlpatient);
    $rspatient = mysqli_fetch_array($qsqlpatient);

    $sqlpatientappointment = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' ";
    $qsqlpatientappointment = mysqli_query($conn,$sqlpatientappointment);
    $rspatientappointment = mysqli_fetch_array($qsqlpatientappointment);

?>
  <div class="row col-lg-12"><h3><b>Tableau de bord</b></h3></div>
  <div class="row col-lg-12">Welcome to HealthCare<br><br></div>
  <div class="card row col-lg-12">
    <div class="card-block">
      <!-- Row start -->
      <div class="row">
        <div class="col-lg-12">
          <div class="sub-title"><h2>Bienvenue Mr. <?php echo ''.$_SESSION['fname']; ?> !!</h2></div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs md-tabs" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">Historique de Consultations</a>
                  <div class="slide"></div>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Consultations</a>
                  <div class="slide"></div>
              </li>
          </ul>
          <!-- Tab panes -->

          <div class="tab-content card-block">
              <div class="tab-pane active" id="home3" role="tabpanel">
                  <p class="m-0"><b>Historique d'inscriptions</b>
                        <h3>Tu est avec nous du .. <?php echo $rspatient['admissiondate']; ?>
                            <?php echo $rspatient['admissiontime']; ?></h3></p>
              </div>
              <div class="tab-pane" id="profile3" role="tabpanel">
                  <p class="m-0">
                    <b>Consultations</b>
                      <?php
                        if(mysqli_num_rows($qsqlpatientappointment) == 0)
                        {
                            ?>
                        <h3>Pas de Consultations trouvés.. </h3>
                        <?php
                        }
                        else
                        {
                            ?>
                        <h3>Dernier pointage pris - <?php echo $rspatientappointment['appointmentdate']; ?>
                            <?php echo $rspatientappointment['appointmenttime']; ?> </h3>
                        <?php
                        }
                      ?>
                  </p>
              </div>
          </div>
      </div>
      </div>
      <!-- Row end -->
  </div>
  </div>
<?php } ?>

</div>

<?php if($_SESSION['user'] == 'admin'){ ?>


  <div class="card">
  <div class="card-header">
        <h2>Consultations</h2>
  </div>
  <div class="card-block">
  <div class="table-responsive dt-responsive">
  <table id="dom-jqry" class="table table-striped table-bordered nowrap">
  <thead>
  <tr>
      <th>Détail du patient</th>
      <th>Date et heure du pointage</th>
      <th>Départment</th>
      <th>Docteur</th>
      <th>Raison</th>
      <th>Statut</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $sql ="SELECT * FROM appointment WHERE (status !='') and delete_status='0'";
      if(isset($_SESSION['patientid']))
      {
        $sql  = $sql . " AND patientid='$_SESSION[patientid]'";
      }
      $qsql = mysqli_query($conn,$sql);
      while($rs = mysqli_fetch_array($qsql))
      {
        $sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]' and delete_status='0'";
        $qsqlpat = mysqli_query($conn,$sqlpat);
        $rspat = mysqli_fetch_array($qsqlpat);


        $sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]' and delete_status='0'";
        $qsqldept = mysqli_query($conn,$sqldept);
        $rsdept = mysqli_fetch_array($qsqldept);

        $sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]' and delete_status='0'";
        $qsqldoc = mysqli_query($conn,$sqldoc);
        $rsdoc = mysqli_fetch_array($qsqldoc);
        echo "<tr>
        <td>&nbsp;" . (isset($rspat['patientname']) ? $rspat['patientname'] : 'N/A') . "<br>&nbsp;" . (isset($rspat['mobileno']) ? $rspat['mobileno'] : 'N/A') . "</td>
        <td>&nbsp;" . (isset($rs['appointmentdate']) ? date("d-M-Y", strtotime($rs['appointmentdate'])) : 'N/A') . " &nbsp; " . (isset($rs['appointmenttime']) ? date("H:i A", strtotime($rs['appointmenttime'])) : 'N/A') . "</td>
        <td>&nbsp;" . (isset($rsdept['departmentname']) ? $rsdept['departmentname'] : 'N/A') . "</td>
        <td>&nbsp;" . (isset($rsdoc['doctorname']) ? $rsdoc['doctorname'] : 'N/A') . "</td>
        <td>&nbsp;" . (isset($rs['app_reason']) ? $rs['app_reason'] : 'N/A') . "</td>
        <td>&nbsp;" . (isset($rs['status']) ? $rs['status'] : 'N/A') . "</td>
    </tr>";
    
      }
      ?>
  </tbody>
  <tfoot>
  <tr>
      <th>Détails du patient</th>
      <th>Date & Heure des Consultations</th>
      <th>Départements</th>
      <th>Docteurs</th>
      <th>Raisons</th>
      <th>Statuts</th>
  </tr>
  </tfoot>
  </table>
  </div>
  </div>
  </div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>


<?php include('footer.php');?>
