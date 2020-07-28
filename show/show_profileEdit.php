<!DOCTYPE html>
<html>
<title>PemWeb UTS Teori</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="file/css/style.css">
<link rel="stylesheet" type="text/css" href="file/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="file/fonts/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

<?php
$id = $_SESSION["ID"];

require_once "Connection/connectionDB.php";

$query = "SELECT * FROM profiles WHERE username ='" . $id . "'";

if (mysqli_query($db, $query) == false) {
  echo "Error: " . $query . "<br>" . mysqli_error($db);
}
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();

if ($row["gender"] == "m") {
  $row["gender"] = "Male";
} elseif ($row["gender"] == "f") {
  $row["gender"] = "Female";
} else {
  $row["gender"] = "Other";
}
if ($row["id_image"] == NULL) {
  $row["id_image"] = "avatar.jpg";
}

echo "  <div class=\"w3-col m3\">
                    <p class=\"w3-center\"><img src=\"Images/" . $row["id_image"] . "\" class=\"w3-circle\" style=\"height:106px; width:106px;\" alt=\"Avatar\"></p>
                </div>
                
                <div class=\"w3-col m8 w3-left\">
                    <form action=\"Response/editProfile_response.php\" method=\"POST\" enctype=\"multipart/form-data\">
                        <h4 id=\"username\" name=\"username\" >Username : " . $row["username"] . " </h4>
                        <h4 >FirstName : </h4>
                        <input type=\"text\" id=\"Fname\" name=\"Fname\" value=\"" . $row["first_name"] . "\">
                        <h4 >LastName : </h4>
                        <input type=\"text\" id=\"Lname\" name=\"Lname\" value=\"" . $row["last_name"] . "\">
                        <h4 >Location : </h4>
                        <input type=\"text\" id=\"location\" name=\"location\" value=\"" . $row["location"] . "\">
                        <h4 >Website : </h4>
                        <input type=\"text\" id=\"website\" name=\"website\" value=\"" . $row["website"] . "\">
                        <h4 >BirthDate : </h4>
                        <input type=\"date\" id=\"birthdate\" name=\"birthdate\" value=\"" . $row["birthdate"] . "\">
                        <h4 >Bio : </h4>
                        <input type=\"text\" id=\"bio\" name=\"bio\" value=\"" . $row["bio"] . "\">
                        
                        <h4>Change Profile Pictures</h4>
                        <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\">
                        <input input type=\"submit\" value=\"Save Edit\" name=\"submit\"> <br> <br>
                    </form>
                </div>
                        ";

?>

<div id="team" class="text-center">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 section-title">
      <h2>Quotes about Friendship </h2>
      <p> Because why not ? </p>
    </div>
    <div id="row" ng-app="myApp" ng-controller="myCtrl">
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="file/img/team/ali.jpg" alt="..." class="team-img">
          <div class="caption">
            <h4 ng-bind="sh"></h4>
            <p><i> If you haven't learned the meaning of friendship, you really havent't learned anything </i> </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="file/img/team/lincoln.jpg" alt="..." class="team-img">
          <div class="caption">
            <h4 ng-bind="nm"></h4>
            <p> <i> Those who deny freedom of others, deserves it not for themselves </i> </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="file/img/team/kendrick.jpg" alt="..." class="team-img">
          <div class="caption">
            <h4 ng-bind="lm"></h4>
            <p><i> Build your own pyramids, write your own hieroglyphs</i></p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 team">
        <div class="thumbnail"> <img src="file/img/team/luffy.jpg" alt="..." class="team-img">
          <div class="caption">
            <h4 ng-bind="em"></h4>
            <p><i> YOU ARE MY NAKAMA!! </i> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>