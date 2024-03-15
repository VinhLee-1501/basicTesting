<?php

$db = '';

class comment
{
    public function addCmt($comment_content, $user_id, $product_id)
    {
        $db = new connect();
        $insert = "INSERT INTO comment (comment_content, user_id, product_id) VALUES ('$comment_content', '$user_id', '$product_id')";
        $result = $db->pdo_execute($insert);
        return $result;
    }

    public function getIdCmt($comment_id, $user_id)
    {
        $db = new connect();
        $select = "SELECT * FROM comment WHERE `comment_id` = '$comment_id' AND `user_id` = '$user_id'";
        $result = $db->pdo_query($select);
        return $result;
    }

    public function updateCmt($content, $userId, $commentId)
    {
        $db = new connect();
        $update = "UPDATE comments SET `content` = '$content' WHERE `userId` = '$userId' AND `commentId` = '$commentId'";
        $result = $db->pdo_query($update);
        return $result;
    }

    public function getComment()
    {
        $db = new connect();
        $select = "SELECT `product`.product_id, `product`.product_name, COUNT(*) AS tong_cmt,
        MAX(comment_day) AS ngay_gan_nhat,
        MIN(comment_day) AS ngay_cu_nhat
        FROM comment JOIN product ON `comment`.product_id = `product`.product_id GROUP BY `product`.product_id ORDER BY ngay_gan_nhat DESC, ngay_cu_nhat DESC";
        $result = $db->pdo_execute($select);
        return $result;
    }

    public function getCount()
    {
        $db = new connect();
        $sql = "SELECT products.productId, products.name, (SELECT COUNT(*) FROM comments 
                WHERE comments.productId = products.productId ) 
                AS count FROM products";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function hiddenActive($commentId)
    {
        $db = new connect();
        $update = "UPDATE comments SET status = 'Inactive' WHERE commentId = $commentId";
        $result = $db->pdo_query($update);
        return $result;
    }

    public function getList($productId)
    {
        $db = new connect();
        $sql = "SELECT * FROM comments INNER JOIN users ON `comments`.userId = `users`.userId WHERE productId = '$productId'";
        $result = $db->pdo_query($sql);
        return $result;
    }

    public function getDetailComment()
    {
        $db = new connect();
        $select = "SELECT `comment`.comment_id, `user`.user_name, `comment`.comment_content, `comment`.comment_day
        FROM comment JOIN user ON `comment`.user_id = `user`.user_id GROUP BY `comment`.comment_id";
        $result = $db->pdo_query($select);
        return $result;
    }

    public function deleteCmt($comment_id)
    {
        $db = new connect();
        $sql = "DELETE FROM comment WHERE comment_id = '$comment_id'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function countDetail($product_id)
    {
        $db = new connect();
        $sql = "SELECT COUNT(detail_comment.`comment_id`) FROM comment, detail_comment 
        WHERE comment.`comment_id` = detail_comment.`comment_id` AND comment.`product_id` = $product_id";
        $result = $db->pdo_query($sql);
        return $result;
        foreach ($result as $count) {
            return $count['COUNT(detail_comment.`comment_id`)'];
        }
    }
}