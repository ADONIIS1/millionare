<?php
require_once("config/db.class.php");



class Category{
    public  $ID ; 
    public  $CategoryName; 
    public function __construct($Cate)
    {
        
        $this->CategoryName = $Cate;
    }

  

    public static function get_CateName( $id)
    {
        $db = new Db();
        $sql = "SELECT * FROM Category where id = '$id'";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_category(){
        $db = new Db();
        $sql = "SELECT * FROM category";
        $result = $db->select_to_array($sql);
        return $result;
         
    }
    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO category(CategoryName) VALUES('$this->CategoryName')";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function update($id, $cate )
    {
        $db = new Db();
        $sql = "UPDATE category SET  CategoryName = '$cate' WHERE id = $id;";
        $result = $db->query_execute($sql);
        return $result;
    }
    public static function delete($id )
    {
        $db = new Db();
        $sql = "DELETE FROM Questions WHERE CategoryID  = $id;";
        
        $result = $db->query_execute($sql);

        $sql = "DELETE FROM category WHERE id = $id;";

        $result = $db->query_execute($sql);
        return $result;
    }
}