<!DOCTYPE html>
<html>
<head>
  <title>PHP Test</title>
</head>
<body>
 <?php
    $servername = "localhost";
    $dbname = "assignment7";
    $username = "root";
    $password = "root";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
?> 
<table>
  <tr>
    <th>Artist</th>
    <th>Album</th>

    <th>US Chart position</th>
    <th>UK Chart position</th>
    <th>German Chart position</th>
    <th>French Chart position</th>
    <th>Canadian Chart position</th>
    <th>Australian Chart position</th>

  </tr>
  <?php

    $artist = $_GET["artist"];

    $country = "US";
    $legit_countries = ["US","UK","DE","FR","CA","AU"];
    if (isset($_GET["country"]) && in_array($_GET["country"], $legit_countries)) {
      $country = $_GET["country"];
    }

    $num_rows = 25;
    if (isset($_GET["num_rows"]) && intval($_GET["num_rows"]) != 0) {
      $num_rows = $_GET["num_rows"];
    }

    $sql = "select * from albums where artist like '%" . $artist . "%' and " . $country . " <> '' limit " . $num_rows;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc())
    {
      echo("<tr><td>" . $row["artist"] . "</td><td>" . $row["album"] . "</td><td>" . $row["us"] . "</td><td>" . $row["uk"] .  "</td><td>" . $row["de"] .  "</td><td>" . $row["fr"] .  "</td><td>" . $row["ca"] .  "</td><td>" . $row["au"] .  "</td></tr>");
    }
  ?>
</table>
</body>
</html>
