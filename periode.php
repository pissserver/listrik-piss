<?php
	session_start();
	include "connection.php";
	include "components/role_session.php";
	
	function headScript(){
		$headScript=file_get_contents("headScript.html");
		return $headScript;
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="img/logo.png">
        <link rel="shortcut icon" href="img/logo.png" />
        <title>Periode Tagihan | PISS</title>

        <?php echo headScript(); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.min.js"></script>
        <script>
            /* hide all elements & show preloader*/
            document.documentElement.className += 'js';
            /* display variabel */
            var alertLoadProcess = "<span class='alert alert-info' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
        </script>
    </head>
    <body>
        <div id="wrapper">
            <?php include "components/sidebar.php"; ?>

            <div id="page-wrapper">
                <div class="row"><br><br><br><br>
                    <div class="col-lg-4" style="padding:10px;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-clock-o fa-fw"></i> Periode Tagihan Listrik
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" id="form" name="form" method="POST" action="periode_action.php?task=insert">
                                    <div class="form-group" style="padding:10px;">
                                        <label>Periode Tagihan Listrik</label>
                                        <select class="form-control" name="periode" id="periode" required>
                                            <?php 
                                                $month 	= date('M Y');
                                                $month2 = date("M Y",strtotime("+29 day"));
                                                $vmonth = date('mY');
                                                $vmonth2 = date("mY",strtotime("+29 day"));
                                            ?>
                                            <option value="<?php echo $vmonth;?>"><?php echo $month; ?></option>
                                            <option value="<?php echo $vmonth2;?>"><?php echo $month2;?></option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="padding:10px;">
                                        <center><button type="submit" class="btn btn-outline btn-block btn-primary">Simpan</button></center>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8" style="margin-top:20px;">
                        <div id="Area1">
                            <div class="alert alert-info" onclick="clearNotif()">
                                <center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Ganti Password -->
        <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
                        <h4 id="header_password">Ganti Password</h4>
                    </div>
                    <div class="modal-body">
                        <div id="data_password" style="margin-bottom: 0px;">
                            <div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
                        </div>
                        <input type="hidden" id="value_id" />
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        
        <script>
        $(document).ready(function(){
                // Auto Refresh Page
                $("#notifArea").html(alertLoadProcess);
                $('#Area1').load("periode_table.php",function(){clearNotif();});
                setTimeout('$("html").removeClass("js")',1000); 
                
                //Modal Ganti Password
                $('#modalPassword').on('shown.bs.modal', function (e) {
                    $("#notifArea").html(alertLoadProcess);
                    $("#data_password").load("password.php",function(){clearNotif();});
                })
            });
            function clearNotif(){$("#notifArea").html("");}
        </script>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>
    </body>
</html>