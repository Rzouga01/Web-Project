<?php

require "../../database/connect.php";
require  "../../model/Product/product_class.php";

class productC
{
    function read()
    {
        $conn = Config::getConnexion();
        $products = [];

        $r = $conn->query("SELECT * FROM product");

        foreach ($r as $row) {
            $product = [
                'ID_Product' => $row['ID_Product'],
                'Product_name' => $row['Product_name'],
                'Product_price' => $row['Product_price'],
                'Product_description' => $row['Product_description']
            ];
            $products[] = $product;
        }                   

        return $products;
    }


    function delete($ID)
    {
        try {
            $conn = Config::getConnexion();

            $sql = "DELETE FROM product WHERE ID_Product = $ID";

            $conn->exec($sql);

            echo "<script>alert('Product Deleted successfully');</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function create($id, $name, $price, $description)
    {
        $conn = Config::getConnexion();

        $testSql = "SELECT * FROM product WHERE UPPER(Product_name) = UPPER(:name) AND UPPER(Product_description) = UPPER(:description)" ;
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $testStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $testStmt->bindParam('', $price, PDO::PARAM_STR);

        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Type already exists";
        } else {
            $insertSql = "INSERT INTO product (Product_name, Product_description, Product_price) VALUES (:name, :description)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);

            if ($insertStmt->execute()) {
                return "Product created successfully";
            } else {
                return "Error creating type";
            }
        }
    }

    function update($id, $newName, $newDescription, $newPrice)
    {
        $conn = Config::getConnexion();

        // Use prepared statements to prevent SQL injection
        $checkSql = "SELECT * FROM product WHERE UPPER(ID_Product)=UPPER(:id)";
        $checkStatement = $conn->prepare($checkSql);
        $checkStatement->bindParam(':id', $id);
        $checkStatement->execute();

        if ($checkStatement->rowCount() == 0) {
            echo "<script>alert('Type Does Not Exist');</script>";
        } else {
            // Use placeholders and bind parameters to prevent SQL injection
            $updateSql = "UPDATE product SET Product_name = :newName, Product_description = :newDescription, Product_price =  :newPrice WHERE ID_Product = :id";
            $updateStatement = $conn->prepare($updateSql);
            $updateStatement->bindParam(':newName', $newName);
            $updateStatement->bindParam(':newDescription', $newDescription);
            $updateStatement->bindParam(':newPrice', $newPrice);

            $updateStatement->bindParam(':id', $id);

            $updateStatement->execute();

            echo "<script>alert('Product Updated successfully');</script>";
        }
    }
}
