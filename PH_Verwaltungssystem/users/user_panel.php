<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="../css/us_style.css" rel="stylesheet">

</head>
<body>
  
<a href="?logout">
<input class="logout" type="image" src="../images/logout.png" name="logout" title="Abmelden"/>
</a>

<div id="mySidenav" class="sidenav">
  <a href="control_panel.php">System steuerung</a>
  <label class="cardsXlabel">Powered by:</label>
  <input class="cardsX_logo" type="image" src="../images/cards_x_logo.png" name="cardsX_logo" onclick="openCards()"/>
</div>

<script>
  function openCards() {
    window.open("https://cards-x.de");
  }
</script>
   
</body>
</html> 
