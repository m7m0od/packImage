<?php 
session_start();
$pageTitle = 'Card';
require_once "inc/template/header.php";
if(isset($_POST['submit']))
{
    // Extraction
    $num=$_POST['num'];
    $image=$_FILES['img'];
    // img data
    $imageName=$image['name'];
    $imageTmpName=$image['tmp_name'];
    $imageError=$image['error'];
    $imageSize=$image['size'];
    $imageSizeMB=$imageSize/(1024**2);
    $ext=pathinfo($imageName,PATHINFO_EXTENSION);

    $errors=[];
    // validation
    if(empty($num))
    {$errors[]="num is required";}
    elseif (!is_numeric($num)) {$errors[]="num is not valid";}

    if($imageError>0)
    {$errors[]="error while uploading";}
    else if(!in_array(strtolower($ext),['jpg','png','jpeg','gif'])){$errors[]="must be image";}
    else if($imageSizeMB>1) {$errors[]="image maxsize must be 1mb";}

    if(empty($errors))
    {
        // upload img
        move_uploaded_file($imageTmpName,"uploads/$imageName");
        ?>
        <div class="container someIdits" id = "htmlContent">   
        <?php
       //loop
       for($i=0;$i<$num;$i++)
       {
        if($i % 2 == 0){
        ?>
            <img class="mt-2 float-right" src="uploads/<?php echo $imageName ?>"> 
            <div class="clr"></div>
        <?php
        }else{
        ?>
            <img class="mt-2" src="uploads/<?php echo $imageName ?>"> 
        <?php }
        echo "<br>";
       }
       ?>
        </div>
        <a class="btn btn-info forPositon" id="download">Download</a>
       <?php
    }
    else{
        $_SESSION['errors']=$errors;
        header("location:index.php");
    }
}
require_once "inc/template/footer.php";
?>