<table class="data-table" border="1" cellpadding="3" cellspacing="3">
    <tbody>
        <tr>
            <th>No</th>
            <th>Kode Motor</th>
            <th>Merek</th>
            <th>Warna</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php
        if (!empty($list)) {
            foreach ($list as $key => $row) {
                ?>
                <tr>
                    <td><?php echo ++$key?> </td>
                    <td><?php echo $row['kode_motor']?></td>
                    <td><?php echo $row['merek']?></td>
                    <td><?php echo $row['warna']?></td>
                    <td><?php echo $row['harga']?></td>
                    <td><?php echo $row['stok']?></td>
                </tr>
        <?php
    }
} else {
    echo '<tr><td colspan="9">Tidak ada data yang ditampilkan</td></tr>';
}
?>
    </tbody>
</table>