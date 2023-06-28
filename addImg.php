<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<br>
<form id="abhi" class="container">
    <input type="text" name="pid" id="pid" value="<?= $_GET['pid']; ?>" readonly hidden><br>
    <label for="file">Choose Image :</label>
    <input id="file" accept=".jpg, .png, .jpeg" type="file"><br>
    <input type="submit" id="loadImage">
</form>

<?php include('inc/footer.php'); ?>