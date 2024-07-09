
<!-- Author Name: Nikhil Bhalerao +919423979339.
PHP, Laravel and Codeignitor Developer
-->
<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_GET['id']))
{
  $sql ="UPDATE appointment SET delete_status='1' WHERE departmentid='$_GET[id]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Succés
        </h3>
        <p>Pointage supprimé avec succés !</p>
        <p>
         <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
         <?php echo "<script>setTimeout(\"location.href = 'view-appointments.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
<?php
    //echo "<script>alert('Department record deleted successfully..');</script>";
    //echo "<script>window.location='view-appointment.php';</script>";
  }
}


if(isset($_GET['approveid']))
{
  $sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
  $qsql=mysqli_query($conn,$sql);
  if(mysqli_affected_rows($conn) == 1)
  {
?>
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Succés
        </h3>
        <p>Pointage supprimé avec succés !</p>
        <p>
         <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
         <?php echo "<script>setTimeout(\"location.href = 'view-appointments.php';\",1500);</script>"; ?>
        </p>
      </div>
    </div>
<?php
    //echo "<script>alert('Appointment record Approved successfully..');</script>";
    //echo "<script>window.location='view-appointment.php';</script>";
  }
}
?>
<?php
if(isset($_GET['delid']))
{ ?>
<div class="popup popup--icon -question js_question-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Sur
    </h1>
    <p>Est ce que t'es sur de supprimer cet enregistrement ?? Delete??</p>
    <p>
      <a href="view-department.php?id=<?php echo $_GET['delid']; ?>" class="button button--success" data-for="js_success-popup">Yes</a>
      <a href="view-department.php" class="button button--error" data-for="js_success-popup">No</a>
    </p>
  </div>
</div>
<?php } ?>
<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Voir les Consultations</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Voir les Consultations</a>
</li>
<li class="breadcrumb-item"><a href="#">Voir les Consultations</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">

<div class="card">
<div class="card-header">
    <div class="col-sm-10">
    </div>
<!-- <h5>DOM/Jquery</h5>
<span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
</div>
<div class="card-block">
<div class="table-responsive dt-responsive">
<table id="dom-jqry" class="table table-striped table-bordered nowrap">
<thead>
<tr>
    <th>Détails du patient</th>
    <th>Temps de pointage</th>
    <th>Département</th>
    <th>Docteur</th>
    <th>Raison</th>
    <th>Statut</th>
<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')){ ?>
    <th><div align="center">Action</div></th>
  <?php } ?>
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
      // Check if the necessary keys exist in the arrays
$patientName = isset($rspat['patientname']) ? $rspat['patientname'] : 'N/A';
$mobileNo = isset($rspat['mobileno']) ? $rspat['mobileno'] : 'N/A';
$appointmentDate = isset($rs['appointmentdate']) ? date("d-M-Y", strtotime($rs['appointmentdate'])) : 'N/A';
$appointmentTime = isset($rs['appointmenttime']) ? date("H:i A", strtotime($rs['appointmenttime'])) : 'N/A';
$departmentName = isset($rsdept['departmentname']) ? $rsdept['departmentname'] : 'N/A';
$doctorName = isset($rsdoc['doctorname']) ? $rsdoc['doctorname'] : 'N/A';
$appReason = isset($rs['app_reason']) ? $rs['app_reason'] : 'N/A';
$status = isset($rs['status']) ? $rs['status'] : 'N/A';

echo "<tr>
          <td>&nbsp;$patientName<br>&nbsp;$mobileNo</td>
          <td>&nbsp;$appointmentDate &nbsp; $appointmentTime</td>
          <td>&nbsp;$departmentName</td>
          <td>&nbsp;$doctorName</td>
          <td>&nbsp;$appReason</td>
          <td>&nbsp;$status</td>
      </tr>";

if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')){
          echo "<td><div align='center'>";
      if($rs['status'] != "Approved")
      {
          if(!(isset($_SESSION['patientid'])))
          {
              echo "<a href='appointmentapproval.php?editid=$rs[appointmentid]'>Approve</a><hr>";
          }
         echo "  <a href='viewappointment.php?delid=$rs[appointmentid]'>Delete</a>";
      }
      else
      {
        echo "<a href='patientreport.php?patientid=$rs[patientid]&appointmentid=$rs[appointmentid]'>View Report</a>";
      }
     echo "</center></td></tr>";
    }
  }
    ?>
</tbody>
<tfoot>
<tr>
    <th>Patient detail</th>
    <th>Temps de pointage</th>
    <th>Département</th>
    <th>Docteur</th>
    <th>Raison</th>
    <th>Statut</th>
    <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')){ ?>
    <th><div align="center">Action</div></th>
  <?php } ?>
</tr>
</tfoot>
</table>
</div>
</div>
</div>


</div>

</div>
</div>

<div id="#">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php');?>
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
      <!-- <button class="button button--success" data-for="js_success-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
     <?php echo "<script>setTimeout(\"location.href = 'view_user.php';\",1500);</script>"; ?>
     <!--  <button class="button button--error" data-for="js_error-popup">Close</button> -->
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
