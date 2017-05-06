<?php
$current_page = basename($_SERVER['PHP_SELF']);
$sql = "SELECT * FROM categories WHERE cat_parent IS NULL";
$retrieve_category_result = $conn->query($sql);
if ($retrieve_category_result && $retrieve_category_result->num_rows > 0) {
    $i = 0;

    ?>

    <div class="col-md-4 col-sm-12">
        <?php
        for (; $i < ($retrieve_category_result->num_rows) / 3; ++$i) {
            echo printCategory($retrieve_category_result->fetch_assoc(), $conn);
        }

        ?>
    </div>
    <div class="col-md-4 col-sm-12">
        <?php
        for (; $i < ($retrieve_category_result->num_rows) * 2 / 3; ++$i) {
            echo printCategory($retrieve_category_result->fetch_assoc(), $conn);
        }
        ?>
    </div>
    <div class="col-md-4 col-sm-12">
        <?php
        for (; $i < ($retrieve_category_result->num_rows); ++$i) {
            echo printCategory($retrieve_category_result->fetch_assoc(), $conn);
        }
        ?>
    </div>

    <?php
} else {
    echo "Nothing to show";
}
function printCategory($row, $conn)
{
    $return = "";
    $return .= "<div class =\"list-group\">";
    $return .= "<a class='list-group-item active' href=\"search.php?cat_id={$row['cat_id']}\"><h4>{$row['cat_title']}</h3></a>";
    $sql = "SELECT * FROM categories WHERE cat_parent='{$row['cat_id']}'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $return .= "<a class=\"list-group-item\" href=\"search.php?cat_id={$row['cat_id']}\">";
        $return .= $row['cat_title'];
        $return .= "</a>";
    }
    $return .= "</div><br>";
    return $return;
}

?>