<?php
    require_once "crud.php";
    if(!$crud->checkLogin()) {
        header("Location: index.php");
    }
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
                        <li><a href="index.php?p=logout">Logout</a></li>
                    </ul>
            </div>
            <div class="col-sm-8">
                <?php
                    $post = isset($_GET['post']) ? $_GET['post'] : "";
                    if(empty($post)) {
                        $post = "index";
                    }
                    $username = $crud->sessionGet();
                    switch($post) {
                        case "index":
                        $query = "SELECT * FROM berita WHERE username='$username'";
                        $crud->setQuery($query);
                        $crud->querySimple();
                        if($crud->getRows() == 0) {
                            echo "Belum ada berita!<br>";
                        } else {
                ?>
                            <h3>Daftar Post</h3>
                                <ul>
                        <?php
                            while($data = $crud->queryShow()) {
                                echo "<li><a href='post.php?id=".$data['no_berita']."'>".$data['judul_berita']."</a> || <a href='user.php?post=edit&id=".$data['no_berita']."'>Edit</a> | <a href='user.php?post=delete&id=".$data['no_berita']."' onclick='confirm(\"Apa kamu yakin ingin menghapus ini?\")'>Hapus</a></li>";
                            }
                            echo "</ul>";
                        }
                        break;
                        case "add":
                        if(isset($_POST['submit'])) {
                            $headline = filter_input(INPUT_POST, 'headline', FILTER_SANITIZE_STRING);
                            $judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_STRING);
                            $kategori = filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING);
                            // $gambar = array();
                            $gambar_name = $_FILES['gambar']['name'];
                            $gambar_size = $_FILES['gambar']['size'];
                            $gambar_type = $_FILES['gambar']['type'];
                            $gambar_tmp = $_FILES['gambar']['tmp_name'];
                            $gambar = [$gambar_name, $gambar_size, $gambar_type, $gambar_tmp];
                            $isi = filter_input(INPUT_POST, 'isi', FILTER_SANITIZE_STRING);
                            $crud->addPost($username, $headline, $judul, $kategori, $gambar, $isi);
                        }
                ?>
                        <h3>Tambah Post</h3>
                        <form method="post" action="" enctype="multipart/form-data">
                            <label for="headline">Headline Berita</label><br>
                                <input type="text" name="headline"/><br>
                            <label for="title">Judul Berita</label><br>
                                <input type="text" name="judul"/><br>
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
                            if(isset($_GET['id']) && !empty($_GET['id'])) { 
                                $id = trim(strip_tags($_GET['id']));
                                $crud->delPost($id);
                            } else {
                                header("Location: user.php?post=index");
                            }
                        break;
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>