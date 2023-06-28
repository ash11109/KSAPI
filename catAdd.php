<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>
    
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

<div class="container">
    <br>
    <label for="name">Category Name : </label>
<input type="text" id="name"><br>

<label for="pid"> Select Parent Category </label>
<select name="category" id="pid">
    <option value="0">select one if u have</option>
    <?php categoryTree(); ?>
</select><br>
<button id="addCat" class="btn btn-primary">add</button><br>
</div>

<?php include('inc/footer.php'); ?>