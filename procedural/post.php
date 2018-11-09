<?php
    require_once "crud.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <title>Post</title>
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
                  $page = isset($_GET['op']) ? $_GET['op'] : "";
                  $page = trim(strip_tags($page));

                  switch($page) {
                      case "view":
                        if(empty($_GET['id']) && !isset($_GET['id'])) {
                            header("Location: index.php");
                        }
                        $id = trim(strip_tags($_GET['id']));


                        $query = "SELECT * FROM berita WHERE no_berita = '$id'";
                        $crud->setQuery($query);
                        $crud->querySimple();
                        $dt = $crud->queryShow();
                ?>
                    <div class="post">
                        <h2>
                            <a href="post.php?op=view&id=<?php echo $dt['no_berita'];?>">
                                <?php echo $dt['judul_berita'];?>
                            </a>
                        </h2>
                        <p><a href='post.php?op=view&id=<?php echo $dt['no_berita'];?>'><img src='./img/<?php echo $dt["gambar_berita"];?>'/></a></p>
                        <p><?php echo $dt['isi_berita'];?></p>
                    </div>
                <?php
                      break;
                      case "category":
                    
                      if(!isset($_GET['id']) && empty($_GET['id'])) {
                          header("Location: index.php");
                      }
                      $id = trim(strip_tags($_GET['id']));
                      $query = "SELECT * FROM berita WHERE no_kategori = '$id'";
                      $crud->setQuery($query);
                      $crud->querySimple();
                      while($dt = $crud->queryShow()) {
                ?>
                        <div class="post">
                            <h2>
                                <a href="post.php?op=view&id=<?php echo $dt['no_berita'];?>"><?php echo $dt['judul_berita'];?></a>
                            </h2>
                        </div>
                    <?php
                      }
                      break;
                      case "author":
                        
                        if(!isset($_GET['username']) && empty($_GET['username'])) {
                            header("Location: index.php");
                        }
                        $id = trim(strip_tags($_GET['username']));
                        $query = "SELECT * FROM berita WHERE username = '$id'";
                        $crud->setQuery($query);
                        $crud->querySimple();
                        while($dt = $crud->queryShow()) {
                    ?>
                        <div class="post">
                            <h2>
                                <a href="post.php?op=view&id=<?php echo $dt['no_berita'];?>"><?php echo $dt['judul_berita'];?></a>
                            </h2>
                        </div>
                        <?php
                        }
                        break;
                      default:
                        header("Location: index.php");
                  }  
                ?>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
</body>
</html>
<?php
    $crud->disconnect();
?>