$(document).ready(function () {

    $('.summernote').summernote();
    
    // add product
    $("#add").on("click",function (){
        var pn = $("#pn").val();
        var pc = $("#pc").val();
        var pdc = $("#pdc").val();
        var catid = $("#catid").val();
        var kwd = $("#kwd").val();
        $.ajax({
            url : "1.php",
            type : "POST",
            data : {rt:1,pn:pn,pc:pc,pdc:pdc,catid:catid,kwd:kwd},
            success : function (r) {
                alert(r);
                location.href = "index.php";
            }
        });
    });

    // add variant
    $("#add1").on("click",function (){
        var pi = $("#pi").val();
        var pr = $("#pr").val();
        var fpr = $("#fpr").val();
        var tn1 = $("#tn1").val();
        var tn2 = $("#tn2").val();
        var tq1 = $("#tq1").val();
        var tq2 = $("#tq2").val();
        var sku = $("#sku").val();

        $.ajax({
            url : "1.php",
            type : "POST",
            data : { rt:2 , pi:pi , pr:pr , tn1:tn1 , tn2:tn2 , tq1:tq1 , tq2,tq2 , sku:sku , fpr:fpr },
            success : function (r) {
                alert(r);
                location.href = "sap.php";
            }
        });
    });

    // add category
    $("#addCat").on("click",function(){
        var nm = $("#name").val();
        var pid = $("#pid").val();
        $.ajax({
            url : "1.php",
            type : "POST",
            data : { rt:4, pid:pid, nm:nm },
            success : function (r) {
                alert(r);
                location.href = "catAdd.php";
            }
        });
    });

    // add iamge
    $("#abhi").submit( function(e) {
        e.preventDefault();
        const pid = $("#pid").val();
        var formData = new FormData(this);
        formData.append("ash", ash);
        formData.append("rt", 3);
        formData.append("pid", pid);
        $.ajax({
            url : "1.php",
            method : "POST",
            data : formData ,
            processData : false ,
            contentType : false ,
            success : function (data) {
                alert(data);
                location.href = "sap.php";
            } 
        });
    });

});