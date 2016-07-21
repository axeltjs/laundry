<?php include '../_header2.php'; ?>

<body onload="showit()"></body>
<h2>Laporan Data Transaksi</h2>

<input type="date" style="float:left; margin-right:3px;" id="cari"><a class="btn" style="float:left;"  onclick="cari()"><i class="fa fa-search"></i></a>

<input style="float:right;" type="text" onchange="carilagi()" onkeypress="carilagi()" id="nama" placeholder="Pencarian ..." > 
<br> <br>
<div id="tb"></div>


<script type="text/javascript">
	function showit(){
		$.ajax({
			type:"GET",
			url:"cari.php",
			data:"cari=",
			success:function(html){
				$("#tb").html(html);
			}
		})
	}

	function cari(){
		var cari = $("#cari").val();
		$.ajax({
			type:"GET",
			url:"cari.php",
			data:"cari="+cari,
			success:function(html){
				$("#tb").html(html);
			}
		})
	}

	function carilagi(){
		var nama = $("#nama").val();
		$.ajax({
			type:"GET",
			url:"cari2.php",
			data:"nama="+nama,
			success:function(html){
				$("#tb").html(html);
			}
		})
	}
</script>

<?php include '../_footer2.php'; ?>