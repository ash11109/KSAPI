<?php include('inc/header.php'); ?>
<?php include('inc/nav.php'); ?>
<?php include('inc/connection.php'); ?>

<div class="container">
<?php
        $sql = "SELECT * FROM `product_tb`";
        $res = mysqli_query($db,$sql);
        echo '
        <div class="container">
        <table class="table">
            <tr>
                <th> Product Name </th>
                <th> Company </th>
                <th> Type Name and Value </th>
                <th> Type Name and Value </th>
                <th> Price </th>
                <th> SKU </th>
                <th> Add Image </th>
                <th> Show Iamge </th>
            </tr>
        ';
        while($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $nm = $row['product_nm'];
            $cm = $row['product_cm'];
            $description = $row['description'];

            $sql1 = "SELECT * FROM `product_var` WHERE `product_id`=$id";
            $res1 = mysqli_query($db,$sql1);

            while($row1 = mysqli_fetch_assoc($res1)) {
                extract($row1);
            echo '
            <tr>
                <td>'.$nm.'</td>
                <td>'.$cm.'</td>
                <td>'.$type_name_1.' , '.$type_qty_1.'</td>
                <td>'.$type_name_2.' , '.$type_qty_2.'</td>
                <td>'.$price.'</td>
                <td>'.$sku.'</td>
                <td><a href="addImg.php?pid='.$id.'" class="btn btn-primary">Add Iamge</a></td>
                <td><a href="showImage.php?pid='.$id.'" class="btn btn-info">Show Iamge</a></td>
            </tr>
            ';
            }
            }
            echo '</table></div>';

?>
</div>

<?php include('inc/footer.php'); ?>