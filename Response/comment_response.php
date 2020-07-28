<?php
    session_start();

        $usernameprofile =  $_SESSION["ID"];
        $comment = $_POST["comment"];
        $id_timeline = $_POST["idtimeline"];

        require_once  '../Connection/connectionDB.php';

        $querygetID="SELECT * FROM profiles WHERE username ='" . $usernameprofile . "'";
        if (mysqli_query($db, $querygetID) == false) {
            echo "Error: " . $query . "<br>" . mysqli_error($db);
        }
        $result = mysqli_query($db, $querygetID);
        $row = $result->fetch_assoc();
        $id_profile= $row["id_profile"];

        $query = "INSERT INTO comments (teks_comment, id_timeline, id_profile, time_posted)
            VALUES ('$comment', '$id_timeline', '$id_profile', sysdate());";

        if ($db->query($query) === TRUE) {
            echo 1;
        } else {
            echo 2;
            echo "Error: " . $query . "<br>" . mysqli_error($db); 
        }

        mysqli_close($db);
        //belom kelar, ID yang mau di comment belum di buat
?>