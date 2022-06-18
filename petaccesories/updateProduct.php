<?php
include('./templates/PHPScripts.php');


if (!Admin::check() && !User::check()) {
    header("location: ./login.php");
}

$productId = $_POST['product_id'];
$product = Product::getProduct($_POST['product_id']);
$brands = Brand::viewAll();
$categories = Category::viewAll();

if (isset($_POST['updateImg'])) {
    Product::updateImg($product['id'], $product["image"], $_FILES["image"]);
}

if (isset($_POST['updateInfo'])) {
    Product::updateInfo($product['id'], $_POST["name"], $_POST["brandId"], $_POST["categoryId"], $_POST["description"], $_POST["price"], $_POST["quantity"]);
}

?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <div class="container p-3">
        <h2>Update Product Picture</h2>
        <div class="card mb-3">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <input type="text" name="product_id" value="<?= $productId ?>" hidden>

                <div class="card-body">
                    <div class="row g-3">
                        <div>
                            <label for="productImage" class="form-label">Product Image</label>
                            <input name="image[]" class="form-control" type="file" id="productImage" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer row g-0 justify-content-end">
                    <input type="submit" name="updateImg" class="btn myFilledCustomBtn2 w-25" value="Update">
                </div>
            </form>
        </div>

        <h2>Update Product Info</h2>
        <div class="card mb-3">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="product_id" value="<?= $productId ?>" hidden>

                <div class="card-body">
                    <div class="row g-3">
                        <div>
                            <label for="productName" class="form-label">Product Name</label>
                            <input name="name" type="text" class="form-control" id="productName" value="<?= $product['name'] ?>" required>
                        </div>

                        <div>
                            <label for="productBrand" class="form-label">Product Brand</label>
                            <select name="brandId" class="form-select" id="productBrand" required>
                                <?php foreach ($brands as $brand) : ?>
                                    <option value="<?= $brand['id'] ?>" <?php if ($product['brand_id'] == $brand['id']) echo "selected" ?>><?= $brand['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div>
                            <label for="productCategory" class="form-label">Product Category</label>
                            <select name="categoryId" class="form-select" id="productCategory" required>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>" <?php if ($product['category_id'] == $category['id']) echo "selected" ?>><?= $category['category'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div>
                            <label for="productDescription" class="form-label">Product Description</label>
                            <textarea name="description" class="form-control" style="height: 100px" placeholder="Size: XL&#10;weight: 2Kg&#10;Color: Blue&#10;height: 60cm" id="productDescription" required><?= $product['description'] ?></textarea>
                        </div>

                        


                        <div class="col-sm-6">
                            <label for="price" class="form-label">Product Price</label>
                            <div class="input-group mb-3">
                                <input name="price" type="number" class="form-control" id="price" aria-describedby="price" step="0.01" value="<?= $product['price'] ?>" required>
                                <span class="input-group-text">JOD</span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="productQuantity" class="form-label">Product Quantity</label>
                            <input name="quantity" type="number" class="form-control" name="productQuantity" id="productQuantity" value="<?= $product['quantity'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="card-footer row g-0 justify-content-end">
                    <input type="submit" name="updateInfo" class="btn myFilledCustomBtn2 w-25" value="Update">
                </div>
            </form>
        </div>
    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php'); ?>
    <!-- JS Scripts -->
</body>

</html>