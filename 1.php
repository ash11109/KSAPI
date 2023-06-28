<?php
include('inc/connection.php');

switch ($_REQUEST['rt']) {
    case 1:
        $pn = $_REQUEST['pn'];
        $pc = $_REQUEST['pc'];
        $pdc = $_REQUEST['pdc'];
        $catid = $_REQUEST['catid'];
        $kwd = $_REQUEST['kwd'];
        $sql = "INSERT INTO `product_tb` (`product_nm`,`product_cm`,`cat_id`,`description`) VALUES ('$pn','$pc','$catid','$pdc')";
        $res = mysqli_query($db,$sql);
        $sql1 = "INSERT INTO `keywords` (`product_nm`,`keyword`) VALUES ('$pn','$kwd')";
        $res1 = mysqli_query($db,$sql1);
        if($res1) {
            echo 'product added';
        }
        else {
            echo 'error';
        }
        break;
    case 2:
        $pi = $_REQUEST['pi'];
        $pr = $_REQUEST['pr'];
        $fpr = $_REQUEST['fpr'];
        $tn1 = $_REQUEST['tn1'];
        $tq1 = $_REQUEST['tq1'];
        $tn2 = $_REQUEST['tn2'];
        $tq2 = $_REQUEST['tq2'];
        $sku = $_REQUEST['sku'];
        $sql2 = "INSERT INTO `product_var` (`product_id`,`type_name_1`,`type_qty_1`,`type_name_2`,`type_qty_2`,`price`,`fprice`,`sku`) VALUES ('$pi','$tn1','$tq1','$tn2','$tq2','$pr','$fpr','$sku')";
        $res2 = mysqli_query($db,$sql2);
        if($res2) {
            echo 'product variant added';
        }
        else {
            echo 'error';
        }
        break;
    case 3:

        function base64_to_jpeg($base64_string, $output_file) {
            $ifp = fopen( $output_file, 'wb' ); 
            $data = explode( ',', $base64_string );
            fwrite( $ifp, base64_decode( $data[ 1 ] ) );
            fclose( $ifp ); 
            return $output_file; 
        }

        $nm = "KA".date("Ymdhis").".jpg" ;
        $image = base64_to_jpeg( $_REQUEST["ash"], 'API/images/'.$nm );
        $pid = $_REQUEST["pid"];

        if($image) {
            $sql = "INSERT INTO `images_tb` (`pid`,`image_name`) VALUES ('$pid','$nm')";
            $res = mysqli_query($db, $sql);
            if ($res) {
                echo 'Iamge Added';
            } else {
                echo 'error';
            }
        }

        break;
    case 4:
            $pid = $_REQUEST['pid'];
            $nm = $_REQUEST['nm'];
            $sql = "INSERT INTO `categories_tb` (`parent_id`,`name`) VALUES ('$pid','$nm')";
            $res = mysqli_query($db, $sql);
            if ($res) {
                echo 'category added';
            } else {
                echo 'error';
            }
            break;
    default:
        echo 'error';
}
?>