 <?php
 include('connect.php');
  $sql = "select * from admin where id = '".$_SESSION["id"]."'";
        $result=$conn->query($sql);
        $ro=mysqli_fetch_array($result);

 ?>


<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<nav class="pcoded-navbar">
<div class="pcoded-inner-navbar main-menu">
  <?php if(($_SESSION['user'] == 'admin')){ ?>
<div class="pcoded-navigatio-lavel">Administrateur</div>
<?php } ?>
<?php if(($_SESSION['user'] == 'doctor')){ ?>
<div class="pcoded-navigatio-lavel">Docteur</div>
<?php } ?>
<?php if(($_SESSION['user'] == 'patient')){ ?>
<div class="pcoded-navigatio-lavel">Patient</div>
<?php } ?>
<ul class="pcoded-item pcoded-left-item">
<li class="">
<a href="index.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Tableau de bord</span>
</a>
</li>


<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor') || ($_SESSION['user'] == 'patient')){ ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-edit"></i></span>
        <span class="pcoded-mtext">Consultations</span>
    </a>
    <ul class="pcoded-submenu">
    <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'patient')) { ?>
        <li class="">
            <a href="appointment.php">
                <span class="pcoded-mtext">Nouveau pointage</span>
            </a>
        </li>
    <?php } ?>
    <?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')) { ?>
        <li class="">
            <a href="view-pending-appointment.php">
                <span class="pcoded-mtext">Voir Consultations en cours</span>
            </a>
        </li>
        <li class="">
            <a href="view-appointments-approved.php">
                <span class="pcoded-mtext">Voir Consultations approuvés</span>
            </a>
        </li>
    <?php } ?>
    <?php if($_SESSION['user'] == 'patient') { ?>
        <li class="">
            <a href="view-appointments.php">
                <span class="pcoded-mtext">Voir Consultations</span>
            </a>
        </li>
    <?php } ?>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'admin') { ?>
<li class="">
<a href="view_roles.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Gestion de roles</span>
</a>
</li>

<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Docteurs</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="doctor.php">
                <span class="pcoded-mtext">Nouveau docteur</span>
            </a>
        </li>

        <li class="">
            <a href="view-doctor.php">
                <span class="pcoded-mtext">Voir Docteur</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'doctor') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Docteur</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="visiting-hour.php">
                <span class="pcoded-mtext">Nouvelle heure de visite</span>
            </a>
        </li>

        <li class="">
            <a href="view-visiting-hour.php">
                <span class="pcoded-mtext">Voir heure de visite</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'patient') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Préscriptions</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="view-prescription.php">
                <span class="pcoded-mtext">Voir les préscriptions</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>


<?php if($_SESSION['user'] == 'patient') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Traitements</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="view-treatment-record.php">
                <span class="pcoded-mtext">Voir les traitements</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'doctor')) { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Patients</span>
    </a>
    <ul class="pcoded-submenu">
    <?php if($_SESSION['user'] == 'admin') { ?>
        <li class="">
            <a href="patient.php">
                <span class="pcoded-mtext">Ajouter Patient</span>
            </a>
        </li>
    <?php } ?>
        <li class="">
            <a href="view-patient.php">
                <span class="pcoded-mtext">Voir les patients</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>


<?php if($_SESSION['user'] == 'doctor') { ?>
<li>
    <a href="income-report.php">
        <span class="pcoded-micon"><i class="feather icon-file"></i></span>
        <span class="pcoded-mtext">Rapport de rentabilité</span>
    </a>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'admin') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Services</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="department.php">
                <span class="pcoded-mtext">Ajouter département</span>
            </a>
        </li>

        <li class="">
            <a href="view-department.php">
                <span class="pcoded-mtext">Voir département</span>
            </a>
        </li>

        <li class="">
            <a href="service.php">
                <span class="pcoded-mtext">Ajouter type de service</span>
            </a>
        </li>

        <li class="">
            <a href="view-service.php">
                <span class="pcoded-mtext">Voir types de services</span>
            </a>
        </li>

        <li class="">
            <a href="medicine.php">
                <span class="pcoded-mtext">Ajouter médicament</span>
            </a>
        </li>

        <li class="">
            <a href="view-medicine.php">
                <span class="pcoded-mtext">Voir médicaments</span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'doctor') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
        <span class="pcoded-mtext">Services</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="view-service.php">
                <span class="pcoded-mtext">Voir services </span>
            </a>
        </li>
    </ul>
</li>
<?php } ?>

<?php if($_SESSION['user'] == 'admin') { ?>
<li>
<a href="setting.php">
<span class="pcoded-micon"><i class="feather icon-settings"></i></span>
<span class="pcoded-mtext">Paramètres</span>
</a>
</li>
<?php } ?>

<li>
<a href="logout.php">
<i class="feather icon-log-out"></i> Déconnexion
</a>
</li>
</ul>
</div>
</nav>
