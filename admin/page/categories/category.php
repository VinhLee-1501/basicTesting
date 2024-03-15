<?php
$db = '';
class categories
{
    public function getList()
    {
        $db = new connect();
        $query = 'select * from categories where status = "Active"'; //viết câu lệnh sql select *
        $result = $db->pdo_query($query);
        return $result;
    }

    public function getListInactive()
    {
        $db = new connect();
        $query = 'select * from categories where status = "Inactive"'; //viết câu lệnh sql select *
        $result = $db->pdo_query($query);
        return $result;
    }

    //Lấy 1 dòng dữ liệu của bảng Categories dựa trên id 
    public function getById($categoryId)
    {
        $db = new connect();
        $query = 'select * from categories where categoryId =' . $categoryId;
        $result = $db->pdo_query_one($query);
        return $result;
    }

    // hàm insert, create, thêm mới dữ liệu
    public function add($name, $status)
    {
        $db = new connect();
        $query = "INSERT INTO categories (`name`, `status`) VALUES ('$name', '$status')";
        $result = $db->pdo_execute($query);
        return $result;
    }

    //hàm cập nhật dữ liệu
    public function update($categoryId, $name, $status)
    {
        $db = new connect();
        $query = "UPDATE categories SET `name` = '$name', `status` = '$status' WHERE categoryId = $categoryId";
        $result = $db->pdo_execute($query);
        return $result;
    }

    public function delete($categoryId)
    {
        $db = new connect();
        $sql = 'DELETE FROM categories WHERE categoryId=' . $categoryId;
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function hiddenCate($categoryId)
    {
        $db = new connect();
        $sql = "update categories set status ='Inactive' where categoryId = '$categoryId'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function hiddenInactive($categoryId)
    {
        $db = new connect();
        $sql = "update categories set status ='Active' where categoryId = '$categoryId'";
        $result = $db->pdo_query_one($sql);
        return $result;
    }

    public function getCategoryByName($name)
    {
        $db = new connect();
        $query = "SELECT * FROM categories WHERE `name` = '$name'";
        $result = $db->pdo_query_one($query);
        return $result;
    }
}
