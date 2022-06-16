<?php
include('./templates/PHPScripts.php');

if (!Admin::check()) {
    header("location: ./login");
}

$products = Product::getAllProducts();
$brands = Brand::viewAll();
$categories = Category::viewAll();

if (isset($_POST['addProduct'])) {
    Product::add($_POST["brandId"], $_POST["categoryId"], $_POST["name"], $_FILES["image"], $_POST["description"], $_POST["price"], $_POST["quantity"]);
}

if (isset($_POST['deactivate'])) {
    Product::deactivate($_POST['product_id']);
}
if (isset($_POST['activate'])) {
    Product::activate($_POST['product_id']);
}

if (isset($_POST['deleteProduct'])) {
    Product::delete($_POST['product_id'], $_POST['imagePath']);
}

if (isset($_GET['search'])) {
    $products = Product::search($_GET['searchValue']);
}

?>


<!DOCTYPE html>
<html lang="en" dir="auto">

<?php include('./templates/head.php') ?>

<body>
    <!-- Navbar -->
    <?php include('./templates/adminNav.php') ?>
    <!-- Navbar -->

    <div class="container py-3">
        <?php echo $error; ?>
        <?php echo $success; ?>

        <div class="row g-0 justify-content-between align-items-center">
            <h3 class="mb-0" style="width: fit-content;">Manage Products</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn myFilledCustomBtn2" style="width: fit-content;" data-bs-toggle="modal" data-bs-target="#product">
                + New Product
            </button>
        </div>
        <hr class="myCustomHr">

        <!-- Search Box -->
        <form class="col-md-9 input-group align-self-start p-3 bg-light border-0" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <input type="search" name="searchValue" class="form-control p-2" style="width:50%;" placeholder="Search Product" <?php if (isset($_GET['search'])) echo "value={$_GET['searchValue']}" ?>>
            <input type="submit" name="search" class="form-control btn myFilledCustomBtn2 shadow-sm" style="width: fit-content;" value="Search">
        </form>
        <!-- Search Box -->

        <!-- Modal -->
        <div class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Form -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div>
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input name="name" type="text" class="form-control" id="productName" required>
                                </div>
                                <div>
                                    <label for="productImage" class="form-label">Product Image</label>
                                    <input name="image[]" class="form-control" type="file" id="productImage" required>
                                </div>

                                <div>
                                    <label for="productCategory" class="form-label">Product Category</label>
                                    <select name="categoryId" class="form-select" id="productCategory">
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div>
                                    <label for="productBrand" class="form-label">Product Brand</label>
                                    <select name="brandId" class="form-select" id="productBrand">
                                        <?php foreach ($brands as $brand) : ?>
                                            <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div>
                                    <label for="productDescription" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control" placeholder="Size: XL&#10;weight: 2Kg&#10;Color: Blue&#10;height: 60cm" id="productDescription" style="height: 100px" required></textarea>
                                </div>

                                <div class="col-sm-6">
                                    <label for="price" class="form-label">Product Price</label>
                                    <div class="input-group mb-3">
                                        <input name="price" type="number" class="form-control" id="price" aria-describedby="price" step="0.01" required>
                                        <span class="input-group-text">JOD</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="productQuantity" class="form-label">Product Quantity</label>
                                    <input name="quantity" type="number" class="form-control" name="productQuantity" id="productQuantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="addProduct" class="btn myFilledCustomBtn2">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row p-3 g-0 justify-content-center bg-light" style="max-height: 100vh; overflow-y: auto;">
            <?php foreach ($products as $product) : ?>
                <div class="card m-2 col-md-5">
                    <?= $product['active'] ? "<h5 class='p-3 m-0 text-success text-center'>Active</h5>" : "<h5 class='p-3 m-0 text-danger text-center'>Not Active</h5>"; ?>
                    <img class="card-img-top categories" src="<?= $product['image'] ?>" style="height: 300px;">
                    <div class="card-body">
                        <h3 class="card-title"><?= $product['name'] ?></h3>
                        <p><strong>Brand:</strong> <?= Brand::getBrandName($product['brand_id']) ?></p>
                        <p><strong>Category:</strong> <?= Category::getCategory($product['category_id']) ?></p>
                        <p><strong>Description:</strong> <?= $product['description'] ?></p>
                        <p><strong>price:</strong> <?= $product['price'] ?> JOD</p>
                        <p><strong>In Stock:</strong> <?= $product['quantity'] ?></p>
                        <p><strong>sold:</strong> <?= $product['sold'] ?> times</p>
                    </div>
                    <div class="card-footer">
                        <p>Added at: <?= date("d/m/Y", strtotime($product['created_at'])) ?></p>
                        <div class="row g-1">
                            <form class="col" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="text" name="product_id" value="<?= $product['id'] ?>" hidden>
                                <input type="text" name="imagePath" value="<?= $product['image'] ?>" hidden>
                                <button name="deleteProduct" onclick="return confirm('Are you sure you want to delete <?= $product['name'] ?> product?')" type="submit" class="btn btn-outline-danger w-100 ">Delete</button>
                            </form>

                            <?php if ($product['active']) : ?>
                                <form class="col" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="text" name="product_id" value="<?= $product['id'] ?>" hidden>
                                    <button name="deactivate" type="submit" class="btn btn-danger w-100 ">Deactivate</button>
                                </form>
                            <?php else : ?>
                                <form class="col" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="text" name="product_id" value="<?= $product['id'] ?>" hidden>
                                    <button name="activate" type="submit" class="btn btn-success w-100 ">Activate</button>
                                </form>
                            <?php endif ?>

                            <form class="col" action="updateProduct.php" method="post">
                                <input type="text" name="product_id" value="<?= $product['id'] ?>" hidden>
                                <button type="submit" class="btn myFilledCustomBtn2 w-100 ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>

    <!-- JS Scripts -->
    <?php include('./templates/jsScripts.php') ?>
    <!-- JS Scripts -->
</body>

</html>