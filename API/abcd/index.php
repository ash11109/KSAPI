<?php
// api for kalam-client-app
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once 'connection.php';

extract($_REQUEST);

$result = [];

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen( $output_file, 'wb' ); 
    $data = explode( ',', $base64_string );
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    fclose( $ifp ); 
    return $output_file; 
}


if ( $type == 1 ) {

    // login

    $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' ";

    $res = mysqli_query($con , $sql);

    $data = [];

    if (mysqli_num_rows($res)) {

        $row = mysqli_fetch_assoc($res);

        if($row['status'] == 0) {

            $data = [
                "status" => 0 ,
                "msg" => "YOUR USERID SUSPENDED BY ADMIN.. CONTACT US!!"
            ];

        } else {

            $data = $row ;
    
            $data["status"] = 1 ;
        
        }

    } else {

        $data = [
            "status" => 0 ,
            "msg" => "CHECK USERNAME OR PASSWORD"
        ];
    }
    
    $result = array( "data" => $data );

} elseif ( $type == 2 ) {

    // signup

    $data = [];

    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    
    $res = mysqli_query($con , $sql);

    if( mysqli_num_rows($res) > 0 ) {

        $data = [
            "status" => '0' ,
            "msg" => " Username already exist !!! "
        ];

    } else {

        $sql1 = "INSERT INTO `users`( `username`, `password`, `type`, `name`, `address`, `mobile`, `wallet`, `status`) VALUES ('$username','$password','1','$name','','$mobile','0','1')";
    
        $res1 = mysqli_query($con , $sql1);

        if($res1) {

            $id = mysqli_insert_id($con);

            $data = [
                "status" => '1' ,
                "id" => $id ,
                "msg" => " Signup Successful !!! " ,
                "name" => $name ,
                "mobile" => $mobile ,
                "type" => 1 ,
            ];

        } else {

            $data = [
                "status" => '0' ,
                "msg" => " Server error !!! "
            ];

        }

    }
    
    $result = array( "data" => $data );

} elseif ( $type == 3 ) {

    // fetch using product name or sku

    $sql = "SELECT `product_tb`.* , `product_var`.* FROM `product_tb` JOIN `product_var` ON `product_tb`.`id` = `product_var`.`product_id` WHERE `product_tb`.`product_nm` LIKE '%$product_nm%' OR `product_var`.`sku` LIKE '%$product_nm%'";

    $res = mysqli_query($con , $sql);

    $products = [];

    while( $row = mysqli_fetch_assoc($res) ) {
        array_push( $products , $row );

    }
    
    $result = array( "products" => $products );


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
    
    $result = array( "products" => $products );


} elseif ( $type == 5 ) {

    // fetch all product

    // $sql = "SELECT `product_tb`.* , `product_var`.* , GROUP_CONCAT(images_tb.image_name SEPARATOR' , ') as `imgs`  FROM `product_tb` JOIN `product_var` ON `product_tb`.`id` = `product_var`.`product_id` JOIN `images_tb` ON `product_var`.`id` = `images_tb`.`pid` GROUP BY `images_tb`.`pid`";

    $sql = "SELECT * FROM `product_var`";

    $res = mysqli_query($con , $sql);
    
    $products = [];
    
    while( $row = mysqli_fetch_assoc($res) ) {

        extract($row);

        $q1 = "SELECT GROUP_CONCAT(images_tb.image_name SEPARATOR' , ') as `imgs` FROM `images_tb` WHERE `pid` = '$id'";
        $r1 = mysqli_query($con , $q1);
        $i1 = mysqli_fetch_assoc($r1);

        $imgs = explode(' , ', $i1['imgs']);
        $row['imgs'] = $imgs;

        $q2 = "SELECT * FROM `product_tb` WHERE `id` = '$product_id'";
        $r2 = mysqli_query($con , $q2);
        $i2 = mysqli_fetch_assoc($r2);
        extract($i2);

        $row['product_nm'] = $product_nm;
        $row['product_cm'] = $product_cm;
        $row['cat_id'] = $cat_id;
        $row['description'] = $description;
        if($cat_id == -1) {
            $row['cat_nm'] = 'Uncategorised';
        } else {
            $sql3 = "SELECT `name` FROM `categories_tb` WHERE `id` = '$cat_id'";
            $res3 = mysqli_query($con , $sql3);
            $row3 = mysqli_fetch_assoc($res3);
            $row['cat_nm'] = $row3['name'];
        }
        array_push( $products , $row );
    
    }
        
    $result = array( "products" => $products );

} elseif ( $type == 6 ) {

    // add product

    $cat_id =  $category_option != '' ? $category_option : -1 ;

    $sql = "INSERT INTO `product_tb` (`product_nm`,`product_cm`,`cat_id`,`description`) VALUES ('$product_nm','$product_cm','$cat_id','$description')";

    $res = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);

    if( isset($keyword) && $keyword != '' ) {

        $sql = "INSERT INTO `keywords` (`product_nm`,`keyword`) VALUES ('$product_nm','$keyword')";
        $res = mysqli_query($con , $sql);
    
    }

    $sql = "INSERT INTO `product_var` (`product_id`, `type_name_1`, `type_qty_1`, `type_name_2`, `type_qty_2`, `fprice`, `price`, `sku` , `qty` , `gst` , `status` ) VALUES ('$pid', '$type_name_1', '$type_qty_1', '$type_name_2', '$type_qty_2', '$fprice', '$price', '$sku' , '$qty' , '$gst' , '1' )";
    $res = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);

    $sql = "INSERT INTO `stock` ( `pid`, `qty`, `price` ) VALUES ( '$pid', '0', '$price' )";
    $res = mysqli_query($con , $sql);

    $img_nm = "KA_PR_".date("Ymdhis").".jpg" ;
    $image = base64_to_jpeg( $ash , '../images/'.$img_nm );


    if($image) {
        $sql = "INSERT INTO `images_tb` (`pid`,`image_name`) VALUES ('$pid','$img_nm')";
        $res = mysqli_query($con , $sql);
    }


    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 7 ) {

    // add product when search

    $sql = "INSERT INTO `product_tb` ( `product_nm`,`product_cm`,`cat_id`,`description`) VALUES ('$product_nm','$product_cm','-1','$description')";

    $res = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);

    $sql = "INSERT INTO `product_var` ( `product_id`, `type_name_1`, `type_qty_1`, `type_name_2`, `type_qty_2`, `fprice`, `price`, `sku` , `qty` , `gst` , `status` ) VALUES ('$pid', '$type_name_1', '$type_qty_1', '$type_name_2', '$type_qty_2', '$fprice', '$price', '$sku' , '0' , '0' , '1')";

    $res = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);

    $sql = "INSERT INTO `stock` ( `pid`, `qty`, `price` ) VALUES ( '$pid', '0', '$price' )";

    $res = mysqli_query($con , $sql);

    $imgs = explode(",", $imgs);

    foreach ($imgs as $img_nm) {
        $sql = "INSERT INTO `images_tb` (`pid`,`image_name`) VALUES ('$pid','$img_nm')";
        $res = mysqli_query($con , $sql);
    } 


    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 8 ) {

    // add categories

    $parent_id =  $category_option != '' ? $category_option : 0 ;

    $img_nm = "KA_CAT_".date("Ymdhis").".jpg" ;
    $image = base64_to_jpeg( $ash , '../images/'.$img_nm );

    $sql = "INSERT INTO `categories_tb` (`parent_id`, `name`, `images`, `status`) VALUES ('$parent_id','$name','$img_nm','1')";

    $res = mysqli_query($con , $sql);

    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 9 ) {

    // load category list

    $tree = '';

    function categoryTree($parent_id = 0, $sub_mark = '') {
        global $con;
        global $tree;

        $sql = "SELECT * FROM `categories_tb` WHERE `parent_id` = $parent_id ORDER BY `name` ASC";
        $res = mysqli_query($con , $sql);       
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                $tree .= '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
                categoryTree($row['id'], $sub_mark.'--');
            }
        }
    }

    categoryTree();

    $category = [ "category" => $tree ];
    
    $result = array( "data" => $category );

} elseif ( $type == 10 ) {

    // fetch all categories

    $sql = "SELECT * FROM `categories_tb`";

    $res = mysqli_query($con , $sql);

    $category = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        extract($row);

        $sql1 = "SELECT `name` FROM `categories_tb` WHERE  `id` = '$parent_id' ";

        $res1 = mysqli_query($con , $sql1);
        
        $row1 = mysqli_fetch_assoc($res1);

        $parent_name = $row1['name'];

        $row['parent_name'] = $parent_id == 0 ? 'MAIN' : $parent_name;

        array_push( $category , $row );
        
    }
    
    $result = array( "category" => $category );


} elseif ( $type == 11 ) {

    // add categories by kalam-api

    $name = explode(",",$name);
    $images = explode(",",$images);

    for ( $i=0 ;  $i < count($name) ;  $i++ ) {

        $nm = $name[$i];
        $im = $images[$i];
        
        $sql = "INSERT INTO `categories_tb` (`parent_id`, `name`, `images`, `status`) VALUES ('0','$nm','$im','1')";

        $res = mysqli_query($con , $sql);   
    }

    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 12 ) {

    // enable or disable categories 

    $status = $status == 1 ? "0" : "1" ;

    $sql = "UPDATE `categories_tb` SET `status` = '$status' WHERE `id` = '$id'";

    $res = mysqli_query($con , $sql);   

    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 13 ) {

    // update categories 

    $qry = "";

    if($category_option != '') {
        $parent_id =  $category_option != '' ? $category_option : 0 ;
        $qry .= " , `parent_id` = '$parent_id' ";
    }

    if($category_option == '') {
        $qry .= " , `parent_id` = '0' ";
    }

    if($ash != '') {
        $img_nm = "KA_CAT_".date("Ymdhis").".jpg" ;
        $image = base64_to_jpeg( $ash , '../images/'.$img_nm );
        $qry .= " , `images` = '$img_nm' ";
    }

    $sql = "UPDATE `categories_tb` SET `name` = '$name' ". $qry ." WHERE `id` = '$c_id'";

    $res = mysqli_query($con , $sql);   

    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 14 ) {

    // get addons 

    $sql = "SELECT * FROM `addons`";

    $res = mysqli_query($con , $sql); 
    
    $data = [];

    while( $row = mysqli_fetch_assoc($res) ) {

        array_push( $data , $row );
        
    }
    
    $result = array( "addons" => $data );


} elseif ( $type == 15 ) {

    // purchase addons 
    
    $data = [];

    $sql = "SELECT `wallet` FROM `users` WHERE `username` = 'admin'";

    $res = mysqli_query($con , $sql);

    $row = mysqli_fetch_assoc($res);

    $wallet_balance = $row['wallet'];

    $new_wallet_balance = $wallet_balance - $price ;

    if( $new_wallet_balance >= 0) {

        $sql1 = "UPDATE `addons` SET `purchase_status` = '1' WHERE `id` = '$id'";

        $res1 = mysqli_query($con , $sql1);

        $sql2 = "UPDATE `users` SET `wallet` = '$new_wallet_balance' WHERE `username` = 'admin'";

        $res2 = mysqli_query($con , $sql2);

        if($res2) {

            $data = [
                "status" => "1" ,
                "msg" => "purchase successful" ,
                "wallet_balance" => $new_wallet_balance
            ];
        
        }
        
    } else {

        $data = [
            "status" => "0" ,
            "msg" => "insufficient wallet balance"
        ];
    }
    
    $result = array( "data" => $data );

} elseif ( $type == 16 ) {

    // get addon status api 
    
    $data = [];

    $sql = "SELECT `purchase_status` , `activation_status` FROM `addons` WHERE `name` = '$name' ";

    $res = mysqli_query($con , $sql);

    $row = mysqli_fetch_assoc($res);

    $purchase_status = $row['purchase_status'];

    $activation_status = $row['activation_status'];

    if( $purchase_status == 1 ) {

        if ( $activation_status == 1) {

            $data = [
                "status" => "1"
            ];

        } else {

            $data = [
                "status" => "0" ,
                "msg" => "You have not activated this plugin !!!"
            ];

        }
        
    } else {

        $data = [
            "status" => "0" ,
            "msg" => "You have not purchased yet !!!"
        ];
    }
    
    $result = array( "data" => $data );


} elseif ( $type == 17 ) {

    // update addon status enable / disable
    
    $data = [];

    $sql = "UPDATE `addons` SET `activation_status` = '$status'  WHERE `id` = '$id' ";

    $res = mysqli_query($con , $sql);

    if( $res ) {

        $data = [
            "status" => "1"
        ];
        
    } else {

        $data = [
            "status" => "0" ,
        ];
    }
    
    $result = array( "data" => $data );


} elseif ( $type == 18 ) {

    // update product status enable / disable
    
    $data = [];

    $status = $status == 1 ? 0 : 1 ;

    $sql = "UPDATE `product_var` SET `status` = '$status' WHERE `id` = '$id' ";

    $res = mysqli_query( $con , $sql );

    if( $res ) {

        $data = [
            "status" => "1"
        ];
        
    } else {

        $data = [
            "status" => "0" ,
        ];

    }
    
    $result = array( "data" => $data );

} elseif ( $type == 19 ) {

    // update product stock
    
    $data = [];

    $sql = "SELECT `qty` FROM `product_var` WHERE `id` = '$id' ";

    $res = mysqli_query( $con , $sql );

    $row = mysqli_fetch_assoc($res);

    $oldqty = $row['qty'];

    $updqty = $oldqty + $newqty ;

    $sql = "UPDATE `product_var` SET `qty` = '$updqty' , `price` = '$newShowPrice'  WHERE `id` = '$id' ";

    $res = mysqli_query( $con , $sql );

    $sql = "INSERT INTO `stock` ( `qty` , `price` , `pid` ) VALUES ( '$newqty' , '$newprice', '$id' ) ";

    $res = mysqli_query( $con , $sql );

    if( $res ) {

        $data = [
            "status" => "1"
        ];
        
    } else {

        $data = [
            "status" => "0" ,
        ];

    }
    
    $result = array( "data" => $data );

} elseif ( $type == 20 ) {

    // update admin info
    
    $data = [];

    $sql = "UPDATE `users` SET `name` = '$name' , `address` = '$address' , `mobile` = '$mobile'  WHERE `id` = '$id' ";

    $res = mysqli_query( $con , $sql );

    if( $res ) {

        $data = [ 
            "status" => "1" ,
            "name" => $name ,
            "address" => $address ,
            "mobile" => $mobile
        ];
        
    } else {

        $data = ["status" => "0"];

    }
    
    $result = array( "data" => $data );

} elseif ( $type == 21 ) {

    // update admin password
    
    $data = [];

    $sql = "UPDATE `users` SET `password` = '$password' WHERE `id` = '$id' ";

    $res = mysqli_query( $con , $sql );

    if( $res ) {

        $data = [ "status" => "1" ];
        
    } else {

        $data = ["status" => "0"];

    }
    
    $result = array( "data" => $data );

} elseif ( $type == 22 ) {

    // add product varient

    $sql = "INSERT INTO `product_var` (`product_id`, `type_name_1`, `type_qty_1`, `type_name_2`, `type_qty_2`, `fprice`, `price`, `sku` , `qty` , `gst` , `status` ) VALUES ('$product_id', '$type_name_1', '$type_qty_1', '$type_name_2', '$type_qty_2', '$fprice', '$price', '$sku' , '$qty' , '$gst' , '1' )";
    $res = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);

    $sql = "INSERT INTO `stock` ( `pid`, `qty`, `price` ) VALUES ( '$pid', '0', '$price' )";
    $res = mysqli_query($con , $sql);

    $img_nm = "KA_PR_".date("Ymdhis").".jpg" ;
    $image = base64_to_jpeg( $ash , '../images/'.$img_nm );


    if($image) {
        $sql = "INSERT INTO `images_tb` (`pid`,`image_name`) VALUES ('$pid','$img_nm')";
        $res = mysqli_query($con , $sql);
    }


    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );


} elseif ( $type == 23 ) {

    // add more product image

    $img_nm = "KA_PR_".date("Ymdhis").".jpg" ;
    $image = base64_to_jpeg( $ash , '../images/'.$img_nm );


    if($image) {
        $sql = "INSERT INTO `images_tb` (`pid`,`image_name`) VALUES ('$pid','$img_nm')";
        $res = mysqli_query($con , $sql);
    }


    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );

} elseif ( $type == 24 ) {

    // update product details

    $sql = "UPDATE `product_var` SET `type_name_1`='$type_name_1',`type_qty_1`='$type_qty_1',`type_name_2`='$type_name_2',`type_qty_2`='$type_qty_2',`fprice`='$fprice',`price`='$price',`sku`='$sku',`gst`='$gst' WHERE `id` = '$pid'";
    $res = mysqli_query($con , $sql);

    if($category_option != '') {
        $sql = "UPDATE `product_tb` SET `cat_id`='$category_option' WHERE `id` = '$product_id'";
        $res = mysqli_query($con , $sql);
    }

    $sql = "UPDATE `product_tb` SET `product_nm`='$product_nm',`product_cm`='$product_cm',`description`='$description' WHERE `id` = '$product_id'";
    $res = mysqli_query($con , $sql);


    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );

} elseif ( $type == 25 ) {

    // show all product details
    
    $data = [];

    $sql = "SELECT * FROM `images_tb` WHERE `pid` = '$pid'";
    $res = mysqli_query($con , $sql);
    if(mysqli_num_rows($res)>0) {

        while($row = mysqli_fetch_assoc($res)){
            array_push($data,$row);
        }

    }

    if($res)
        $result = array( "status" => "1" , "data" => $data );
    else
        $result = array( "status" => "0" );

} elseif ( $type == 26 ) {

    // Delete product image
        
    $sql = "DELETE FROM `images_tb` WHERE `id` = '$id'";
    
    $res = mysqli_query($con , $sql);

    if (file_exists('../images/'.$image_name)) {
        unlink('../images/'.$image_name);
    }    

    if($res)
        $result = array( "status" => "1" );
    else
        $result = array( "status" => "0" );

} else {

}

echo json_encode($result);

?>