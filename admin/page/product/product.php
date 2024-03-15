<?php

class products
{
    public function getList()
    {
        $db = new connect();
        $query = 'SELECT * FROM products'; //viết câu lệnh sql select *
        $result = $db->pdo_query($query);
        return $result;
    }

    public function getWomanProductCategory($categoryID)
    {
        $db = new connect();
        $query = "SELECT productId, name FROM products WHERE categoryId = $categoryID AND gender = 'Nữ' AND status='Active' ";
        $result = $db->pdo_query($query);
        return $result;
    }

    public function getMenProductCategory($categoryID)
    {
        $db = new connect();
        $query = "SELECT productId, name FROM products WHERE categoryId = $categoryID AND gender = 'Nam' AND status='Active' ";
        $result = $db->pdo_query($query);
        return $result;
    }


    public function getListLimitPR()
    {
        $db = new connect();
        $query = 'select * from products limit 3';
        $result = $db->pdo_qu + ery($query);
        return $result;
    }

    public function getById($productId)
    {
        $db = new connect();
        $query = 'select * from products where productId =' . $productId;
        $result = $db->pdo_query_one($query);
        return $result;
    }

    public function add($name, $priceSale, $price, $description, $categoryId, $image, $status, $gender)
    {
        $db = new connect();
        $query = "INSERT INTO products (`name`, `priceSale`, `price`, `image`, `description`, `categoryId`, `status`, `gender`) VALUES ('$name', '$priceSale', '$price', '$image', '$description', '$categoryId', '$status', '$gender')";
        $result = $db->pdo_execute($query);
        return $result;
    }

    public function update($productId, $name, $priceSale, $price, $description, $categoryId, $image, $status, $gender)
    {
        $db = new connect();
        $query = "UPDATE products SET 
        name = '$name',
        image = '$image', 
        price = '$price', 
        priceSale = '$priceSale',
        description = '$description', 
        categoryId = '$categoryId',
        status = '$status',
        gender = '$gender'
        where productId = '" . $productId . "'";
        $result = $db->pdo_execute($query);
        return $result;
    }

