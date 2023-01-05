<?php
session_start();
$pageTitle = 'form';
require_once "inc/template/header.php";
?>
<div class="mt-5">
    <form class="w-75 m-auto" action="generate.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Img:</label>
            <input type="file" name="img" class="form-control" required>
            <?php if (isset($_SESSION['errors'])) {  ?>
                <div class="mt-2">
                    <div class="m-auto alert alert-danger">
                    <?php foreach ($_SESSION['errors'] as $error) { ?>
                        <P><?php echo $error ?> </p>
                    <?php }
                    unset($_SESSION['errors']); ?>
                     </div>
                </div>
            <?php 
                }
            ?>
        </div>
        <div class="form-group">
            <label>Num:</label>
            <input type="number" name="num" class="form-control" required min="1">
        </div>
        <button type="submit" name="submit" class="btn btn-info mt-3 float-right">Generate</button>
        <div class="clr"></div>
    </form>
</div>

<?php
require_once "inc/template/footer.php";
?>