<?php

    // sql info
    $host = "localhost";
    $user = "root";
    $pass = "";

    // our db
    $nama_db = "db_sekolah";
    
    // actually connect
    $koneksi = mysqli_connect($host,$user,$pass,$nama_db);

    if(!$koneksi)
    { 
        die ("koneksi database gagal: ".mysqli_connect_error());
    }

?>