<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$StudentId=$_POST['StudentId'];
$FullName=$_POST['FullName'];
$EmailId=$_POST['EmailId'];
$MobileNumber=$_POST['MobileNumber'];
$Password=$_POST['Password'];
$id=intval($_GET['id']);
$sql="Delete FROM pending WHERE id=:id;
INSERT INTO  tblstudents(StudentId,FullName,EmailId,MobileNumber,Password, status) VALUES(:StudentId,:FullName,:EmailId,:MobileNumber,:Password, 1)";
$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
$query->bindParam(':EmailId',$EmailId,PDO::PARAM_STR);
$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
$query->bindParam(':Password',$Password,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);

$query->execute();
$_SESSION['msg']="Approved. Email has been sent successfully ";
header('location:pending.php');
}

   if (mail($_POST['EmailId'], $_POST['subject'], $_POST['message']))
        {
                      
        echo "<script type='text/javascript'>alert('Updated and email has been sent successfully!');
        </script>";
        
        }
     
         
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Pending Registration</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$id=intval($_GET['id']);
$sql = "SELECT * FROM pending where id=:id";
$query = $dbh -> prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">

<input class="form-control" type="hidden" name="StudentId" value="<?php echo htmlentities($result->StudentId);?>" />
</div>




<div class="form-group">
<label>Full Name</label>
<input class="form-control" type="text" name="FullName" value="<?php echo htmlentities($result->FullName);?>"  />
</div>

 <div class="form-group">
 <label>Email</label>
 <input class="form-control" type="text" name="EmailId" value="<?php echo htmlentities($result->EmailId);?>"    />
 </div>
 
  <div class="form-group">
 <label>Contact Number</label>
 <input class="form-control" type="text" name="MobileNumber" value="<?php echo htmlentities($result->MobileNumber);?>"  />
 </div>
  
<div class="form-group">
<input class="form-control" type="hidden" name="subject" value="Thanks for signing up. You can now use the system"  />
</div>
  
  
 <div class="form-group">
<label class="col-sm-3 col-form-label"><b>Remark</b></label>
<textarea name="message" class="form-control" required="true">

Your registration has been accepted by the library. You can now issue books using your account.
</textarea>
</div>
  
  
<div class="form-group">
 <input class="form-control" type="hidden" name="Password" value="<?php echo htmlentities($result->Password);?>"   />
 </div>
 <?php }} ?>
<button type="submit" name="update" class="btn btn-info">Approve </button>

</form>
</div>
</div>
</div>

</div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
