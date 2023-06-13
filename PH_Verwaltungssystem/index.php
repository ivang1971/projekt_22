<?php require("admin/admin_login.class.php") ?>

<?php

if (isset($_POST['user_login'])) {
    $filePath = 'admin/dacs/count/HKD_' . $_POST['username'] . '.pwd';

    if (file_exists($filePath)) {
        $storedPassword = file_get_contents($filePath);
        if (!empty($storedPassword) && ($storedPassword == $_POST['password'])) {
            session_start();
            $_SESSION["user"] = $_POST['username'];
            header("location: users/control_panel.php"); 
            exit();
        } else {
            echo '<label class="error_lbl">*Falsche Kennwort</label>';
        }
    } else {
        echo '<label class="error_lbl">*Benutzername existiert nicht</label>';
    }

}

if(isset($_POST["admin_login"])){
    $admins = new LoginAdmin($_POST["username"], $_POST["password"]);
}

?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Parkhaus verwaltungssystem</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="css/style.css" rel="stylesheet">

</head>
<body class="hin_f" name="hin_f">
    
    <div class="header">
        <h1>PARKHAUS</br>VERWALTUNGSSYSTEM</h1>
    </div>

    <div class="container" name="container">
        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <label class="user_label" for="username" name="ad_label">Benutzername</label>
            <input class="user" type="text" name="username" title="Geben Sie Ihre Benutzername ein"></input>
            <label class="pass_label" for="password" name="kw_label">Kennwort</label>
            <input class="password" type="password" name="password" title="Geben Sie Ihr Kennwort ein"></input>
            <button type="submit" class="user_login" name="user_login">Anmelden</button>
        </form>
    </div>

    <input class="admin_img" type="image" src="images/admin_login.png" name="admin_img" title="Admin Anmelden" onclick="openForm()"/>
    
    <div class="form-popup" id="myForm">
        <form class="form-container" action="" method="post" enctype="multipart/form-data" autocomplete="off">
            <h1 class="ad_lbl">Admin Login</h1>
            <label for="username"><b>Benutzer</b></label>
            <input type="text" name="username" title="Geben Sie Ihre Benutzername ein">
            <label for="psw"><b>Kennwort</b></label>
            <input type="password" name="password" title="Geben Sie Ihr Kennwort ein">
            <button type="submit" class="btn_login" name="admin_login">Anmelden</button>
            <button type="button" class="btn_close" onclick="closeForm()">Schließen</button>
            <p class="error"><?php echo @$admins->error ?></p>
            <p class="success"><?php echo @$admins->success ?></p>

        </form>
    </div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>