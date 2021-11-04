<?php 
    $obj_adminBack = new adminBack();
    $product_info = $obj_adminBack-> display_product();
    if(isset($_GET['prostatus'])){
        $proid = $_GET['id'];
        if($_GET['prostatus']=='delete'){
            $msg = $obj_adminBack->delete_product($proid);
        }
    }
    
?>
<h1>Manage Product</h1>
<?php
    if(isset($msg)){
        ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   <?php echo $msg; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
    }
?>
<table class="table table-bordered">
    <thead>
        <th>ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Image</th>
        <th>Category</th>
        <th>Status</th>
        <th>Update/Delete</th>
    </thead>
    <tbody>
        <?php 
            while($product = mysqli_fetch_assoc($product_info)){

        ?>
        <tr>
            <td><?php echo $product['pdt_id']; ?></td>
            <td><?php echo $product['pdt_name']; ?></td>
            <td><?php echo $product['pdt_price']; ?></td>
            <td><?php echo $product['pdt_des']; ?></td>
            <td><img style="height: 50px;" src="upload/<?php echo $product['pdt_image']; ?>"></td>
            <td><?php echo $product['ctg_name']; ?></td>
            <td><?php 
                if($product['pdt_status'] == 1){
                    ?>
                <a href="" class="btn btn-secondary btn-sm">Published</a>
                <?php 
                }else{
                    ?>
                <a href="" class="btn btn-success btn-sm">Unpublished</a>
                <?php
                }
            ?>
            </td>
            <td>
                <a href="edit_product.php?prostatus=edit&&id=<?php echo $product['pdt_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                <a href="?prostatus=delete&&id=<?php echo $product['pdt_id']; ?>"
                    class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>