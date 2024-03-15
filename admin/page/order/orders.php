<?
$db = '';

class orders
{


    public function getOrder()
    {
        $db = new connect();
        $sql = "SELECT  `orders`.orderId, `users`.username, `orders`.destination, `orders`.status
        FROM orders 
        JOIN users on `orders`.userId = `users`.userId AND `orders`.status ='Đang vận chuyển'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function getOrderConfirm()
    {
        $db = new connect();
        $sql = "SELECT  `orders`.orderId, `users`.username, `orders`.destination, `orders`.status
        FROM orders 
        JOIN users on `orders`.userId = `users`.userId AND `orders`.status ='Chờ xác nhận'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function getOrderDetail($orderId)
    {
        $db = new connect();
        $sql = "SELECT `orderDetail`.*, `products`.name, `products`.price
            FROM orderDetail
            INNER JOIN products ON `orderDetail`.productId = `products`.ProductId
            WHERE `orderDetail`.orderId = '$orderId' ";
        $result = $db->pdo_query($sql);
        return $result;
    }

//    public function getOrderTotal($orderId)
//    {
//        $db = new connect();
//
//        // Assuming you have a 'orderDetail' table with 'amount' and 'price' columns
//        // Using a subquery to calculate the product of 'amount' and 'price' for each row
//        $sql = "SELECT SUM(subtotal) AS total
//            FROM (
//                SELECT `orderDetail`.`amount` * `products`.`price` AS subtotal
//                FROM `orderDetail`
//                INNER JOIN `products` ON `orderDetail`.`productId` = `products`.`ProductId`
//                WHERE `orderDetail`.`orderId` = '$orderId'
//            ) AS subquery";
//
//        $result = $db->pdo_query($sql);
//
//        // Assuming your result is an associative array
//        if ($result) {
//            return $result[0]['total'];
//        } else {
//            return 0; // or handle the error as needed
//        }
//    }

    public function getOrderTotal($orderId)
    {
        $db = new connect();

        $sql = "SELECT SUM(subtotal) AS total, `promotions`.`name` AS promotionName, `promotions`.`discount` AS discount
        FROM (
            SELECT `orderDetail`.`amount` * `products`.`price` AS subtotal
            FROM `orderDetail`
            INNER JOIN `products` ON `orderDetail`.`productId` = `products`.`ProductId`
            WHERE `orderDetail`.`orderId` = '$orderId'
        ) AS subquery
        INNER JOIN `orders` ON `orders`.`orderId` = '$orderId'
        INNER JOIN `promotions` ON `orders`.`promotionId` = `promotions`.`promotionId`";

        $result = $db->pdo_query($sql);

        if ($result) {
            if ($result[0]['discount'] <= 100) {
                $result[0]['total'] -= $result[0]['total'] * ($result[0]['discount'] / 100);
            } else {
                $result[0]['total'] -= $result[0]['discount'];
            }
            return $result[0];
        } else {
            return 0;
        }
    }


    public function delete($orderDetailId)
    {
        $db = new connect();
        $sql = "UPDATE orderdetail SET status = 'Inactive' WHERE orderDetailId	= '$orderDetailId'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function conditionOrder($orderId)
    {
        $db = new connect();
        $sql = "UPDATE orders SET status = 'Đang vận chuyển' WHERE orderId = '$orderId'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function cancellation($orderId)
    {
        $db = new connect();
        $sql = "UPDATE orders SET status = 'Đơn đã hủy' WHERE orderId = '$orderId'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function cancelOrder($orderId)
    {
        $db = new connect();
        $sql = "UPDATE orders SET status = 'Đã hủy' WHERE orderId = '$orderId'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function thongKe()
    {
        $db = new connect();
        $sql = "SELECT MONTH(date) as Tháng, COUNT(orderId) as 'Số đơn hàng'
                FROM orders
                GROUP BY MONTH(date)";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function insertOrder($totalPrice, $destination, $promotionId, $userId, $status, $date)
    {
        $db = new connect();
//        $promotionId = isset($promotionId) ? $promotionId : NULL;
        $sql = "INSERT INTO orders (totalPrice, destination, promotionId, userId, status, date)
                VALUES ('$totalPrice', '$destination', " . ($promotionId !== NULL ? "'$promotionId'" : "NULL") . ", '$userId', '$status', '$date')";

        $result = $db->pdo_query($sql);

        return $result;
    }

    public function getOrderID()
    {
        $db = new connect();
        $sql = "SELECT orderId FROM orders ORDER BY orderId DESC LIMIT 1";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function insertOrderDetail($productId, $amount, $orderId, $price)
    {
        $db = new connect();
        $orderId = (int)$orderId;
        $sql = "INSERT INTO orderdetail (productId, amount, orderId, price)
                VALUES ('$productId', '$amount', '$orderId', '$price')";
        $result = $db->pdo_query($sql);
        return $result;
    }

}