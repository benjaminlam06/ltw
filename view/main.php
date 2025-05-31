
<?php if (isset($_SESSION['sv_login'])) {
		$vs=$_SESSION['sv_login'];
		echo "<h4>Xin chào sinh viên : ".$vs['HoTen']."</h4>";
} ?>