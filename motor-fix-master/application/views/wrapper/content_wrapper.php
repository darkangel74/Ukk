<html>
	<head>
		<title>Jual Beli Motor | <?php if(!$title == "") { echo $title; }  ?></title>
	</head>
	<body>
    <?php
	if($this->session->userdata('usertype') == '1'){//topmanager
		echo "<a href='".site_url('user')."'> Daftar petugas | </a>";
		echo "<a href='".site_url('pelanggan')."'> Lihat Pelanggan | </a>";
		echo "<a href='".site_url('motor')."'> Lihat Motor | </a>";
		echo "<a href='".site_url('pelanggan') ."'> Lihat Pelanggan | </a>";
		echo "<a href='".site_url('kredit')."'> Lihat Kredit | </a>";
		echo "<a href='".site_url('cash')."'> Lihat Cash | </a>";
		
		
	}elseif($this->session->userdata('usertype') == '0'){//admin
		echo "<a href='".site_url('user/add')."'>Tambah petugas | </a>";
		echo "<a href='".site_url('motor/add')."'>Tambah Motor | </a>";
		echo "<a href='".site_url('bunga/add')."'>Tambah Paket kredit Bunga| </a>";
		echo "<a href='".site_url('user/add')."'>Tambah petugas | </a>";
		echo "<a href='".site_url('user')."'> Daftar petugas | </a>";
		echo "<a href='".site_url('pelanggan')."'> Lihat Pelanggan | </a>";
		echo "<a href='".site_url('motor')."'> Lihat Motor | </a>";
		echo "<a href='".site_url('pelanggan') ."'> Lihat Pelanggan | </a>";
		echo "<a href='".site_url('kredit')."'> Lihat Kredit | </a>";
		echo "<a href='".site_url('cash/add')."'> Lihat Kredit | </a>";

	}elseif($this->session->userdata('usertype') == '2'){ //petugas
		echo "<a href='".site_url('pelanggan/add')."'>Tambah Pelanggan | </a>";
		echo "<a href='".site_url('cash/add')."'>Pembelian Cash | </a>";
		echo "<a href='".site_url('kredit/add')."'>Pembelian Kredit | </a>";
		echo "<a href='".site_url('cicilan/nama_cek')."'>Pembayaran Cicilan | </a>";
	}else{
		echo "belum login";
	}
	?>
     <img src="">
        <a href="<?php echo site_url('user/logout') ?>">Logout </a>
		<?php if(!empty($content)){
			echo $content; 	
		}
		else{
			$this->load->view('wrapper/beranda') 	;
		} 
		?>
	</body>
</html>