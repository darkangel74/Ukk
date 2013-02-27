create view v_cicilan as(
	select 		tb_bayar_cicilan.nomor_bayar as nomor_bayar,
				tb_bayar_cicilan.kode_kredit as kode_kredit,
				tb_bayar_cicilan.tanggal_bayar as tanggal_bayar,
				tb_bayar_cicilan.jumlah as jumlah,
				tb_beli_kredit.sisa as sisa_bayar
	from tb_bayar_cicilan join tb_beli_kredit on(tb_bayar_cicilan.kode_kredit = tb_beli_kredit.kode_kredit)
)