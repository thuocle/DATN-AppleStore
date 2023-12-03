<?php include('./config/database_connection.php'); ?> 
    <script src="./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/js/jquery-1.10.2.min.js"></script>
    <script src="./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/js/jquery-ui.js"></script>
    <script src="./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/css/bootstrap.min.css"> -->
    <link href = "./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="./advance-ajax-php-product-search-filter/advance-ajax-php-product-search-filter/css/style.css" rel="stylesheet">
        <div class="row">
        	<br />
            <div class="col-md-3 p-lg-5" >                				
				<div class="list-group">
					<h3>Giá</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000000" />
                    <p id="price_show">1000000 - 65000000</p>
                    <div id="price_range"></div>
                </div>				
                <div class="list-group">
					<h3>Màn hình</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT(KichThuoc) FROM sanpham ORDER BY MaSanPham DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector inches" value="<?php echo $row['KichThuoc']; ?>"  > <?php echo $row['KichThuoc']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
                <div class="list-group">
					<h3>Màu sắc</h3>
					<?php
                    $query = "SELECT DISTINCT(MauSac) FROM optionproduct ORDER BY MauSac DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                   <div class="list-group-item checkbox">
    <label>
        <input type="checkbox" class="common_selector color" value="<?php echo $row['MauSac']; ?>">
        <p style="color: <?php echo $row['MauSac'] == 'white' ? 'black' : 'white'; ?>;
                 width: 50px;
                 padding: 5px;
                 font-size: 10px;
                 line-height: 10px;
                 height: 20px;
                 background-color: <?php echo $row['MauSac'] == 'white' ? 'beige' : $row['MauSac']; ?>;">
            <?php echo strtoupper($row['MauSac']); ?>
        </p>
    </label>
</div>

                    <?php
                    }
                    ?>	
                </div>
				<div class="list-group">
					<h3>Phiên bản</h3>
					<?php
                    $query = "SELECT DISTINCT(BoNho) FROM optionproduct ORDER BY BoNho DESC
                    ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="<?php echo $row['BoNho']; ?>"  > <?php echo $row['BoNho']; ?> GB</label>
                    </div>
                    <?php
                    }
                    ?>	
                </div>
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var inches = get_filter('inches');
        var color = get_filter('color');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, inches:inches, color:color, storage:storage},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:1000000,
        max:65000000,
        values:[1000000, 65000000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>