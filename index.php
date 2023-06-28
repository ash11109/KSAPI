<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<div class="container">
<h2>Product Add Item</h2>

<?php
    function categoryTree($parent_id = 0, $sub_mark = ''){
            global $db;
            $query = $db->query("SELECT * FROM `categories_tb` WHERE `parent_id` = $parent_id ORDER BY `name` ASC");          
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    echo '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
                    categoryTree($row['id'], $sub_mark.'--');
                }
            }
    }
?>

<label for="catid">Select Category : </label>

<select name="category" id="catid">
    <option value="0">Select one if u have</option>
    <?php categoryTree(); ?>
</select><br>

<label for="pn"> Product Name : </label>
    <input type="text" id="pn"><br>
<label for="pc"> Product Company : </label>
    <input type="text" id="pc"><br>
<label for="pdc"> Product Description : </label>
<textarea name="pdc" id="pdc" class="summernote" cols="80" rows="6"></textarea><br>
<label for="kwd"> Keywords : </label>
<textarea name="kwd" id="kwd" cols="80" rows="3" placeholder="keywords use , to seprate"></textarea><br>
    
<button id="add" class="btn btn-primary">add</button>
<br>

</div>


<?php include('inc/footer.php'); ?>