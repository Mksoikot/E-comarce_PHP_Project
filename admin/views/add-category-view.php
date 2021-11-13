<?php
    $obj_adminBack = new adminBack();
    if(isset($_POST['ctg_btn'])){
        $return_mesg=$obj_adminBack->add_category($_POST);
    }
?>
<?php
    if(isset($return_mesg)){
        ?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo $return_mesg; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <?php 
    }
?>
<h3>Add Category</h3>
<form action="" method="post">
    <div class="form-group">
        <label for="ctg_name">Category Name</label>
        <input type="text" name="ctg_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ctg_dess">Category Desscription</label>
        <input type="text" name="ctg_dess" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="ctg_status">Category Status</label>
        <select name="ctg_status" class="form-control" required>
            <option value="1">Published</option>
            <option value="0">Unpublished</option>
        </select>
    </div>
    <input type="submit" value="Add Category" name="ctg_btn" class="btn btn-primary">
</form>