<?php
include "koneksi.php";
if (isset($_POST['perusahaan'])) {
    $perusahaan = $_POST["perusahaan"];

    $sql = "select * from auditplan where perusahaan ='$perusahaan'";

    $hasil = mysqli_query($connection, $sql);
    $no = 0;
    while ($data = mysqli_fetch_array($hasil)) {
        ?>
        <option value="<?php echo  $data['auditjob']; ?>"><?php echo $data['auditjob']; ?></option>
        <?php
    }
}
?>