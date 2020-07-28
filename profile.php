<?php
session_start();
if (!isset($_SESSION["ID"])) {
  echo ("<script>location.href ='index.php';</script>");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PemWeb UTS Teori - Profile</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="file/css/style.css">
  <link rel="stylesheet" type="text/css" href="file/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="file/fonts/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="file/css/main.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">

  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>


</head>

<body>
  <div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">

      <a href="main.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>FriendApp</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Logout" id="aKill">Logout</a>
      <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Profile">Profile</a>


    </div>
  </div>

  <section id="one" class="wrapper style1">
    <header class="special">
      <h2>Hi!</h2>
      <p>Let's be Friend</p>
      <div class="" style="max-width:1400px;margin-top:50px;">
        <div class="w3-row">
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
                            <h4 >Hi! My name is " . $row["first_name"] . " " . $row["last_name"] . "</h4>
                            <h4 >I'm currently living in " . $row["location"] . "</h4>
                            <h4 >You can visit me at " . $row["website"] . "</h4>
                            <h4 >My Birthday is " . $row["birthdate"] . "</h4>
                            <h4 >I'm a " . $row["gender"] . "</h4>
                            <h4 >And I want to say " . $row["bio"] . "</h4>";
          ?>
          <p <br> <br> <br> <br>
            <a href="editProfile.php" class="loginButton btn-custom5">Edit</a>

        </div>
      </div>
      </div>

    </header>
  </section>




  <script>
    $(document).ready(function() {
      $("#aKill").click(function() {
        alert("Logout");
        $.get("Response/clearSession.php");
        location.reload(true);
      });
    });
  </script>

  <div id="team" class="text-center">
    <div class="container">
      <div class="col-md-8 col-md-offset-2 section-title">
        <h2>Quotes. </h2>
        <p> Because why not ? </p>
      </div>
      <div id="row" ng-app="myApp" ng-controller="myCtrl">
        <div class="col-md-3 col-sm-6 team">
          <div class="thumbnail"> <img src="file/img/team/hawking.jpg" alt="..." class="team-img">
            <div class="caption">
              <h4 ng-bind="sh"></h4>
              <p><i> Intellegence is the ability to adapt to change. </i> </p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 team">
          <div class="thumbnail"> <img src="file/img/team/mandela.jpg" alt="..." class="team-img">
            <div class="caption">
              <h4 ng-bind="nm"></h4>
              <p> <i> Education is the most powerful weapon which you can use to change the world.</i> </p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 team">
          <div class="thumbnail"> <img src="file/img/team/messi.jpg" alt="..." class="team-img">
            <div class="caption">
              <h4 ng-bind="lm"></h4>
              <p><i> You can overcome anything, if and only if you love something enough.</i></p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 team">
          <div class="thumbnail"> <img src="file/img/team/eminem.jpg" alt="..." class="team-img">
            <div class="caption">
              <h4 ng-bind="em"></h4>
              <p><i>You can do anything you set your mind to. </i> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <div class="container text-center">
      <p>&copy; Project Pemograman Web <br> Created by Jordy, Samuel and Yuan </a></p>
    </div>
  </div>

</body>

</html>