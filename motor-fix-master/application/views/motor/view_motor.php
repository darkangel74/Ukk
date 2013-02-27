<?php echo $this->session->flashdata('message'); ?>
<?php echo $pagination; ?>
<table border="1" cellpadding="3" cellspacing="3">
    <tbody>
        <tr>
            <th>No</th>
            <th>Kode Motor</th>
            <th>Merek</th>
            <th>Warna</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Image</th>
            <th>Aksi</th>
        </tr>
        <?php
        if (!empty($list)) {
            foreach ($list as $key => $row) {
              
                ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $row['kode_motor'] ?></td>
                    <td><?php echo $row['merek'] ?></td>
                    <td><?php echo $row['warna'] ?></td>
                    <td><?php echo $row['harga'] ?></td>
                    <td><?php echo $row['stok'] ?></td> 
                    <?php if (empty($row['image']))
                    {
                        ?>
                    <td><img src="<?php echo base_url(); ?>assets/motor/default.png" width="100px" height="100px"/></td>

                    <?php } else{?>
                    <td><img src="<?php echo base_url(); ?>assets/motor/<?php echo $row['image']?>" width="100px" height="100px"/></td><?php }?>
                    <td><a class="edit" href="<?php echo site_url('motor/update/' . $row['kode_motor']) ?>">Edit</a>
                        <a class="hapus" onclick="return confirm('Are you sure to delete this data?')" href="<?php echo site_url('motor/do_delete/' . $row['kode_motor']) ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td>Tidak ada data yang ditampilkan</td></tr>';
        }
        ?>
    </tbody>
</table>