    function getInfoProduct($productId, $column)
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE productId  = $productId";
        $result = $db->pdo_query($sql);
        foreach ($result as $row) {
            return $row[$column];
        }
    }

    public function delete($product_id)
    {
        $db = new connect();
        $query = "DELETE FROM products WHERE product_id = '$product_id'";
        $result = $db->pdo_query_one($query);
        return $result;
    }

    public function getStatus($productId)
    {
        $db = new connect();
        $query = "SELECT Status FROM Products WHERE productId = $productId";
        $result = $db->pdo_query($query);
        return $result;
    }


    public function getStatusActive()
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE status = 'Active'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function hiddenActive($productId)
    {
        $db = new connect();
        $sql = "update products set status = 'Inactive' where productId = '$productId'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function getStatusInactive()
    {
        $db = new connect();
        $sql = "SELECT * FROM products WHERE status = 'Inactive'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function hiddenInactive($productId)
    {
        $db = new connect();
        $sql = "update products set status = 'Active' where productId = '$productId'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function getList_DESC()
    {
        $db = new connect();
        $select = "select * from products ORDER BY product_id DESC";
        $result = $db->pdo_query($select);
        return $result;
    }

    public function searchProduct($name)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE name LIKE '%$name%'";
        $result = $db->pdo_query($select);
        return $result;
    }

    public function thongKe()
    {
        $db = new connect();
        $sql = 'SELECT categories . *, COUNT(`products`.categoryId) AS total FROM products 
        INNER JOIN categories ON `products`.categoryId = `categories`.categoryId GROUP BY `products`.categoryId;';
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function renderCategorySelect()
    {
        $db = new connect();
        $query = "SELECT * FROM categories";
        $result = $db->pdo_query($query);

        $output = '<select style="margin: 0 auto" name="category" class="form-control" id="">';
        $output .= '<option selected value="">Chọn danh mục</option>';

        foreach ($result as $row) {
            $output .= '<option value="' . $row['categoryId'] . '">' . $row['name'] . '</option>';
        }

        $output .= '</select>';

        return $output;
    }

    public function getProductByName($name)
    {
        $db = new connect();
        $query = "SELECT * FROM products WHERE `name` = '$name'";
        $result = $db->pdo_query_one($query);
        return $result;
    }


    public function displayProducts()
    {
        $db = new connect();
        $query = "SELECT * FROM Products";
        $result = $db->pdo_query($query);

        $count = 0;
        $output = '';

        foreach ($result as $row) {
            if ($count >= 0) {
                // Process data
                $id = $row['productId'];
                $name = $row['name'];
                $img = $row['image'];
                $price = $row['price'];
                $priceSale = $row['priceSale'];
                $discountPercentage = '';

                if (!empty($priceSale) && $priceSale > $price) {
                    $discountPercentage = round(100 - (($price) * 100 / $priceSale));
                }

                $output .= '<div class="col-md-3 col-sm-6 col-xs-6">';
                $output .= '<div class="product product-single">';
                $output .= '<div class="product-thumb">';
                $output .= '<div class="product-label">';
                $output .= '<span>New</span>';


                if (!empty($discountPercentage)) {
                    $output .= '
                            <span class="sale">- ' . $discountPercentage . ' % </span>';
                }

                $output .= '</div>';
                $output .= '<a href="?page=productPage&id=' . $id . '" class="main-btn quick-view fs-5" ><i class="fa fa-search-plus"></i>Quick view</a>';
                $output .= "<img src='../image/" . $img . "' alt=''>";
                $output .= '</div>';
                $output .= '<div class="product-body">';
                $output .= '<h3 class="product-price">' . number_format($price) . ' VND</h3>';
                if (!empty($priceSale)) {
                    $output .= '<h2><del class="product-old-price">' . number_format($priceSale) . ' VND</del></h2>';
                }

                $output .= '<h2 class="product-name"><a href="?page=productPage&id=' . $id . '">' . $name . '</a></h2>';
                $output .= '<div class="product-btns">';

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }

            $count++;
        }

        return $output;
    }

    public function pageProducts($page = 1, $perPage = 9)
    {
        $db = new connect();
        $start = ($page - 1) * $perPage;

        $query = "SELECT * FROM Products LIMIT $start, $perPage";
        $result = $db->pdo_query($query);

        $count = 0;
        $output = '';

        foreach ($result as $row) {
            // Process data
            $id = $row['productId'];
            $name = $row['name'];
            $img = $row['image'];
            $price = $row['price'];
            $priceSale = $row['priceSale'];
            $discountPercentage = '';

            if (!empty($priceSale) && $priceSale > $price) {
                $discountPercentage = round(100 - (($price) * 100 / $priceSale));
            }

            $output .= '<div class="col-md-3 col-sm-6 col-xs-6">';
            $output .= '<div class="product product-single">';
            $output .= '<div class="product-thumb">';
            $output .= '<div class="product-label">';
            $output .= '<span>New</span>';

            if (!empty($discountPercentage)) {
                $output .= '<span class="sale">- ' . $discountPercentage . ' % </span>';
            }

            $output .= '</div>';
            $output .= '<a href="?page=productPage&id=' . $id . '" class="main-btn quick-view fs-5"><i class="fa fa-search-plus"></i> Quick view</a>';
            $output .= "<img  style='height: 400px;' src='../image/" . $img . "' alt=''>";
            $output .= '</div>';
            $output .= '<div class="product-body">';
            $output .= '<h3 class="product-price">' . number_format($price) . ' VND</h3>';
            if (!empty($priceSale)) {
                $output .= '<h2><del class="product-old-price">' . number_format($priceSale) . ' VND</del></h2>';
            }


            $output .= '<h2 class="product-name"><a href="?page=productPage&id=' . $id . '">' . $name . '</a></h2>';
            $output .= '<div class="product-btns">';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';

            $count++;
        }

        return $output;
    }


    public function moreProduct($pdCategory)
    {
        $db = new connect();
        $query = "SELECT * FROM products WHERE `categoryId` = '$pdCategory' ORDER BY RAND()";
        $result = $db->pdo_query($query);

        $count = 0;
        $output = '';

        foreach ($result as $row) {
            if ($count < 4) {
                // Process data
                $id = $row['productId'];
                $name = $row['name'];
                $img = $row['image'];
                $price = $row['price'];
                $priceSale = $row['priceSale'];
                $discountPercentage = '';

                if (!empty($priceSale) && $priceSale > $price) {
                    $discountPercentage = round(100 - (($price) * 100 / $priceSale));
                }

                $output .= '<div class="col-md-3 col-sm-6 col-xs-6">';
                $output .= '<div class="product product-single">';
                $output .= '<div class="product-thumb">';
                $output .= '<div class="product-label">';
                $output .= '<span>New</span>';


                if (!empty($discountPercentage)) {
                    $output .= '
                            <span class="sale">- ' . $discountPercentage . ' % </span>';
                }

                $output .= '</div>';
                $output .= '<a href="?page=productPage&id=' . $id . '" class="main-btn quick-view fs-5"><i class="fa fa-search-plus"></i> Quick view</a>';
                $output .= "<img src='../image/" . $img . "' alt=''>";
                $output .= '</div>';
                $output .= '<div class="product-body">';
                $output .= '<h3 class="product-price">' . number_format($price) . ' VND</h3>';
                if (!empty($priceSale)) {
                    $output .= '<h2><del class="product-old-price">' . number_format($priceSale) . '</del></h2>';
                }


                $output .= '<h2 class="product-name"><a href="?page=productPage&id=' . $id . '">' . $name . '</a></h2>';
                $output .= '<div class="product-btns">';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }

            $count++;
        }

        return $output;
    }

    public function getProductCate($categoryId)
    {
        $db = new connect();
        $sql = "SELECT categories.name, products.categoryId FROM categories 
                JOIN products ON categories.categoryId = products.categoryId WHERE categories.categoryId ='$categoryId' ";
        $result = $db->pdo_execute($sql);
//        var_dump($result);
        return $result;
    }

    public function addcomment($userId, $content, $productId)
    {
        $db = new connect();
        $userId = is_array($userId) ? implode(",", $userId) : $userId;

        $query = "INSERT INTO comments ( `userId`, `content`, `productId`) VALUES  ( '$userId' , '$content', '$productId')";
        $result = $db->pdo_execute($query);
        return $result;
    }

    public function listComment($productId)
    {
        $db = new connect();

        $query = "SELECT users.fullName, comments.content, comments.date
              FROM users
              INNER JOIN comments ON users.userId = comments.userId
              WHERE comments.productId = $productId";

        $result = $db->pdo_execute($query);

        return $result;
    }

    public function searchProducts($searchTerm)
    {
        $db = new connect();
        $query = "SELECT * FROM Products WHERE `name` LIKE '%$searchTerm%'";
        $result = $db->pdo_query($query);

        $count = 0;
        $output = '';

        foreach ($result as $row) {
            if ($count >= 0) {
                $id = $row['productId'];
                $name = $row['name'];
                $img = $row['image'];
                $price = $row['price'];
                $priceSale = $row['priceSale'];
                $discountPercentage = '';

                if (!empty($priceSale) && $priceSale > $price) {
                    $discountPercentage = round(100 - (($price) * 100 / $priceSale));
                }

                $output .= '<div class="col-md-3 col-sm-6 col-xs-6">';
                $output .= '<div class="product product-single">';
                $output .= '<div class="product-thumb">';
                $output .= '<div class="product-label">';
                $output .= '<span>New</span>';

                if (!empty($discountPercentage)) {
                    $output .= '<span class="sale">- ' . $discountPercentage . ' % </span>';
                }

                $output .= '</div>';
                $output .= '<a href="?page=productPage&id=' . $id . '" class="main-btn quick-view fs-5"><i class="fa fa-search-plus"></i> Quick view</a>';
                $output .= "<img src='../image/" . $img . "' alt=''>";
                $output .= '</div>';
                $output .= '<div class="product-body">';
                $output .= '<h3 class="product-price">' . number_format($price) . ' VND</h3>';
                if (!empty($priceSale)) {
                    $output .= '<h2><del class="product-old-price">' . number_format($priceSale) . ' VND</del></h2>';
                }

                $output .= '<h2 class="product-name"><a href="?page=productPage&id=' . $id . '">' . $name . '</a></h2>';
                $output .= '<div class="product-btns">';

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }

            $count++;
        }

        return $output;
    }

}
