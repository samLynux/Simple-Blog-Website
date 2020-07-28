<?php
session_start();
if (!isset($_SESSION["ID"])) {
    header("../Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PemWeb UTS Teori - Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>


</head>

<body>
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
            <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" id="aKill" title="Logout">Logout</a>
            <a href="profile.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" title="Profile">Profile</a>

        </div>
    </div>

    <div class="w3-container w3-content" style="max-width:1400px;margin-top:200px;">
        <div class="w3-row">
            <?php
            $id = $_SESSION["ID"];

            require_once "../Connection/connectionDB.php";

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
                            <h4 >Name : " . $row["first_name"] . " " . $row["last_name"] . "</h4>
                            <h4 >Username : " . $row["username"] . "</h4>
                            <h4 >Location : " . $row["location"] . "</h4>
                            <h4 >Website : " . $row["website"] . "</h4>
                            <h4 >BirthDate : " . $row["birthdate"] . "</h4>
                            <h4 >Gender : " . $row["gender"] . "</h4>
                            <h4 >Bio : " . $row["bio"] . "</h4>";
            ?>
            <a href="editProfile.php" class="w3-right w3-button">Edit</a>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#aKill").click(function() {
                alert("Logout");
                $.get("../Response/clearSession.php");
                location.reload(true);
            });
        });
    </script>

</body>

</html>