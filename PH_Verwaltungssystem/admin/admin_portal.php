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
s
<?php require("reg_admin.class.php") ?>

<?php
    if(isset($_POST['new_ad_save'])){
        $user = new RegisterAdmin($_POST['newAdminName'], $_POST['new_ad_password']);
    }

    if(isset($_POST["delAdmin_btn"])){
        $user = new RegisterAdmin($_POST["delAdmin"], $_POST["delPass"]);
    }
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='refresh' content='5'>
    <link href="../css/ad_panel.css" rel="stylesheet">

    <title>Admin bereich</title>
</head>
<body>
   
<?php include_once 'admin_panel.php'; ?>
    
    <label class="admin_lbl">ADMIN BEREICH</label><br>
    
    <table class="admin_table" borders="2" cellpadding="5" cellspacing="3">
    <tr>
        <th class="th1" style="width:350px">Benutzername</th>
        <th style="width:350px">Kennwort</th>
    </tr>

    <?php

    $jsonFile = file_get_contents('admin_data.json');
    $adminFiles = json_decode($jsonFile, true);

    foreach ($adminFiles as $adminFile){
        echo '<tr>';
        echo '<td class="td1"id="admin_username" name="admin_username">' . $adminFile['username'];
        echo '<td id="admin_password" name="admin_password">' . $adminFile['password'];
        echo '<td><input type="image" name="edit_admin" id="edit_admin" title="Admindaten bearbeiten" onclick=openAdminForm("' . $adminFile['username'] . '","' . $adminFile['password'] . '") src="../images/edit_btn.png" style="height:20px">';
        echo '<td><input type="image" id="delete" name="delete" title="Admindaten löschen" onclick=openDelAdminForm("' . $adminFile['username'] . '") src="../images/delete_btn.png" style="height:20px">';
        echo '</tr>';
    }

    echo '</table>';

    ?>

<div class="admin-popup" id="adminForm">
    <form class="admin-container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="ad_titel">Bearbeiten</h1>
        <input type="varchar" class="ad_username" name="adminName" id="adminName" readonly>
        <label class="ad_password"><b>Kennwort</b></label>
        <input type="text" name="ad_password" id="adminPassword">
        <input type="submit" class="admin_save" name="ad_save" id="ad_save" value="Speichern">
        <button type="button" class="adClose" onclick="closeAdminForm()">Schließen</button>
    </form>
</div>

<script>

function openAdminForm(AdminUsername, AdminPassword) {
    document.getElementById("adminForm").style.display = "block";
    document.getElementById("adminName").value = AdminUsername;
    document.getElementById("adminPassword").value = AdminPassword;
}

function closeAdminForm() {
  document.getElementById("adminForm").style.display = "none";
}

</script>

<?php

if (isset($_POST['ad_save']) || isset($_POST['adminName']) || isset($_POST['ad_password'])) {
    $jsonData = file_get_contents('admin_data.json');
    $decodedData = json_decode($jsonData, true);
    $jsonName = $_POST['adminName'];
    $jsonPass = $_POST['ad_password'];
    $jsonSave = $_POST['ad_save'];

    for($i = 0; $i < count($decodedData); $i++) {
        if ($decodedData[$i]["username"] == $jsonName) {
            $decodedData[$i] = ["username" => $jsonName, "password" => $jsonPass];
        }
    }
    file_put_contents('admin_data.json', json_encode($decodedData, JSON_PRETTY_PRINT));
}

?>

<label class="newAdLabel"><b>Admin Hinzufügen</b></label>
<input class="new_admin_img" type="image" src="../images/add_user.png" name="new_admin_img" title="Neu Kunde hinzufügen" onclick="openNewAdminForm()"/>

<div class="newAdmin-popup" id="newAdminForm">
    <form class="new-admin-container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="new_ad_titel">Neue Admin</h1>
        <label class="new_adLabel" for="admin_name"><b>Benutzername</b></label>
        <input type="text" class="new_ad_username" name="newAdminName" id="newAdminName">
        <label class="new_ad_password"><b>Kennwort</b></label>
        <input type="text" name="new_ad_password" id="new_ad_password">
        <input type="submit" class="new_admin_save" name="new_ad_save" id="new_ad_save" value="Speichern">
        <button type="button" class="new_adClose" onclick="closeNewAdminForm()">Schließen</button>
    </form>
</div>

<script>

function openNewAdminForm(newAdminUsername, newAdminPassword) {
    document.getElementById("newAdminForm").style.display = "block";
}

function closeNewAdminForm() {
  document.getElementById("newAdminForm").style.display = "none";
}

</script>

<div class="deleteAdmin_popup" id="delAdminForm">
    <form class="delAdmin_container" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <h1 class="delAdmin_lbl" id="del_label">Sind Sie sicher?</h1>
        <input type="text" class="delAdmin" name="delAdmin" id="delAdmin" value="<?php  echo $adminFile["username"]; ?>">
        <input type="hidden" class="delPassword" name="delPass" id="delPass" value="<?php  echo $adminFile["password"]; ?>">
        <input type="submit" class="btn_deleteAd" id="adminDel" name="delAdmin_btn" value="DELETE" onclick="deleteUser();">
        <button type="button" class="btn_cancelAd" id="cancel_btnAd" onclick="closeDelAdminForm();">CANCEL</button>
    </form>
</div>

<script>

function openDelAdminForm(delAdminLabel) {
    document.getElementById("delAdminForm").style.display = "block";
    document.getElementById("delAdmin").value = delAdminLabel;
}

function closeDelAdminForm() {
  document.getElementById("delAdminForm").style.display = "none";
}

</script>

</body>
</html>