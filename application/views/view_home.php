<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <style>
        nav {
            width: 500px;
        }
        nav a {
            display: block;
            background-color:#CCC;
        }
        nav a:hover {
            background-color: orange;
        }
    </style>
</head>
<body>
    <h1>Hello, World! <small>CodeIgniter</small></h1>
    <small><em>My Message for You</em></small>
    <nav>
    <?php
        // foreach($message as $key=>$value){
        //     echo "<a href='#'>$value</a>";
        // }
    ?>
    </nav>

    <form action="<?php echo base_url('index.php/home/sum') ?>" method="POST">
    <input type="number" name="a" id="">
    <input type="number" name="b">

    <input type="submit" value="kirim">
</form>
</body>
</html>