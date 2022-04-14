<?php

require_once 'App/Models/Product.php';
require_once 'App/Utilities/Response.php';

class ProductsController 
{
    
    /**
     * retorna los una data en formato json, incluyendo un arreglo de productos
     * 
     * @return string
     */
    public static function index()
    {
        
        $products = Product::all();

        if ($products == null) {
            $response = new Response(500, false, 'No hay productos registrados.', null);
        } else {
            $response = new Response(200, true, 'Lista de productos obtenida.', $products);
        }

        return $response->toJson();
        
    }

    /**
     * llama a el metodo find de la clase ProductDAO para obtener un producto
     * asociado a un id recibido como parametro.
     * 
     * @param $id
     * @return string
     */
    public static function show($id) 
    {
        $product = Product::find($id);

        if ($product == false) {
            $response = new Response(204, false, 'No se encontró el producto en nuestros registros.', null);
        } else {
            $response = new Response(200, true, 'Producto obtenido.', $product);
        }

        return $response->toJson();
    }

    /**
     * Llama a el metodo create de la clase ProductDAO para crear un nuevo producto.
     * 
     * @param $product_name
     * @param $description
     * @param $price
     * @param $image
     * @param $category
     * 
     * @return string
     */
    public static function store($product_name, $description, $price, $image, $category) 
    {

        $result = Product::create($product_name, $description, $price, $image, $category);

        if ($result == false) {
            $response = new Response(404, false, 'No se pudo crear el producto.', null);
        } else {
            $response = new Response(201, true, 'Producto creado.', $result);
        }

        return $response->toJson();
    }

    /**
     * Llama a el metodo update de la clase ProductDAO para actualizar un producto.
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
    public static function edit($id, $product_name, $description, $price, $image, $category)
    {
        $result = Product::update($id, $product_name, $description, $price, $image, $category);

        if ($result == false) {
            $response = new Response(404, false, 'No se pudo actualizar el producto.', null);
        } else {
            $response = new Response(200, true, 'Producto actualizado.', $result);
        }

        return $response->toJson();
    }

    /**
     * Llama a el metodo delete de la clase ProductDAO para eliminar un producto
     * asociado a el id recibido como parametro.
     * 
     * @param $id
     * 
     * @return string
     */
    public static function destroy($id) 
    {
        $result = Product::delete($id);

        $response = new Response(200, true, 'Producto eliminado.', $result);
        
        return $response->toJson();
    }
    
}
