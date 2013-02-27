<?php echo $this->session->flashdata('message'); ?>
<?php echo validation_errors(); ?>
<script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery-1.7.min.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function()
    {
        $('#merek').change(function()
        {
            var id = {id:$(this).val()};
            $.ajax(
            {
                type	: "POST",
                url		: "<?php echo site_url('kredit/ajax_warna'); ?>",
                data	: id,
                success : function(msg)
                {
                    $('#warna').html(msg);
                }
            }
        );
            $.ajax(
            {
                type	: "POST",
                url		: "<?php echo site_url('kredit/ajax_harga'); ?>",
                data	: id,
                success : function(msg)
                {
                    $('#harga').val(msg);
                    $('#harga_dua').val(msg);
                }
            });				
        });
        
    });	
</script>

    <a href="<?php echo site_url('kredit/to_pdf') ?>"> | Cetak Pembelian Kredit</a></span>
<form action=<?php echo site_url('kredit/do_add') ?> method="post" class="form_utama" >
    <table cellpadding="3" cellspacing="3">		
        <tr>
            <td>Merek</td>
            <td>:</td>
            <td><?php echo form_dropdown('merek', $motor, '', 'id="merek"'); ?></td>
        </tr>
        <tr>
            <td>Warna</td>
            <td>:</td>
            <td><?php echo form_dropdown('warna', array('silahkan pilih dulu'), '', 'id="warna"'); ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>:</td>
            <td><?php echo form_dropdown('pelanggan', $cust, '', ''); ?></td>
        </tr>
        <tr>
            <td>harga</td>
            <td>:</td>
            <td>
                <input type="text" value="0" size="10" id="harga" name="harga" disabled="disabled">
                <input type="hidden" value="0" size="10" name="harga" id="harga_dua">
            </td>
        </tr>
        <tr>
            <td>uang muka</td>
            <td>:</td>
            <td><?php echo form_dropdown('uang_muka', $uangmuka, ''); ?></td>
        </tr>
        <tr>
            <td>Jumlah Cicilan</td>
            <td>:</td>
            <td><?php echo form_dropdown('lama_cicilan', $cicilan, '', 'id="cicilan"'); ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><textarea name="keterangan"><?php echo set_value('keterangan') ?></textarea></td>
        </tr>
        <tr>
            <td colspan='3'><input name='submit' type='submit' value='submit'></td>
        </tr>
    </table>
</form>