<form action="<?php echo $current_page . '?' . $variables_in_URL; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Update category</label>
        <input class="form-control" type="text" name="updated_cat_title" value="<?php if(isset($update_this_cat_title)) { echo $update_this_cat_title; } ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_this_cat" value="Update Category">
    </div>
</form>

