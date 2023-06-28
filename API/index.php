<?php
// api for kalam-self
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once 'connection.php';

extract($_REQUEST);


if ( $type == 1 ) {

    $sql = "";

    $res = mysqli_query($con , $sql);

    $products = [];

    while( $row = mysqli_fetch_assoc($res) ) {
        
        array_push( $products , $row ); 

    }
    
    $res = array( "data" => $products );

} elseif ( $type == 2 ) {

    // fetch all product

    $sql = "SELECT `product_tb`.* , `product_var`.* , GROUP_CONCAT(images_tb.image_name SEPARATOR' , ') as `imgs`  FROM `product_tb` JOIN `product_var` ON `product_tb`.`id` = `product_var`.`product_id` JOIN `images_tb` ON `product_var`.`id` = `images_tb`.`pid` GROUP BY `images_tb`.`pid`";

    $res = mysqli_query($con , $sql);

    $products = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        $imgs = explode(' , ', $row['imgs']);
        $row['imgs'] = $imgs;
        array_push( $products , $row );

    }
    
    $res = array( "products" => $products );

} elseif ( $type == 3 ) {

    // fetch using product name

    $sql = "SELECT `product_tb`.* , `product_var`.* , GROUP_CONCAT(images_tb.image_name SEPARATOR' , ') as `imgs`  FROM `product_tb` JOIN `product_var` ON `product_tb`.`id` = `product_var`.`product_id` JOIN `images_tb` ON `product_var`.`id` = `images_tb`.`pid` WHERE `product_tb`.`product_nm` LIKE '%$product_nm%' OR `product_var`.`sku` LIKE '%$product_nm%' GROUP BY `images_tb`.`pid`";

    $res = mysqli_query($con , $sql);

    $products = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        $imgs = explode(' , ', $row['imgs']);
        $row['imgs'] = $imgs;
        array_push( $products , $row );

    }
    
    $res = array( "products" => $products );


} elseif ( $type == 4 ) {

    // fetch using SKU

    $sql = "SELECT `product_tb`.* , `product_var`.* , GROUP_CONCAT(images_tb.image_name SEPARATOR' , ') as `imgs`  FROM `product_tb` JOIN `product_var` ON `product_tb`.`id` = `product_var`.`product_id` JOIN `images_tb` ON `product_var`.`id` = `images_tb`.`pid` WHERE `product_var`.`sku` = '$sku' GROUP BY `images_tb`.`pid`";

    $res = mysqli_query($con , $sql);

    $products = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        $imgs = explode(' , ', $row['imgs']);
        $row['imgs'] = $imgs;
        array_push( $products , $row );
        
    }
    
    $res = array( "products" => $products );


} elseif ( $type == 5 ) {

    // fetch all categories

    $sql = "SELECT * FROM `categories_tb`";

    $res = mysqli_query($con , $sql);

    $category = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        // extract($row);

        // $sql1 = "SELECT `name` FROM `categories_tb` WHERE  `id` = '$parent_id' ";

        // $res1 = mysqli_query($con , $sql1);
        
        // $row1 = mysqli_fetch_assoc($res1);

        // $parent_name = $row1['name'];

        // $row['parent_name'] = $parent_id == 0 ? 'MAIN' : $parent_name;

        array_push( $category , $row );
        
    }
    
    $res = array( "category" => $category );


} else {

}

echo json_encode($res);

?>