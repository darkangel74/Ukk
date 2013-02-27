create view v_cash as(
	select 	tb_beli_cash.kode_cash as kode_cash,
			tb_beli_cash.tanggal_cash as tanggal_cash,
			tb_customer.nama as nama,
			tb_motor.merek as merek,
			tb_beli_cash.harga_deal as harga_deal,
			tb_beli_cash.warna as warna
	from	(
				(
					tb_beli_cash 
						join tb_motor on(
							(tb_motor.kode_motor = tb_beli_cash.kode_motor)
						)
				)
						join tb_customer on(
							(tb_customer.kode_customer = tb_beli_cash.kode_customer)
						)			
			)	
)