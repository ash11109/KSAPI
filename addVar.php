<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<div class="container">
    <h2>Add Product Variant</h2>
    <input type="text" id="pi" value="<?= $_GET["pid"] ?>" readonly><br>
    <label for="tn1"> Type Name : </label>
    <input type="text" id="tn1"><br>
    <label for="tn1"> Type Value : </label>
    <input type="text" id="tq1"><br>
    <label for="tn1"> Type Name : </label>
    <input type="text" id="tn2"><br>
    <label for="tn1"> Type Value : </label>
    <input type="text" id="tq2"><br>
    <label for="pr"> Product Fake Price : </label>
    <input type="text" id="fpr"><br>
    <label for="pr"> Product Price : </label>
    <input type="text" id="pr"><br>
    <label for="sku"> SKU : </label>
    <input type="text" id="sku"><br>
    <button id="add1" class="btn btn-primary">ADD</button><br>

</div>

<?php include('inc/footer.php'); ?>