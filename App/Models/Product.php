<?php

require_once 'App/Config/DBConnection.php';
require_once 'App/Interfaces/IProduct.php';

class Product implements IProduct
{

    /**
     * retorna todos los registros de la tabla "products".
     * 
     * @return string
     */
    public static function all() 
    {
        try
        {
            $db   = DBConnection::getInstance();
            $sql  = "SELECT * FROM products";
            $stmt = $db->prepare($sql);
            
            $stmt->execute();
            
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * recibe como parametro un id y retorna un registro de la tabla "products"
     * asociado a dicho id.
     * 
     * @param $id
     * @return string
     */
    public static function find($id) 
    {
        try
        {
            $db   = DBConnection::getInstance();
            $sql  = "SELECT * FROM products WHERE id = :id";
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $product;
        }
        catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    /**
     * crea un nuevo registro en la tabla "products".
     * 
     * @param $product_name
     * @param $description
     * @param $price
     * @param $image
     * @param $category
     * 
     * @return string
     */
    public static function create($product_name, $description, $price, $image, $category) 
    {
        try 
        {
            $db   = DBConnection::getInstance();
            $sql  = "INSERT INTO products (product_name, description, price, image, category) VALUES (:product_name, :description, :price, :image, :category)";
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $db->lastInsertId();

            $last_product = self::find($id);

            return $last_product;
        }
        catch (PDOException $e) {
            $db->rollBack();

            return $e->getMessage();
        }
    }

    /**
     * actualiza un registro en la tabla "products".
     * 
     * @param $id
     * @param $product_name
     * @param $description
     * @param $price
     * @param $image
     * @param $category
     * 
     * @return string
     */
    public static function update($id, $product_name, $description, $price, $image, $category)
    {
        try 
        {
            $db   = DBConnection::getInstance();
            $sql  = "UPDATE products SET product_name = :product_name, description = :description, price = :price, image = :image, category = :category WHERE id = :id";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            
            $stmt->execute();
            
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            return array($id, $product_name, $description, $price, $image, $category);
        }
        catch (PDOException $e) {

            return $e->getMessage();
        }
    }

    /**
     * recibe como parametro un id y elimina un registro de la tabla "products"
     * asociado a dicho id.
     * 
     * @param $id
     * 
     * @return string
     */
    public static function delete($id) {
        try 
        {
            $db   = DBConnection::getInstance();
            $sql  = "DELETE FROM products WHERE id = :id";
            $stmt = $db->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
            
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            

            return $product;
        }
        catch (PDOException $e) {

            return $e->getMessage();
        }
    }

}
