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
                    <li><a href="index.php?p=login">Login</a></li>
                    <li><a href="index.php?p=register">Register</a></li>
                </ul>
            </nav>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
            <?php
                $page = isset($_GET['p']) ? $_GET['p'] : "";
                if($page == "") {
                    $page = "index";
                }

                switch($page) {
                    case "index":
            ?>
            <?php
                $query = "SELECT berita.no_berita, berita.no_kategori, berita.username, reporter.nama_lengkap, berita.judul_berita, kategori.nama_kategori, berita.tgl_berita, berita.jam_berita FROM berita INNER JOIN kategori ON berita.no_kategori=kategori.no_kategori INNER JOIN reporter ON berita.username=reporter.username ORDER BY tgl_berita, jam_berita DESC";
                $sql = mysqli_query($connect, $query);
                if(mysqli_num_rows($sql) == 0) {
                    echo "<p>Berita belum ada</p>";
                } else {
                    while($data = mysqli_fetch_array($sql)) {
                ?>
                        <div class="post">
                            <h2>
                                <a href="post.php?id=<?php echo $data['no_berita'];?>"><?php echo $data['judul_berita'];?></a>
                            </h2>
                            <p>Posted ON <?php echo $data['jam_berita']. " ". $data['tgl_berita'];?> by <a href="user.php?username=<?php echo $data['username'];?>"><?php echo $data['nama_lengkap'];?></a> || <a href="post.php?cat=<?php echo $data['no_kategori'];?>"><?php echo $data['nama_kategori'];?></a></p>
                        </div>
                <?php
                        }
                    }
                ?>
            <?php
                break;
                case "login":
                    if(isset($_POST['submit'])) {

                    }
            ?>
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

                    break;

                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>