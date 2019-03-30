<!--	List Product	-->
<?php
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
    $arr_keyword = explode(" ",$keyword);
    $str_keyword = "%".implode("%",$arr_id)."%";
    $sql = "SELECT * FROM product WHERE prd_name LIKE '$str_id'";
    $query = mysqli_query($connect,$sql);
    $num = mysqli_num_rows($query);
   }
?>
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword;?></span></div>
    <?php
    $i=1;
    while($row = mysqli_fetch_array($query)){   
        if($i==1){
            echo '<div class="product-list card-deck">';
        } 
    ?>
        <div class="product-item card text-center">
            <a href="#"><img src="admin/img/product/<?php echo $row['prd_image']?>"></a>
            <h4><a href="#"><?php echo $row['prd_name'];?></a></h4>
            <p>Giá Bán: <span><?php echo $row['prd_price'];?></span></p>
        </div>
    <?php
    if($i==3){
        echo '</div>';
        $i = 0;
    }
    $i++;
    }
    if($num%3 != 0){
        echo '</div>';
    }
    ?>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul> 
</div>
