<?php 
    class Produk{
        private $dbh;
        public function __construct($dbh){
            $this->dbh = $dbh;
        }

        public function dataProduk(){
            $sql="SELECT * FROM Produk";
            $rs = $this->dbh->query($sql);
            return $rs;
        }
        
        public function getAllJenis(){
            $sql = "SELECT * FROM jenis_produk";
            // fungsi query, eksekusi query dan ambil datanya
            $rs = $this->dbh->query($sql); 
            return $rs;
        }

        public function simpan($data){
            $sql = "INSERT INTO produk(kode,nama,harga,stok,min_stok,idjenis)
                    VALUES (?,?,?,?,?,?)";
            // prepare statement PDO
            $ps = $this->dbh->prepare($sql); 
            $ps->execute($data);
        }

        public function getProduk($id) {
            $sql = "SELECT produk.*, jenis_produk.nama AS kategori 
                    FROM produk 
                    INNER JOIN jenis_produk ON jenis_produk.id = produk.idjenis
                    WHERE produk.id = ?";
            
            $ps = $this->dbh->prepare($sql); 
            $ps->execute([$id]);
            $rs = $ps->fetch(PDO::FETCH_ASSOC); // Use FETCH_ASSOC for array
            return $rs;
        }

        public function ubah($data){
            $sql = "UPDATE produk SET kode=?, nama=?, harga=?, stok=?, min_stok=?, idjenis=? WHERE id=?";
            // prepare statement PDO
            $ps = $this->dbh->prepare($sql); 
            $ps->execute($data);
        }
    }
?>