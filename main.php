<?php
session_start();
if (!isset($_SESSION["ID"])) {
  echo ("<script>location.href ='index.php';</script>");
}
?>
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


<body class="w3-theme-l5">
  <div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">

      <a href="main.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>FriendApp</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Logout" id="aKill">Logout</a>
      <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Profile">Profile</a>


    </div>
  </div>

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:100px">
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
          <div class="w3-container">
            <!-- tampilin profile si user dan timeline -->
            <?php

            $id = $_SESSION["ID"];
            require_once 'Connection/connectionDB.php';

            $query = "SELECT * FROM profiles WHERE username ='" . $id . "'";

            if (mysqli_query($db, $query) == false) {
              echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();

            if ($row["id_image"] == NULL) {
              $row["id_image"] = "avatar.jpg";
            }

            echo " <h4 class=\"w3-center\">" . $row["first_name"] . " " . $row["last_name"] . "</h4>";
            echo "<p class=\"w3-center\"><img src=\"Images/" . $row["id_image"] . "\" class=\"w3-circle\" style=\"height:106px;width:106px\" alt=\"Avatar\"></p>
                                     <hr>";
            if ($row["location"] != NULL) {
              echo "<p><i class=\"fa fa-home fa-fw w3-margin-right w3-text-theme\"></i>" . $row["location"] . "</p>";
            }
            if ($row["website"] != NULL) {
              echo "<p><i class=\"fa fa-pencil fa-fw w3-margin-right w3-text-theme\"></i>" . $row["website"] . "</p>";
            }

            echo "<p><i class=\"fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme\"></i>" . $row["birthdate"] . "</p>";

            echo "</div>
                            </div>

                            </div>";



            echo "<div class=\"w3-col m9\">

                                    <div class=\"w3-row-padding\">
                                        <div class=\"w3-col m12\">
                                            <div class=\"w3-card w3-round w3-white\">
                                                <div class=\"w3-container w3-padding\">
                                                    <h6 class=\"w3-opacity\">How are you feeling today ?</h6>
                                                    <input type=\"text\"  class=\"w3-border w3-padding\" id=\"Tekspost\" name=\"Tekspost\" placeholder=\"your thoughts here...\">

                                                    <button type=\"button\" class=\"w3-button w3-theme post-button\"><i class=\"fa fa-pencil\"></i> Post </button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div> ";
            $queryTL = "SELECT B.id_timeline,A.username, concat(A.first_name,\" \", A.last_name) as nama, B.teks_timeline, B.time_posted as time ,A.id_image from profiles A JOIN timelines B on A.id_profile = B.id_profile ORDER BY `time_posted` DESC";
            $resultTimeLine = mysqli_query($db, $queryTL);
            //munculin setiap post yang ada di database
            while ($rowTimeLine = mysqli_fetch_assoc($resultTimeLine)) {
              $waktu = $rowTimeLine["time"];
              if ($rowTimeLine["id_image"] == NULL || $rowTimeLine["id_image"] == '') {
                $rowTimeLine["id_image"] = "avatar.jpg";
              }

              echo "       <div class=\"w3-container w3-card w3-white w3-round w3-margin\"><br>
                                            <h6 id=\"idtimeline\" hidden> " . $rowTimeLine["id_timeline"] . " </h6>
                                            <img src=\"Images/" . $rowTimeLine["id_image"] . "\" alt=\"Avatar\" class=\"w3-left w3-circle w3-margin-right\" style=\"width:60px\">
                                            <span class=\"w3-right w3-opacity\">" . date("d F Y, H:i", strtotime($waktu)) . "</span> 
                                            <h4><a href=\"#\">" . $rowTimeLine["nama"] . "</a></h4>
                                            <h6 id=\"username\"> @" . $rowTimeLine["username"] . " </h6>
                                            <hr class=\"w3-clear\">
                                            <p>" . $rowTimeLine["teks_timeline"] . "</p>
                                                 
                                            <input class=\" form-control w3-margin-bottom\" type=\"text\" id=\"Tekscomment\" name=\"nm\" >
                                            <button type=\"button\" class=\"comment-button w3-button w3-theme-d2 w3-margin-bottom\"> Comment</button>
                                            
                                            <div>";



              $queryComment = "SELECT CONCAT (A.FIRST_NAME, \" \", A.LAST_NAME) as nama, C.teks_comment, C.id_timeline, C.time_posted 
                                            FROM profiles A JOIN comments C ON A.id_profile = C.id_profile
                                            WHERE C.id_timeline ='" . $rowTimeLine["id_timeline"] . "'";
              $resultComment = mysqli_query($db, $queryComment);
              // munculin comment tiap post
              while ($rowComment = mysqli_fetch_assoc($resultComment)) {
                $waktuComment = $rowComment["time_posted"];
                echo    "<div>
                                            <span class=\"w3-right w3-opacity\">" . date("d F Y, H:i", strtotime($waktuComment)) . "</span> 
                                            <h4>" . $rowComment["nama"] . "</h4>
                                            <h6>" . $rowComment["teks_comment"] . "</h6>
                                        </div>";
              }

              echo "</div>

                                        </div>";
            }
            echo "   </div>
                                </div>";
            ?>




          </div>

        </div>



        <br>


        <script>
          // script utk ngepost dan comment
          $(document).ready(function() {
            $(".post-button").click(function() {
              var id = "<?php echo $_SESSION["ID"]; ?>";
              var teks = $('#Tekspost').val();
              $.ajax({
                url: "Response/Post_Response.php",
                method: "POST",
                data: {
                  ID: id,
                  post: teks
                },
                success: function(resp) {
                  if (resp == true) {
                    location.reload(true);
                  } else {

                  }
                }
              });
            });

            $(".comment-button").click(function() {
              var teks = $(this).closest('.w3-card').find('#Tekscomment').val();
              var idtimeline = $(this).closest('.w3-card').find('#idtimeline').text();
              $.ajax({
                url: "Response/comment_Response.php",
                method: "POST",
                data: {
                  comment: teks,
                  idtimeline: idtimeline
                },
                success: function(resp) {
                  if (resp == true) {
                    alert("berhasil comment");
                    location.reload(true);
                  } else {

                  }
                }
              });
            });

            $("#aKill").click(function() {
              alert("Logout");
              $.get("Response/clearSession.php");
              location.href = 'index.php';
            });
          });
        </script>

        <div id="team" class="text-center">
          <div class="container">
            <div class="col-md-8 col-md-offset-2 section-title">
              <h2>Quotes about Life </h2>
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
        <div id="footer">
          <div class="container text-center">
            <p>&copy; Project Pemograman Web. Created by Jordy, Samuel and Yuan </a></p>
          </div>
        </div>

</body>

</html>