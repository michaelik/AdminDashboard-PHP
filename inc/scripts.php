  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/chart.js/Chart.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <!-- <script src="js/demo/chart-area-demo.js"></script> -->
  <!-- <script src="js/demo/chart-pie-demo.js"></script> -->

  <!-- Custom JS -->
  <script src="js/custom.js"></script>

  <!-- Bootstrap SweetAlert -->
  <script src="vendor/sweetalert/sweetalert.min.js"></script>
  <script>
    <?php
      if (isset($_SESSION['status']) && !empty($_SESSION['status'])) 
      {
    ?>
      swal({
        title: "",
        text: "<?php echo $_SESSION['status']; ?>",
        type: "<?php echo $_SESSION['status_code']; ?>",
        showCancelButton: false,
        confirmButtonClass: "btn-primary",
        confirmButtonText: "Okay, done!",
        closeOnConfirm: true
      });
    <?php
        unset($_SESSION['status']);
       }
    ?>
  </script>
