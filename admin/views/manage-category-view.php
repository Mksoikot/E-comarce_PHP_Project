<?php 
    $obj_adminBack = new adminBack();
    $ctg_data = $obj_adminBack->display_category();
?>

<h3>Manage Category</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Category Desscription</th>
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
                    <a class="btn btn-primary" href="">Update</a>
                    <a class="btn btn-danger" href="">Delete</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>

</table>