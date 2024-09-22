<div class="container">
<table class="table table-striped">
    <thead>
        <tr>
            <th>S.N.</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Unit Price</th>
        </tr>
    </thead>
    <?php
        include_once "../config/dbconnect.php";
        $ID= $_GET['orderID'];
        //echo $ID;
        $sql="SELECT * from order_products op, orders_info o where o.order_id=op.order_id AND o.order_id=$ID";
        $result=$conn-> query($sql);
        $count=1;
        if ($result-> num_rows > 0){
            while ($row=$result-> fetch_assoc()) {
                $p_id=$row['product_id'];
    ?>
                <tr>
                    <td><?=$count?></td>
                    <?php
                       $subqry="SELECT * from products p
                       where  p.product_id=$p_id";
                       $res=$conn-> query($subqry);
                       if($row2 = $res-> fetch_assoc()){
                    ?>
                    <td><img height="80px" src="<?=$row2["product_image"]?>"></td>
                    <td><?=$row2["product_title"] ?></td>

                    <?php
                        }

                        $subqry2="SELECT * from brands b, products p
                        where b.brand_id=p.product_brand AND p.product_id=$p_id";
                        $res2=$conn-> query($subqry2);
                        if($row3 = $res2-> fetch_assoc()){
                        ?>
                    <td><?=$row3["brand_title"] ?></td>
                    <?php
                        }
                    ?>
                    <td><?=$row["qty"]?></td>
                    <td><?=$row["amt"]?></td>
                </tr>
    <?php
                $count=$count+1;
            }
        }else{
            echo "error";
        }
    ?>
</table>
</div>
