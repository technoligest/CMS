
<table class="table table-striped">
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Modify</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql="SELECT * FROM categories";
        $stmt = $conn->query($sql);
        while($row=$stmt->fetch_assoc()){
            echo "
                <tr>
            <td>{$row['cat_title']}</td>
            <td ><a class=\"btn btn-info\" href=\"update_category={$row['cat_id']}\">Modify</a>
            </td>
                <td ><a class=\"btn btn-danger\" href=\"manage_categories.php?delete_category={$row['cat_id']}\">Delete</a></td>
        </tr>
                ";
        }
        ?>
    </tbody>
</table>