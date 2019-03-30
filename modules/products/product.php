<!--	List Product	-->
<?php
$prd_id = $_GET['prd_id'];
$sql ="SELECT * FROM product WHERE prd_id =$prd_id"; 
$query = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($query);

?>
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="images/product-1.png">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row['prd_name'];?></h1>
            <ul>
                <li><span>Bảo hành:</span><?php echo $row['prd_name'];?></li>
                <li><span>Đi kèm:</span><?php echo $row['prd_accessories'];?></li>
                <li><span>Tình trạng:</span><?php echo $row['prd_new'];?></li>
                <li><span>Khuyến Mại:</span><?php echo $row['prd_promotion'];?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo $row['prd_price'];?></li>
                <li id="status"><?php if($row['prd_status']==1){echo "Còn Hàng";}else{echo "Hết Hàng";}?></li>
            </ul>
            <div id="add-cart"><a href="modules/cart/add_cart.php?prd_id=<?php echo $row['prd_id'];?>">Mua ngay</a></div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row['prd_name'];?></h3>
            <?php echo $row['prd_details'];?>
        </div>
    </div>
    
    <!--	Comment	-->
<?php
if(isset($_POST['sbm'])){
$comm_name = $_POST['comm_name'];
$comm_mail = $_POST['comm_mail'];
$comm_details = $_POST['comm_details'];

date_default_timezone_set('Asia/Bangkok');
$comm_date = date('Y-m-d H:i:s');

$sql = "INSERT INTO comment (comm_name,comm_mail,comm_details,comm_date,prd_id)
VALUES ('$comm_name','$comm_mail','$comm_details','$comm_date','$prd_id')";
$query = mysqli_query($connect,$sql);


}
?>


    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>     
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form> 
        </div>
    </div>
    <!--	End Comment	-->  
    
    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
        <?php
        $sql="SELECT * FROM comment WHERE prd_id = $prd_id ORDER BY comm_id DESC";
        $query = mysqli_query($connect,$sql);
        while($row = mysqli_fetch_array($query)){?>
        <div class="comment-item">
                <ul>
                    <li><b><?php echo $row['comm_name'];?></b></li>
                    <li><?php echo $row['comm_date'];?></li>
                    <li>
                        <p><?php echo $row['comm_details'];?></p>
                    </li>
                </ul>
            </div>
        <?php
        }
        ?>
            
            
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	--> 
<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul> 
</div> 