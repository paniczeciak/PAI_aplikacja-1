<?php
  session_start();
  if (!isset($_SESSION["logged"]) || session_status() != 2){
    header("location: ../");
  }else{
   switch($_SESSION["logged"]["role_id"]){
     case 1:
        $role_path = "logged_user";
       break;
	   case 2:
		    $role_path = "logged_moderator";
		    break;
	   case 3:
		    $role_path = "logged_admin";
		  break;
    }
  }

if (isset($_SESSION["logged"]["last_activity"])) {
    $sessionTimeout = 30; // Czas wygaśnięcia sesji w sekundach

    // Sprawdź, czy sesja jest aktywna
    if (time() - $_SESSION["logged"]["last_activity"] <= $sessionTimeout) {
        // Odśwież czas ostatniej aktywności
        $_SESSION["logged"]["last_activity"] = time();

        echo "<script>console.log('Sesja aktywna')</script>";
    } else {
        echo "<script>console.log('Sesja nieaktywna')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php switch($_SESSION["logged"]["role_id"]){
          case 1:
              echo "Kukła | Rezerwacja stolików";
              break;
          case 2:
              echo "Kukła | Pracownik |";
              break;
          case 3:
              echo "Kukła | Admin | Użytkownicy";
              break;
      } ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

 </head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../../dist/img/logo-kukla-inicjal.png" alt="KukłaLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php
    require_once "./$role_path/navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
	<?php
	  require_once "./$role_path/aside.php";
	?>

  <!-- Content Wrapper. Contains page content -->
	<?php
	  require_once "./$role_path/content.php";
	?>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
	<?php
	  require_once "./footer.php";
	?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>


<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>


</body>
</html>
