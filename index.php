<?php

require_once 'App/Config/headers.php';

require_once 'App/Config/DBConnection.php';

require_once 'App/Controllers/ProductsController.php';

switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':

        if (isset($_GET['id'])) 
        {
            $id      = $_GET['id'];
            $product = ProductsController::show($id);

            echo $product;
        } 
        else 
        {
            $products = ProductsController::index();

            echo $products;
        }

        break;

    case 'POST':
        
        if (isset($_GET['id'])) 
        {

            $id           = $_GET['id'];
            $product_name = $_POST['product_name'];
            $description  = $_POST['description'];
            $price        = $_POST['price'];
            $image        = $_POST['image'];
            $category     = $_POST['category'];

            $product = ProductsController::edit($id, $product_name, $description, $price, $image, $category);

            echo $product;
        } 
        else 
        {
            $product_name = $_POST['product_name'];
            $description  = $_POST['description'];
            $price        = $_POST['price'];
            $image        = $_POST['image'];
            $category     = $_POST['category'];

            $new_product = ProductsController::store($product_name, $description, $price, $image, $category);

            echo $new_product;
        }

        break;

    case 'DELETE':

        if (isset($_GET['id'])) 
        {
            $id = $_GET['id'];

            $deleted_product = ProductsController::destroy($id);

            echo $deleted_product;
        }

        break;

    default:
        $products = 'Metodo no soportado.';

        echo $products;

        break;

}
