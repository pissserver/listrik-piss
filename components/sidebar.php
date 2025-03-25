<?php
	function isActive($pages) {
		// return basename($_SERVER['PHP_SELF']) == $pages ? 'active' : '';
		return in_array(basename($_SERVER['PHP_SELF']), $pages) ? 'active' : '';
	}

	function isParentActive($pages) {
		return in_array(basename($_SERVER['PHP_SELF']), $pages) ? 'active' : '';
	}

	function greeting() {
		$hour = date('H');
	
		if ($hour >= 5 && $hour < 12) {
			return "Selamat pagi, ";
		} elseif ($hour >= 12 && $hour < 18) {
			return "Selamat siang, ";
		} elseif ($hour >= 18 && $hour < 21) {
			return "Selamat sore, ";
		} else {
			return "Selamat malam, ";
		}
	}

	$greetingMessage = greeting();
?>

<style>
    .silhouette {
        font-weight: bold;
        font-size: 20px;
        background: linear-gradient(120deg, #ffffff 30%, #ec9841 50%, #ffffff 70%);
        background-size: 200% auto;
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        animation: silhouetteMove 5s linear infinite;
    }

    @keyframes silhouetteMove {
        0% { background-position: 200% center; }
        100% { background-position: -200% center; }
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0; background-color: #428bca;">
	<div class="navbar-header bg-primary">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php" style="color: #ffffff;"><i class="fa fa-bolt fa-fw silhouette"></i> <b class="silhouette">LISTRIK PISS</b></a>
    </div>
			
	<ul class="nav navbar-top-links navbar-right">
		<?php include 'components/offcanvas_note.php'; ?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" 
			style="color: #ffffff !important; background-color: transparent !important;"
			onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'" 
			onmouseout="this.style.backgroundColor='transparent'">
				<i class="fa fa-user fa-fw" style="color: #ffffff;"></i>
				<span style="color: #ffffff;"><?php echo $greetingMessage; ?></span>
				<b style="text-transform: capitalize; color: #ffffff;"><?php echo $role == 'Cashier' ? 'Kasir - '.$name : ($role == 'pp' ? 'PP - '.$name : 'SPV - ' . $name); ?>&nbsp;</b>
				<i id="dropdownIcon" class="fa fa-angle-down" style="color: #ffffff;"></i>
			</a>
			<ul class="dropdown-menu dropdown-user" style="width: 200px; margin-right: 10px; margin-top: 10px; border: 3px solid #ffffff; background-color: #428bca; border-radius: 10px;">
				<li>
					<a data-toggle="modal" data-target="#modalPassword" href="#" 
					style="color: #ffffff; font-size: 15px; display: block; padding: 10px; text-decoration: none;"
					onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'; this.style.color='#ffffff';"
					onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffffff';">
						<div class="name" style="display: inline-block; padding-right: 30px; padding-left: 10px;">
							Ganti Password 
						</div>
						<div class="icon" style="display: inline-block;">
							<i class="fa fa-lock fa-fw" style="color: #ffffff; font-size: 15px;"></i>
						</div>
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a data-toggle="modal" data-target="#modalLogout" href="#" 
					style="color: #ffffff; font-size: 15px; display: block; padding: 10px; text-decoration: none;"
					onmouseover="this.style.backgroundColor='rgb(103, 165, 218)'; this.style.color='#ffffff';"
					onmouseout="this.style.backgroundColor='transparent'; this.style.color='#ffffff';">
						<div class="name" style="display: inline-block; padding-right: 95px; padding-left: 10px;">
							Keluar
						</div>
						<div class="icon" style="display: inline-block;">
							<i class="fa fa-sign-out fa-fw" style="color: #ffffff; font-size: 15px;"></i>
						</div>
					</a>
				</li>
			</ul>
		</li>
	</ul>

			<!-- Modal Password -->
			<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content">
						<div class="modal-header bg-primary text-white" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
							<h4 id="header_password"><i class="fa fa-lock fa-fw"></i>&nbsp;Ganti Password</h4>
							<button style="margin-top: -35px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="data_password" style="margin-bottom: 0px;">
								<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
							</div>
							<input type="hidden" id="value_id" />
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Logout -->
			<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="modalLogoutLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white" style="border-top-left-radius: 5px; border-top-right-radius: 5px;">
							<h5 class="modal-title" id="modalLogoutLabel"><b>KONFIRMASI KELUAR</b></h5>
							<button style="margin-top: -20px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Apakah Anda yakin ingin keluar?</p>
						</div>
						<div class="modal-footer d-flex justify-content-between">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<a href="logout.php" class="btn btn-primary">Keluar</a>
						</div>
					</div>
				</div>
			</div>
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a class="<?= isActive(['dashboard.php']); ?>" href="dashboard.php"><i class="fa fa-bar-chart fa-fw"></i> Dashboard</a></li>

						<li class="<?= isParentActive(['tarif.php', 'tarif2.php']); ?>">
							<a href="#"><i class="fa fa-credit-card fa-fw"></i> Daftar Biaya<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="<?= isActive(['tarif.php']); ?>" href="tarif.php"><i class="fa fa-flash fa-fw"></i> Biaya Listrik</a></li>
								<li><a class="<?= isActive(['tarif2.php']); ?>" href="tarif2.php"><i class="fa fa-suitcase fa-fw"></i> Biaya Perlengkapan Listrik</a></li>
							</ul>
						</li>

						<li class="<?= isParentActive(['register.php', 'merchant.php']); ?>">
                            <a href="#"><i class="fa fa-user fa-fw"></i> Pengguna Listrik<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="<?= isActive(['register.php']); ?>" href="register.php"><i class="fa fa-user-plus fa-fw"></i> Tambah Pengguna</a></li>
								<li><a class="<?= isActive(['merchant.php']); ?>" href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pengguna Listrik</a></li>
							</ul>
						</li>
						<li class="<?= isParentActive(['periode.php', 'invoice.php', 'invoice_cancel.php']); ?>">
                            <a href="#"><i class="fa fa-clipboard fa-fw"></i> Tagihan Listrik<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="<?= isActive(['periode.php']); ?>" href="periode.php"><i class="fa fa-clock-o fa-fw"></i> Periode Tagihan</a></li>
								<li><a class="<?= isActive(['invoice.php']); ?>" href="invoice.php"><i class="fa fa-print fa-fw"></i> Cetak Tagihan</a></li>
								<li><a class="<?= isActive(['invoice_cancel.php']); ?>" href="invoice_cancel.php"><i class="fa fa-close fa-fw"></i> Pembatalan Tagihan</a></li>
							</ul>
						</li>
						<li class="<?= isParentActive(['pay.php', 'pay_cancel.php']); ?>">
                            <a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="<?= isActive(['pay.php']); ?>" href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran Tagihan</a></li>
								<li><a class="<?= isActive(['pay_cancel.php']); ?>" href="pay_cancel.php"><i class="fa fa-close fa-fw"></i> Pembatalan Pembayaran</a></li>
							</ul>
						</li>
						<li><a class="<?= isActive(['note.php']); ?>" href="note.php"><i class="fa fa-file-text-o fa-fw"></i> Catatan Untuk Pelanggan</a></li>
						<li><a class="<?= isActive(['report.php']); ?>" href="report.php"><i class="fa fa-clipboard fa-fw"></i> Laporan</a></li>
                    </ul>
                </div>
            </div>
            </nav>

<!-- <script>
    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const remainingSeconds = seconds % 60;
        return `${hours}j ${minutes}m ${remainingSeconds}d`;
    }

    function startWorkTime() {
        let loginTime = localStorage.getItem('loginTime');

        if (!loginTime) {
            loginTime = new Date().getTime();
            localStorage.setItem('loginTime', loginTime);
        }

        setInterval(function() {
            const currentTime = new Date().getTime();
            const timeElapsed = Math.floor((currentTime - loginTime) / 1000);
            const formattedTime = formatTime(timeElapsed);
            document.getElementById('workHoursLink').innerHTML = `<i class="fa fa-clock-o fa-fw"></i> Jam Kerja : ${formattedTime}`;
        }, 1000);
    }

    function logout() {
        localStorage.removeItem('loginTime');
		localStorage.removeItem('notificationHidden');
    }

    startWorkTime();

    document.getElementById("logoutButton").addEventListener("click", function() {
        logout();
    });
</script> -->

<script>
	$(document).ready(function() {
		$(".dropdown").on("shown.bs.dropdown", function() {
			$("#dropdownIcon").removeClass("fa-angle-down").addClass("fa-angle-up");
		});

		$(".dropdown").on("hidden.bs.dropdown", function() {
			$("#dropdownIcon").removeClass("fa-angle-up").addClass("fa-angle-down");
		});
	});
</script>

