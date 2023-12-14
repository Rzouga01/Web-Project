<?php

require_once "../../database/connect.php";
require_once  "../../model/Product/product_class.php";

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
                'image_link' => $row['image_link'],
                'Product_description' => $row['Product_description'],
                'ID_Category' => $row['ID_Category']
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

    function create($name, $price, $description, $image, $category)
    {
        $conn = Config::getConnexion();

        $testSql = "SELECT * FROM product WHERE UPPER(Product_name) = UPPER(:name)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);

        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Type already exists";
        } else {
            $insertSql = "INSERT INTO product (Product_name, Product_price, Product_description, image_link, ID_Category) VALUES (:name, :price, :description, :image, :category)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam(':price', $price, PDO::PARAM_STR);
            $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);
            $insertStmt->bindParam(':image', $image, PDO::PARAM_STR);
            $insertStmt->bindParam(':category', $category, PDO::PARAM_STR);


            if ($insertStmt->execute()) {
                return "Product created successfully";
            } else {
                return "Error creating type";
            }
        }
    }

    function update($id, $newName, $newDescription, $newPrice, $newimage, $newcategory)
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
            $updateSql = "UPDATE product SET Product_name = :newName,  Product_price =  :newPrice, Product_description = :newDescription,image_link = :newimage ,ID_Category = :newcategory  WHERE ID_Product = :id";
            $updateStatement = $conn->prepare($updateSql);
            $updateStatement->bindParam(':newName', $newName);
            $updateStatement->bindParam(':newDescription', $newDescription);
            $updateStatement->bindparam(':newimage', $newimage);
            $updateStatement->bindParam(':newPrice', $newPrice);
            $updateStatement->bindParam(':newcategory', $newcategory);

            $updateStatement->bindParam(':id', $id);

            $updateStatement->execute();

            echo "<script>alert('Product Updated successfully');</script>";
        }
    }
}
