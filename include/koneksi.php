<?php
// class membuat koneksi
class Koneksi{

private $host,$username,$password,$database,$query;

//__construct merupakan fungsi yang dijalankan sebagai default fungsi ketika pembuatan objek
public function __construct($host,$username,$password,$database){
$this->host = $host;
$this->username = $username;
$this->password = $password;
$this->database = $database;
$this->hubungkan = mysqli_connect($this->server,$this->username,$this->password,$this->database) or die ("gagal terkoneksi ke database");
return $this->hubungkan; // fungsi __construct ini akan mengembalikan nilai true jika $this->hubungkan berhasil
}
// di bawah merupakan fungsi untuk melakukan query
public function query($sql){
$this->query = mysqli_query($this->hubungkan,$sql) or die (mysqli_error($this->hubungkan));
return $this->query;
}
// hasil query di jadikan array pada fungsi di bawah ini
public function fetch($hasil_sql){
return mysqli_fetch_array($hasil_sql);
}
// di bawah ini adalah fungsi untuk menutup koneksi ke database
public function close()
{
return mysqli_close($this->hubungkan);
}
}
?>
