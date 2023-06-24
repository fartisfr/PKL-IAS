<?php 
  
  include('koneksi.php');
  
  $id = $_GET['id'];
  
  $query = "SELECT * FROM postaudit WHERE kode = $id LIMIT 1";

//   Echo the query result
