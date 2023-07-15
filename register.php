<?php
/**
 * FUNCTION SECTION
 * 
 */

 function callback($data=null,$message="",$status="ERROR"){
     return json_encode([
         "STATUS" =>$status,
         "MESSAGE"=>$message,
         "DATA"   =>$data
     ]);
 }



/**
 * Connection Section
 * 
 */
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=cafe", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo callback(null,"Connection failed: " . $e->getMessage(),"ERROR");
    return;
}


/**
 * PROGRAM SECTION
 */

if(!isset($_POST['SEC']) && !isset($_GET['SEC'])){
    echo callback(null,'Section Tidak Ada','ERROR');
    return;
}

$SEC = 'NULL';
if(isset($_POST['SEC'])) $SEC = $_POST['SEC'];
if(isset($_GET['SEC'])) $SEC = $_GET['SEC'];

if($SEC == 'TES'){
    echo callback(null,"SEMUA OKE","SUCCESS");
    return;
}
if($SEC == 'DAFTAR'){
    if(isset($_POST['NAMA'])) $NAMA = $_POST['NAMA'];
    if(isset($_POST['PONSEL'])) $PONSEL = $_POST['PONSEL'];
    if(isset($_POST['ALAMAT'])) $ALAMAT = $_POST['ALAMAT'];
    if(isset($_POST['USERNAME'])) $USERNAME = $_POST['USERNAME'];
    if(isset($_POST['PASSWORD'])) $PASSWORD = $_POST['PASSWORD'];

    if(!$NAMA || !$PONSEL || !$ALAMAT || !$USERNAME || !$PASSWORD){
        echo callback(null,"Harap Isi Dengan Lengkap","ERROR");
        return;
    }
    
    $kueri = $conn->query("SELECT * FROM customer WHERE USERNAME = '$USERNAME' LIMIT 1")->fetch();
    if($kueri) {
        echo callback(null,"Akun Sudah Ada","ERROR");
        return;
    }

    $kueri = $conn->prepare("INSERT INTO customer (NAMA,PONSEL,ALAMAT,USERNAME,PASSWORD) values(?,?,?,?,?)");
    $kueri->execute([$NAMA,$PONSEL,$ALAMAT,$USERNAME,$PASSWORD]);

    if($kueri->rowCount()==0){
        echo callback(null,"Pendaftaran Gagal","ERROR");
        return;
    }
    else{
        echo callback(null,"Berhasil","SUCCESS");
        return;
    }

}else{
    echo callback(null,"Terjadi Kesalahan","ERROR");
    return;
}
?>