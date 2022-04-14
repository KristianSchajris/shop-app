<?php

interface IProduct {

    public static function all();

    public static function find($id);

    public static function create($product_name, $description, $price, $image, $category);

    public static function update($id, $product_name, $description, $price, $image, $category);

    public static function delete($id);

}
