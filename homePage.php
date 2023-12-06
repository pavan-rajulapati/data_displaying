<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .cartDiv {
            width: 250px;
            height: 300px;
            border: solid;
            font-size: 16px;
            margin-bottom: 20px; 
            box-shadow: 5px 5px 10px black;
        }

        .cartDiv img {
            width: 90%;
            height: 50%;
            margin: 10px 10px 0px 10px;
        }

        .cartDiv p {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }

        .buttons button {
            padding: 7px;
            background-color: aqua;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $conn = mysqli_connect('localhost', 'root', '', 'products_db');
        if (!$conn) {
            echo "Database connection failed";
        }

        $query = "SELECT * FROM items";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 0) {
            echo "There are no products in the database.";
        } else {
    ?>
    <div class="mainDiv">
    <?php
        while ($product = mysqli_fetch_assoc($result)) {
        ?>

        <div class="cartDiv">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($product['product_image']); ?>" alt="image">
            <p><?php echo $product['product_name']; ?></p>
            <p>cost : <?php echo $product['product_cost']; ?></p>
            <div class="buttons">
                <button name="buy">BUY</button>
                <button name="addToCart">ADD TO CART</button>
            </div>
        </div>
        <?php
                    }
                    ?>
    </div>
    <?php
            }
        }
        ?>
</body>
</html>