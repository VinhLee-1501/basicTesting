<?php
$db = '';

class promotions
{
    public function getPromotions($promotionId)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE promotionId = '$promotionId'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function getPromotionsName($name)
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE name = '$name'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function getStatus()
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE status = 'Active'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function getStatusInactive()
    {
        $db = new connect();
        $sql = "SELECT * FROM promotions WHERE status = 'Inactive'";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function add($name, $startTime, $endTime, $detail, $promotionType, $discount, $status, $conditionPro)
    {
        $db = new connect();
        $sql = "INSERT INTO promotions (name, startTime, endTime, detail, promotionType, discount, status, conditionPro)
            VALUES ('$name', '$startTime', '$endTime', '$detail', '$promotionType', '$discount', '$status', '$conditionPro')";
        $result = $db->pdo_execute($sql);
        return $result;
    }

    public function hidden($promotionId)
    {
        $db = new connect();
        $sql = "UPDATE promotions SET status = 'Inactive' WHERE promotionId = '$promotionId'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function updateStatus($promotionId)
    {
        $db = new connect();
        $currentDate = date("Y-m-d");

        // Kiểm tra xem khuyến mãi có $promotionId đã kết thúc chưa
        $sql = "SELECT * FROM promotions WHERE promotionId = :promotionId AND endTime <= :currentDate AND status = 'Active'";
        $promotion = $db->pdo_execute($sql, array(":promotionId" => $promotionId, ":currentDate" => $currentDate));

        // Nếu khuyến mãi đã kết thúc, cập nhật trạng thái thành 'Inactive'
        if ($promotion) {
            $updateSql = "UPDATE promotions SET status = 'Inactive' WHERE promotionId = '$promotionId'";
            $db->pdo_execute($updateSql, array(":promotionId" => $promotionId));
        }
    }


}