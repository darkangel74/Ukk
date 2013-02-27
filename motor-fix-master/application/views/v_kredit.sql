create view v_kredit as (
select 	tb_motor.kode_motor as motor_kode_motor,
		tb_motor.merek as merek,
		tb_motor.harga as harga,
		tb_beli_kredit.kode_kredit as kode_kredit,
		tb_beli_kredit.tanggal_kredit as tanggal_kredit,
		tb_beli_kredit.kode_customer as kode_customer,
		tb_beli_kredit.kode_motor as kode_motor,
		tb_beli_kredit.warna as warna,
		tb_beli_kredit.uang_muka as uang_muka,
		tb_beli_kredit.lama_cicilan as lama_cicilan,
		tb_beli_kredit.sisa as sisa,
		tb_beli_kredit.keterangan as keterangan,
		tb_beli_kredit.harga_deal as harga_deal,
		tb_customer.kode_customer as customer_kode_customer,
		tb_customer.nama as nama
		
from	(
			(
				tb_beli_kredit 
					join tb_motor on(
						(tb_motor.kode_motor = tb_beli_kredit.kode_motor)
					)
			)
					join tb_customer on(
						(tb_customer.kode_customer = tb_beli_kredit.kode_customer)
					)			
		)
)