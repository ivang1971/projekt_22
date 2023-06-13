<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../css/ad_panel.css" rel="stylesheet">

<title>Kunden verwaltung</title>

</head>
<body>
<a href="?logout">
<input class="logout" type="image" src="../images/logout.png" name="logout" title="Abmelden"/>
</a>
<div id="mySidenav" class="sidenav">
  <a href="user_table.php">Kunden</a>
  <a href="admin_portal.php">Admin</a>
  <label class="cardsLabel">Powered by:</label>
  <input class="cardsXlogo" type="image" src="../images/cards_x_logo.png" name="cardsXlogo" onclick="openCardsX()"/>
</div>

<script>
  function openCardsX() {
    window.open("https://cards-x.de");
  }
</script>

</body>
</html> 
