# Tutorial CRUD Procedural PHP

## Flow Program
  1. Halaman Index.php merupakan halaman utama, user bisa melihat daftar berita terbaru, daftar kategori.
  2. Di halaman index.php kita bisa mengklik berita kemudian masuk ke halaman post.
  3. selain itu saat kita mengklik kategori maka yang tampil adalah daftar berita berdasarkan kategori yang kita klik tadi.
  4. selain itu saat kita mengklik username maka akan tampil berita berdasarkan username tersebut.
  5. Di halaman index.php terdapat menu untuk login serta register.
  6. Masuk halaman login, berisi form username dan password. 
  7. Masuk halaman register terdapat form username, password, nama_lengkap, email, no_hp, gambar_reporter.
  8.  ketika user sudah mendaftar maka otomatis terdaftar sebagai reporter maka user bisa memasukkan laporan beritanya.


## Routes
- index.php
    - GET index.php?p=login
    - GET index.php?p=register
    - GET index.php?p=logout
    - GET index.php?search=$query

- post.php
    - GET post.php?op=view&id=$id
    - GET post.php?op=category&id=$id
    - GET post.php?op=username&id=$id

- user.php
    - GET user.php?post=add
    - POST user.php?post=add
    - GET user.php?post=update&id=$id
    - PUT user.php?post=update&id=$id
    - DELETE user.php?post=delete&id=$id

Before we going to CRUD Procedural we have to create a database

## first, CREATE DATABASE

- berita (no_berita, no_kategori, username, judul_berita, headline_berita, isi_berita, hari, tgl_berita, jam_berita, gambar_berita)
- kategori (no_kategori, nama_kategori, gambar_kategori)
- reporter (username, password, nama_lengkap, email, no_ho, gambar_reporter)

### Cretea Database
```mysql
CREATE DATABASE IF NOT EXISTS berita_upn;
``` 
### Create Table berita
```mysql
    CREATE TABLE berita(
        no_berita int(3) PRIMARY KEY AUTO_INCREMENT,
        no_kategori int(3) NOT NULL,
        username varchar(30) NOT NULL,
        judul_berita varchar(50) NOT NULL,
        headline_berita varchar(50) NOT NULL,
        isi_berita text NOT NULL,
        tgl_berita DATE NOT NULL,
        jam_berita TIMESTAMP NOT NULL,
        gambar_berita VARCHAR(100)
    );
```
### Create Table kategori
```mysql
    CREATE TABLE kategori(
        no_kategori int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nama_kategori varchar(50) NOT NULL,
        gambar_kategori text
    );
```
###  Create Table Reporter
```mysql
    CREATE TABLE reporter(
        username varchar(50) NOT NULL PRIMARY KEY,
        password varchar(50) NOT NULL,
        nama_lengkap varchar(100) NOT NULL,
        email varchar(50) NOT NULL,
        no_hp varchar(12),
        gambar_reporter text
    );
```

