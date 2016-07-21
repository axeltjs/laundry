<?php 

class modul 
{
	
	public $connection;

	function __construct()
	{
		$this->connection = new mysqli("localhost","root","","db_laundry");
	}

	public function redirect($link){
		echo '<script type="text/javascript"> window.location = "'.$link.'" </script>';
	}

	public function delete($table,$field,$id){
		mysqli_query($this->connection,"DELETE FROM $table WHERE $field = '$id' ");
	}

	public function kode($table,$id,$start,$end,$kode){
		$get = mysqli_query($this->connection,"SELECT * FROM $table ORDER BY '$id' DESC LIMIT 0,1 ");
		$rs = mysqli_fetch_array($get);
		$ambil = substr($rs[$id], $start,$end) + 1;
		$jadi = $kode.sprintf("%0".$end."s",$ambil);

		return $jadi;
	}

	public function get($table,$select,$where,$order){
		$ambil = mysqli_query($this->connection,"SELECT $select FROM $table $where $order");
		while($rs = mysqli_fetch_array($ambil))
			$data[] = $rs;
		return $data;
	}

	public function jk($jenkel){
		switch ($jenkel) {
			case 'L':
					return "Laki - Laki";
				break;
			
			case 'P':
				return "Perempuan";
				break;
		}
	}


	public function tgl($tanggal){
		$thn = substr($tanggal, 0,4);
		$bln = substr($tanggal, 5,2);
		$tgl = substr($tanggal, 8,2);

		return $tgl."-".$this->bulan($bln)."-".$thn;
	}

	public function bulan($bulan){
		switch ($bulan) {
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;

			default:
				return $bulan;
				break;
		}
	}

	public function header($hd){
		switch ($hd) {
			case 'admin':
				return "Administrator";
				break;
			case 'operator':
				return "Operator";
				break;
			case 'kasir':
				return "Cashier";
				break;
			
		}
	}
}

 ?>