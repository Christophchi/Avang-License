<?php
require_once './activate_inc.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>License Activation</title>
    <link rel="stylesheet" type="text/css" href="./skins/css/button-alerts.css" />
    <style>
        /* Custom CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>License Activation</h1>
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-success">
                <?php echo $app->gets('success'); ?>
            </div>
        <?php
        }

        if (isset($_SESSION['error'])) {
        ?>
            <div class="alert alert-danger">
                <?php echo $app->gets('error'); ?>
            </div>
        <?php
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="license-key">License Key:</label>
                <input type="text" id="license-key" name="license_key" placeholder="Enter your license key" required>
            </div>
            <div class="form-group">
                <label for="email">Domain:</label>
                <input type="text" id="email" name="license_domain" placeholder="Enter your domain url" required>
            </div>
            <button type="submit" name="submit">Activate License</button>
        </form>
    </div>
</body>

</html>