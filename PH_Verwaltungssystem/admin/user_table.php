<?php
  session_start();

  if(!isset($_SESSION["admins"])){
    header("location: ../index.php"); 
    exit();
  }

  if(isset($_GET["logout"])){
    unset($_SESSION["admins"]);
    header("location: ../index.php"); 
    exit();
  }
?>

<!DOCTYPE html>

<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include_once 'admin_panel.php'; ?>
<link href="../css/ad_panel.css" rel="stylesheet">

<h1 class="cs_lbl">Kundenverwaltung</h1>
<table class="limit_tbl" borders="2" cellpadding="5" cellspacing="3">
    <tr>
        <th style="width:350px">Name(Firma)</th>
        <th style="width:150px">Parkplatz limit</th>
        <th style="width:150px">Nutzung</th>
        <th style="width:100px">Bearbeiten</th>
        <th style="width:100px">Löschen</th>
        <th style="width:100px">Steuerung</th>
    </tr>

<?php
$allClientLimitFiles = glob('dacs/count/*.lim');
sort($allClientLimitFiles);

foreach ($allClientLimitFiles as $clientLimitFile){  
    $clientName = str_replace('HKD_', '', pathinfo($clientLimitFile, PATHINFO_FILENAME));
    $clientCountFile = 'dacs/count/HKD_' . $clientName . '.cnt';
    $clientPassword = 'dacs/count/HKD_' . $clientName . '.pwd';
    if (file_exists($clientPassword)) {
        $clientPass = file_get_contents($clientPassword);
    } else {
        $clientPass = "";
    }
    if (file_exists($clientCountFile)) {
        $clientCount = file_get_contents($clientCountFile);
    } else {
        $clientCount = 0;
    }
    $clientLimit = file_get_contents($clientLimitFile);
    

    echo '<tr>';
    echo '<td id="file_name1" name="file_name1">' . $clientName;
    echo '<td id="cont_field" style="text-align:center;">' . $clientLimit;
    echo '<td id="cont_field" style="text-align:center;">' . $clientCount;
    echo '<td><input type="image" name="edit" title="Kundendaten bearbeiten" id="edit" onclick=openEdForm("' . $clientName . '","' . $clientPass . '","' . $clientLimit . '","' . $clientCount . '") src="../images/edit_btn.png" style="height:20px">';
    echo '<td><input type="image" id="delete" name="delete" title="Kundendaten löschen" onclick=openDelForm("' . $clientName . '") src="../images/delete_btn.png" style="height:20px">';
    echo '<td><input type="image" id="wehicleCtrl" name="wehicleCtrl" title="Steuerung der Schrankenanlage" onclick=openByName("' . $clientName . '") src="../images/parking_icon.png" style="height:20px">';
    echo '</tr>';    
}
echo '</table>';
    
?>

<label class="newUserLabel"><b>Kunde Hinzufügen</b></label>
<input class="new_user_img" type="image" src="../images/add_user.png" name="new_admin_img" title="Neu Kunde hinzufügen" onclick="openUsForm();"/>

<div class="newUser-popup" id="newUserForm">
    <form class="us-form-container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="us_ed_lmt">Neu Kunde</h1>
        <label class="us_txt_lbl" for="file_name"><b>Name(Firma)</b></label>
        <input type="text" class="us_name_lbl" name="us_nameLbl" id="us_nameLbl">
        <label class="us_password"><b>Kennwort</b></label>
        <input type="text" name="us_password" id="us_password">
        <label class="us_number"><b>Limit</b></label>
        <input type="number" min="0" id="us_limit" name="us_limit">
        <label class="cnt_number"><b>Nutzung</b></label>
        <input type="number" min="0" id="us_cnt_val" name="us_cnt_val">
        <input type="submit" class="us_btn" name="us_save" id="us_save" value="Speichern">
        <button type="button" class="us_btn_close" onclick="closeUsForm()">Schließen</button>
    </form>
</div>

<script>

function openUsForm() {
    document.getElementById("newUserForm").style.display = "block";
}

function closeUsForm() {
  document.getElementById("newUserForm").style.display = "none";
}

</script>

<?php

    if(isset($_POST["us_save"]) || isset($_POST["us_nameLbl"]) || isset($_POST["us_password"]) || isset($_POST["us_limit"]) || isset($_POST["us_cnt_val"])) {
        
        $newFile_name = $_POST['us_nameLbl'];
        $newPassword_user = $_POST["us_password"];
        $newLimit_var = $_POST["us_limit"];
        $newCount_var = $_POST['us_cnt_val'];
        $newSave = $_POST["us_save"];
        
        file_put_contents("dacs/count/HKD_$newFile_name.pwd", "$newPassword_user");
        file_put_contents("dacs/count/HKD_$newFile_name.lim", "$newLimit_var");
        file_put_contents("dacs/count/HKD_$newFile_name.cnt", "$newCount_var");
        
    }

