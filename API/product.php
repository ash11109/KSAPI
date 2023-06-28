<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// API CTEATED BY ASH 
include_once '../inc/connection.php';

$sno = 0;
    // $sr = $_GET['sr'];
    // $sr =  "WHERE `id` = $id";
    $sql = "SELECT * FROM `product_var`";
    $res = mysqli_query($db,$sql);

    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = mysqli_fetch_assoc($res)) {

        $sno++;

        extract($row);

        $sql1 = "SELECT * FROM `product_tb` WHERE `id`='$product_id'";
        $res1 = mysqli_query($db,$sql1);

        while($row1 = mysqli_fetch_assoc($res1)) {
            
            $nm = $row1['product_nm'];
            $cm = $row1['product_cm'];
            $description = $row1['description'];
      

        $sql2 = "SELECT * FROM `images_tb` WHERE `pid`='$id'";
        $res2 = mysqli_query($db,$sql2);

        $posts_img = array();
        $posts_img['img_name'] = array();

        while($row2 = mysqli_fetch_assoc($res2)) {
            $inm = $row2['image_name'];

            $post_img = array(
                'image' => 'api/images/'.$inm
            );
    
            array_push($posts_img['img_name'], $post_img);
            
        }

        $post_item = array(
            'sno' => $sno,
            'sku' => $sku,
            'productName' => $nm,
            'companyName' => $cm,
            'price' => $price,
            'fakePrice' => $fprice,
            'productVariantOneType' => $type_name_1,
            'productVariantOneValue' => $type_qty_1,
            'productVariantTwoType' => $type_name_2,
            'productVariantTwoValue' => $type_qty_2,
            'description' => $description,
            'iamge' => $posts_img,
        );

        array_push($posts_arr['data'], $post_item);

    }
        
    }

            
    echo json_encode($posts_arr);

?>