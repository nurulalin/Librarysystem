<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/checklogin.php');

if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
    
    
    $StudentID= $_POST['StudentID'];
    $BookId= $_POST['BookId'];
 
  
      $query= mysqli_query($conn,"INSERT INTO tblissuedbookdetails(BookId,StudentID)
                           VALUES('$BookId','$StudentID' )");

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Request Book</title>
<!-- BOOTSTRAP CORE STYLE  -->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
<link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_student_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getbook() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_book.php",
data:'bookid='+$("#bookid").val(),
type: "POST",
success:function(data){
$("#get_book_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


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
<h4 class="header-line">Issue a New Book</h4>
                
</div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Book
</div>



<div class="panel-body">
 <div class="col-sm-4">
   
<form role="form" method="post">
 
<?php $sql=mysqli_query($conn,"select * from tblstudents where EmailId='".$_SESSION['login']."'");
while($data=mysqli_fetch_array($sql))
{
?>

<div class="form-group">
<label>Student id</label>
<input class="form-control" type="text" name="StudentID" id="StudentID" value="<?php echo htmlentities($data['StudentId']);?>" readonly  />
</div>

<?php } ?>

<div class="form-group">  
<label>Choose your book<span style="color:red;">*</span></label>
<br>

    
<?php
$query = "SELECT * FROM tblbooks";
$run = mysqli_query($conn,$query);

echo "<select id='selectddl' name='BookId'> required ";
echo "<option>Select</option>";
while($row = mysqli_fetch_array($run))
{
    echo "<option value='".$row['id']."'>".$row['BookName']."</option>";

}
echo "</select>";


?>
</div>



<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book </button>

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

 <!--search & link rel for the style-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    
    <script type="text/javascript">
    $("#selectddl").chosen();
            
    </script>
</body>
</html>
<?php } ?>