?>

<div class="edit-popup" id="edForm">
    <form class="form-container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="ed_lmt">Bearbeiten</h1>
        <input type="varchar" class="nameEdit_lbl" name="nameLbl" id="nameLbl" readonly>
        <label class="password"><b>Kennwort</b></label>
        <input type="text" name="password" id="password">
        <label class="number"><b>Limit</b></label>
        <input type="number" min="0" id="limit" name="limit">
        <label class="cnt_number"><b>Nutzung</b></label>
        <input type="number" min="0" id="cnt_val" name="cnt_val">
        <input type="submit" class="btn" name="save" id="save" value="Speichern">
        <button type="button" class="btn_close" onclick="closeEdForm()">Schließen</button>
    </form>
</div>

<script>

function openEdForm(clientName, clientPassword, clientLimit, clientCount) {
    document.getElementById("edForm").style.display = "block";
    document.getElementById("nameLbl").value = clientName;
    document.getElementById("password").value = clientPassword;
    document.getElementById("limit").value = clientLimit;
    document.getElementById("cnt_val").value = clientCount;


}

function closeEdForm() {
  document.getElementById("edForm").style.display = "none";
}

</script>

<?php

    if(isset($_POST["save"]) || isset($_POST["nameLbl"]) || isset($_POST["password"]) || isset($_POST["limit"]) || isset($_POST["cnt_val"])) {
        
        $file_name = $_POST['nameLbl'];
        $password_user = $_POST["password"];
        $limit_var = $_POST["limit"];
        $count_var = $_POST['cnt_val'];
        $save = $_POST["save"];
        
        file_put_contents("dacs/count/HKD_$file_name.pwd", "$password_user");
        file_put_contents("dacs/count/HKD_$file_name.lim", "$limit_var");
        file_put_contents("dacs/count/HKD_$file_name.cnt", "$count_var");
        
    }

    if(isset($_POST['save'])) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

<div class="delete_popup" id="delForm">
    <form class="del_container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="del_lbl" id="del_label">Sind Sie sicher?</h1>
        <input type="text" class="delUser" name="delUser" id="delUser" value="<?php  echo $clientName; ?>">
        <input type="submit" class="btn_delete" id="userDel"name="delete_btn" value="LÖSCHEN">
        <button type="button" class="btn_cancel" id="cancel_btn" onclick="closeDelForm();">ABBRECHEN</button>
    </form>
</div>

<script>

function openDelForm(delLabel) {
    document.getElementById("delForm").style.display = "block";
    document.getElementById("delUser").value = delLabel;
}

function closeDelForm() {
  document.getElementById("delForm").style.display = "none";
}

</script>

<?php

    if(isset($_POST['delete_btn']) && !empty($_POST['delUser'])){

        $delButton = $_POST["delUser"];

        unlink("dacs/count/HKD_$delButton.pwd");
        unlink("dacs/count/HKD_$delButton.cnt");
        unlink("dacs/count/HKD_$delButton.lim");
    }

?>
<div class="car_form" id="car_in">
    <form class="car_container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <input type="varchar" class="car_lbl" id="car_lbl" name="car_lbl" readonly>
        <label class="carEin">EINFAHRT</label>
        <input type="submit" class="carIn_btn" id="carIn"name="carIn">
        <label class="carAus">AUSFAHRT</label>
        <input type="submit" class="carOut_btn" id="carOut"name="carOut">
        <button type="button" class="cancelCar" id="cancel_car" onclick="closeByName();">ABBRECHEN</button>
    </form>
</div>

<script>

function openByName(carOwner) {
    document.getElementById("car_in").style.display = "block";
    document.getElementById("car_lbl").value = carOwner;
}

function closeByName() {
  document.getElementById("car_in").style.display = "none";
}

</script>

<?php

    if(isset($_POST['carIn']) && isset($_POST['car_lbl'])) {
        $userCar = $_POST['car_lbl'];
        file_put_contents("../admin/dacs/count/open01.cmd","HKD_$userCar");
    }

    if(isset($_POST['carIn'])) {
        echo "<meta http-equiv='refresh' content='1'>";
      }

    if(isset($_POST['carOut']) && isset($_POST['car_lbl'])) {
        $user_car = $_POST['car_lbl'];
        file_put_contents("../admin/dacs/count/open02.cmd","HKD_$user_car");
    }

    if(isset($_POST['carOut'])) {
        echo "<meta http-equiv='refresh' content='1'>";
      }

?>

</html>