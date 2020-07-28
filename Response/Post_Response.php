<?php
        date_default_timezone_set("Asia/Jakarta");
        $datepost = date("Y-m-d H:i:s");
        $usernameprofile =  $_POST["ID"];
        $post = $_POST["post"];

        require_once  '../Connection/connectionDB.php';

        $querygetID="SELECT * FROM profiles WHERE username ='" . $usernameprofile . "'";
        if (mysqli_query($db, $querygetID) == false) {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
        $result = mysqli_query($db, $querygetID);
        $row = $result->fetch_assoc();
        $id_profile= $row["id_profile"];

        $query = "INSERT INTO timelines (teks_timeline, id_profile, time_posted)
            VALUES ('$post', '$id_profile', sysdate());";

        if ($db->query($query) === TRUE) {
            echo 1;
        } else {
            echo 2;
            echo "Error: " . $query . "<br>" . mysqli_error($db); 
        }

        mysqli_close($db);
?>