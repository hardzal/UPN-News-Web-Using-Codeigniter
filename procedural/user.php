<?php
    require_once "crud.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <nav>
                    <ul>
                        <li><a href="user.php?post=index">Posts</a></li>
                        <li><a href="user.php?post=add">Post Add</a></li>
                    </ul>
            </div>
            <div class="col-sm-8">
                <?php
                    $post = isset($_GET['post']) ? $_GET['post'] : "";
                    if(empty($post)) {
                        $post = "index";
                    }
                    switch($post) {
                        case "index":
                ?>
                            <h3>Daftar Post</h3>

                <?php
                        break;
                        case "add":
                        if(isset($_POST['submit'])) {
                            
                        }
                ?>
                        <h3>Tambah Post</h3>
                        <form method="post" action="" enctype="multipart/form-data">
                            <label for="headline">Headline Berita</label><br>
                                <input type="text" name="headline"/><br>
                            <label for="title">Judul Berita</label><br>
                                <input type="text" name="title"/><br>
                            <label for="kategori">Kategori</label><br>
                                <select name="kategori">
                                    <option value="kategori">Kategori</option>
                                </select><br>
                            <label for="gambar">Image</label><br>
                                <input type="file" name="gambar"/><br>
                            <label for="isi">Isi</label><br/>
                                <textarea name="isi" col='10' row='15'></textarea>
                            <br>
                            <input type="submit" name="submit"/>
                        </form>
                <?php
                        break;
                        case "update":

                        break;
                        case "delete":

                        break;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>