<?php
require_once '../../includes/database_conn.php';

if (isset($_POST['category_id'])) {
    $categoryId = $_POST['category_id'];

    $getSubcategory = mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = '$categoryId'");

    if (mysqli_num_rows($getSubcategory) != 0) {
?>
        <span>Product Subcategory</span>
        <select name="subcategory-list" id="subcategory-list">
            <option value="none" value="SELECT SUBCATEGORY" selected="selected">SELECT SUBCATEGORY</option>
            <?php
            foreach ($getSubcategory as $subcategoryRow) {
            ?>
                <option value="<?php echo $subcategoryRow['subcategory_id']; ?>"><?php echo $subcategoryRow['subcategory_title']; ?></option>
            <?php
            }
            ?>
        </select>
<?php
    } else {
        echo 'empty';
    }
}
?>