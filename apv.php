<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<div class="container">
    <h2>Add Product Variant</h2>
    <?php
        $sql = "SELECT * FROM `product_tb`";
        $res = mysqli_query($db,$sql);
        echo '
        <div class="container">
        <table class="table">
            <tr>
                <th> Product Name </th>
                <th> Company </th>
                <th> Category </th>
                <th> Add </th>
            </tr>
        ';
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $nm = $row['product_nm'];
            $cm = $row['product_cm'];
            $cid = $row['cat_id'];

            $sql1 = "SELECT `name` FROM `categories_tb` WHERE `id`='$cid'";
            $res1 = mysqli_query($db,$sql1);

            while($row1 = mysqli_fetch_assoc($res1)) {
                $cnm = $row1['name'];
            echo '
            <tr>
                <td>'.$nm.'</td>
                <td>'.$cm.'</td>
                <td>'.$cnm.'</td>
                <td><a href="addVar.php?pid='.$id.'" class="btn btn-primary">Add Var</a></td>
            </tr>
            ';
            }
        }
        echo '</table></div>';
    ?>


</div>

<?php include('inc/footer.php'); ?>