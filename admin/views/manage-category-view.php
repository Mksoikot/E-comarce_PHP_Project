<?php 
    $obj_adminBack = new adminBack();
    $ctg_data = $obj_adminBack->display_category();

    if(isset($_GET['status'])){
        $get_id = $_GET['id'];
        if($_GET['status']=="published"){
            $obj_adminBack->published_category($get_id);
        }elseif($_GET['status']=="unpublished"){
            $obj_adminBack->unpublished_category($get_id);
        }elseif($_GET['status']=="delete"){
            $msg = $obj_adminBack->delete_category($get_id);
        }
    }
?>

<h3>Manage Category</h3>
<?php
    if(isset($msg)){
        ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
        <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Category Desscription</th>
            <th>Status</th>
            <th>Update/Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($ctg = mysqli_fetch_assoc($ctg_data)){
        ?>
        <tr>
            <td><?php echo $ctg['ctg_id'] ?></td>
            <td><?php echo $ctg['ctg_name'] ?></td>
            <td><?php echo $ctg['ctg_dess'] ?></td>
            <td>
                <?php 
                    if($ctg['ctg_status']==0){
                        echo "Unpublished";
                    ?>
                <a class="btn btn-sm btn-success" href="?status=published&&id=<?php echo $ctg['ctg_id'] ?>">Make
                    Published</a>
                <?php 
                    }else{
                        echo "Published";
                    ?>
                <a class="btn btn-sm btn-danger" href="?status=unpublished&&id=<?php echo $ctg['ctg_id'] ?>">Make
                    Unpublished</a>
                <?php 
                    }
                  ?>
            </td>
            <td>
                <a class="btn btn-primary" href="edit-cat.php?status=edit&&id=<?php echo $ctg['ctg_id'] ?>">Edit</a>
                <a class="btn btn-danger" href="?status=delete&&id=<?php echo $ctg['ctg_id'] ?>">Delete</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>

</table>