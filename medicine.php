<?php require_once('check_login.php');?>
<?php include('head.php');?>
<?php include('header.php');?>
<?php include('sidebar.php');?>
<?php include('connect.php');
if(isset($_POST['btn_submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE medicine SET medicinename='$_POST[medicinename]',medicinetype='$_POST[medicinetype]',description='$_POST[description]',status='$_POST[status]' WHERE medicineid='$_GET[editid]'";
        if($qsql = mysqli_query($conn,$sql))
        {
 ?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Succés
                </h3>
                <p>Médecin mis à jour avec succés ! </p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-medicine.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
 <?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
    else
    {
        $sql ="INSERT INTO medicine(medicinename,medicinetype,description,status) values('$_POST[medicinename]','$_POST[medicinetype]','$_POST[description]','$_POST[status]')";
        if($qsql = mysqli_query($conn,$sql))
        {
?>
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Succés
                </h3>
                <p>Médecin inséré avec succés !</p>
                <p>
                 <!--  <a href="index.php"><button class="button button--success" data-for="js_success-popup"></button></a> -->
                 <?php echo "<script>setTimeout(\"location.href = 'view-medicine.php';\",1500);</script>"; ?>
                </p>
              </div>
            </div>
<?php
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
}
if(isset($_GET['editid']))
{
    $sql="SELECT * FROM medicine WHERE medicineid='$_GET[editid]' ";
    $qsql = mysqli_query($conn,$sql);
    $rsedit = mysqli_fetch_array($qsql);

}
?>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<div class="pcoded-content">
<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>Médecin</h4>
<!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"><a>Médecin</a>
</li>
<li class="breadcrumb-item"><a href="#">Ajouter médecin</a>
</li>
</ul>
</div>
</div>
</div>
</div>


<div class="page-body">
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<!-- <h5>Basic Inputs Validation</h5>
<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span> -->
</div>
<div class="card-block">
<form id="main" method="post" action="" enctype="multipart/form-data">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nom de médecin</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="medicinename" id="medicinename"
                                    value="<?php if(isset($_GET['editid'])) { echo $rsedit['medicinename']; } ?>">
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type de médecin</label>
        <div class="col-sm-8">
            <select class="form-control" name="medicinetype" id="medicinetype">
              <option value="">-- Sélectionner un -- </option>
              <option value="Tablet">Tablette de médicaments</option>
              <option value="Capsule">Capsules</option>
              <option value="Syrup">Sirop</option>
              <option value="Drop">Drop</option>
              <option value="Inhaler">Inhaler (Respiratoire)</option>
              <option value="Injection">Injection</option>
              <option value="Gel">Gel</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="description" id="description"><?php if(isset($_GET['editid'])) { echo $rsedit['description']; } ?></textarea>
            <span class="messages"></span>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Statut</label>
        <div class="col-sm-8">
            <select name="status" id="status" class="form-control" required="">
                <option value="">-- Select One -- </option>
                <option value="Active" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Active') { echo 'selected'; } } ?>>Actif</option>
                <option value="Inactive" <?php if(isset($_GET['editid']))
        { if($rsedit['status'] == 'Inactive') { echo 'selected'; } } ?>>Inactif</option>
            </select>
            <span class="messages"></span>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-sm-2"></label>
        <div class="col-sm-10">
            <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Enregistrer</button>
        </div>
    </div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php');?>

<script type="text/javascript">
    $('#main').keyup(function(){
        $('#confirm-pw').html('');
    });

    $('#cnfirmpassword').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });

    $('#password').change(function(){
        if($('#cnfirmpassword').val() != $('#password').val()){
            $('#confirm-pw').html('Password Not Match');
        }
    });
</script>
