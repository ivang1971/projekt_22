<?php
  session_start();
  if(!isset($_SESSION["user"])){
    header("location:../index.php"); 
    exit();
  }

  if(isset($_GET["logout"])){
    unset($_SESSION["user"]);
    header("location:../index.php"); 
    exit();
  }
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='refresh' content='60'>
    <link href="../css/us_style.css" rel="stylesheet">

    <title>System steuerung</title>
</head>
<body>

    <h1 class="title_st">SYSTEM STEUERUNG &nbsp;<?php echo strtoupper($_SESSION['user']); ?></h1>
    <?php include 'user_func.php'; ?>
    <?php include_once 'user_panel.php'; ?>

    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
    <label class="un_label">Verfügbare Plätze</label>
    <div class="units_container" name="units_container"><?php show_available_units();?></div>

    <label class="occ_label">Nutzung</label>
    <div class="occ_container" name="occ_container"><?php show_occupied_units();?></div>

    <label class="free_label">Freie Plätze</label>
    <div class="free_container" name="free_container"><?php show_free_units();?></div>

    <label class="entry_lbl">EINFAHRT >>></label>
    <div class="entry_container">
      <input class="park_ic" type="submit" name="park_img1" title="Steuerung Einfahrt">
    </div>

    <?php
      if(isset($_POST['park_img1'])){
        $user = $_SESSION['user'];
        file_put_contents("../admin/dacs/count/open01.cmd","HKD_$user");
      }

      if(isset($_POST['park_img1'])) {
        echo "<meta http-equiv='refresh' content='1'>";
      }
    ?>

    <label class="exit_lbl"><<< AUSFAHRT</label>
    <div class="exit_container">
      <input class="park_ex" type="submit" name="park_img2" title="Steuerung Ausfahrt" >
    </div>

    <?php
      if(isset($_POST['park_img2'])){
        $user = $_SESSION['user'];
        file_put_contents("../admin/dacs/count/open02.cmd","HKD_$user");
      }

      if(isset($_POST['park_img2'])) {
        echo "<meta http-equiv='refresh' content='1'>";
      }
    ?>

    </form>
</body>
</html>