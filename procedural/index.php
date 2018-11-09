<?php
    require_once "crud.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link href="style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <title>Home</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1>Berita UPN</h1>
            </div>
            <div class="col-sm-4">
                <form method="get" action="">
                    <input type="search" placeholder="cari artikel..." name="search"/>
                    <input type="submit" name="submit"/>
                </form>
            </div>
        </div>
        <div class="row">
            <nav>
                <ul>
                    <li><a href='index.php'>Home</a></li>
                    <?php if(!$crud->checkLogin()) { ?>
                    <li><a href="index.php?p=login">Login</a></li>
                    <li><a href="index.php?p=register">Register</a></li>
                    <?php } else { ?>
                    <li><p>Selamat datang, <?php echo $crud->sessionGet();?></p></li>
                    <li><a href="user.php?post=index">Posts</a></li>
                    <li><a href="user.php?post=add">Post Add</a></li>
                    <li><a href="index.php?p=logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
            <?php
                $page = isset($_GET['p']) ? $_GET['p'] : "";
               
                $page = strip_tags(trim($page));
               
                if($page == "") {
                    $page = "index";
                }
                switch($page) {
                    case "index":
            ?>
            <?php
                $query = "SELECT berita.no_berita, berita.no_kategori, berita.username, reporter.nama_lengkap, berita.judul_berita, kategori.nama_kategori, berita.tgl_berita, berita.jam_berita FROM berita INNER JOIN kategori ON berita.no_kategori=kategori.no_kategori INNER JOIN reporter ON berita.username=reporter.username ORDER BY tgl_berita, jam_berita DESC";
                $crud->setQuery($query);
                $crud->querySimple();
                while($data = $crud->queryShow()) {
            ?>
                    <div class="post">
                        <h2>
                            <a href="post.php?op=view&id=<?php echo $data['no_berita'];?>"><?php echo $data['judul_berita'];?></a>
                        </h2>
                        <p>Posted ON <?php echo $data['jam_berita']. " ". $data['tgl_berita'];?> by <a href="post.php?op=author&username=<?php echo $data['username'];?>"><?php echo $data['nama_lengkap'];?></a> || <a href="post.php?op=category&id=<?php echo $data['no_kategori'];?>"><?php echo $data['nama_kategori'];?></a></p>
                    </div>
                <?php
                    }
                ?>
            <?php
                break;
                case "login":
                    if(isset($_POST['submit'])) {
                        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

                        $crud->selectSpesify("SELECT username, password FROM reporter WHERE username=? AND password=?");
                        $crud->bindSelect("ss", $username, $password);
                        $crud->sessionSave($username);
                    }
            ?>
                <h2>Login Form</h2>
                <form method="post">
                    <label for="username">Username</label><br/>
                    <input type="text" name="username"/><br/>
                    <label for="password">Password</label><br/>
                    <input type="password" name="password"/><br/><br/>
                    <input type="submit" name="submit"/>
                </form>
            <?php
                    break;
                case "register":
                if(isset($_POST['submit'])) {
                    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $nama = filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING);
                    $no_hp = filter_input(INPUT_POST, 'no_hp', FILTER_SANITIZE_STRING);
                    $query = "INSERT INTO reporter VALUES('$username', '$password', '$nama', '$email', '$no_hp', 'gambar.jpg')";
                    $crud->setQuery($query);
                    $crud->querySimple();
                    if($crud->queryRun()) {
                        echo "<script>alert('Berhasil mendaftar!')</script>";
                    }
                }
            ?>
                <h2>Register Form</h2>
                <form method="post">
                    <label for="username">Username</label><br/>
                    <input type="text" name="username" required/><br/>
                    <label for="password">Password</label><br/>
                    <input type="password" name="password" required/><br/>
                    <label for="nama_lengkap">Nama Lengkap</label><br/>
                    <input type="text" name="nama_lengkap" required/><br/>
                    <label for="email">Email</label><br/>
                    <input type="email" name="email" required/><br/>
                    <label for="email">No HP</label><br/>
                    <input type="text" name="no_hp" required/><br/><br/>
                    <input type="submit" name="submit"/>
                </form>
            <?php
                    break;
                    case "logout":
                        $crud->logout();
                        header("Location: index.php");
                    break;
                    default:
                        header("Location: index.php");
                }
            ?>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Search resultsz</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#myModal').modal('show');
    </script>
</body>
</html>
<?php
    $crud->disconnect();
?>