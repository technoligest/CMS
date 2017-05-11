<!-- Create new category -->
<form action="manage_categories.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cat_title">Add new category</label>
        <input class="form-control" type="text" name="cat_title">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
    </div>
</form>