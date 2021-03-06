<?php
 
    $path = getcwd();
 
    include "./linkErrorpage.php";
    $connfile = $path . '/../../../vault/dbConnection.php';
    if(file_exists($connfile)&&is_readable($connfile)){
        require_once $path . '/../../../vault/dbConnection.php';
    }else{
        toErrorPage("Failed to load requiered File");
        die();
    }
    $attributes = $_POST;
    $Nickname = $attributes["nick"];
    $projectID = $attributes["projectID"];
    $comment = $attributes["comment"];
 
    $NutzerID = getUserID($Nickname, $conn);
 
 
    $query = $conn->prepare("INSERT INTO Kommentar (NutzerID,Inhalt) VALUES (?,?)");
    $query->bind_param("is", $NutzerID, $comment);
    $worked = $query->execute();
 
    if(!$worked){
        toErrorPage("Error: " . $conn->error."</br> Cannot create comment. Please contact the administrator");
        die();
    }else{
        $commentID = $conn->insert_id;
        $query = $conn->prepare("INSERT INTO Kommentarliste (KommentarlisteID,KommentarViewLINK) VALUES (?,?)");
        $query->bind_param("ii", $projectID, $commentID);
        $worked = $query->execute();
        $query->close();
       
        if(!$worked){
            $error = $conn->error;
            $query = $conn->prepare("DELETE FROM Kommentar WHERE KommentarID = ?");
            $query->bind_param("i", $commentID);
            $cleaned = $query->execute();
            $query->close();
 
            if($cleaned){
                toErrorPage($error);
            }else{
                toErrorPage($error."</br> $conn->error </br> comment $commentID not cleaned");
            }
        }
        else{
            header("Location:./detail.php?ProjektID=".$projectID);
        }
        $query->close();
    }
 
 
    function getUserID($Nickname, $conn){
        $query = "Select NutzerID From Nutzer where Nick = '$Nickname';";
        $sqliGetNutzer = $conn->query($query);
        if(mysqli_num_rows($sqliGetNutzer)==1){
            $row = mysqli_fetch_array($sqliGetNutzer);
            return($row["NutzerID"]);
        }else if(mysqli_num_rows($sqliGetNutzer)==0){
            // $query="INSERT INTO Nutzer (Nick) VALUES ('$Nickname');";
            // $newUser = $conn->query($query);
 
            $query = $conn->prepare("INSERT INTO Nutzer (Nick) VALUES (?)");
            $query->bind_param("s", $Nickname);
            $newUser = $query->execute();
            $query->close();
 
            if(!$newUser){
                toErrorPage("Error: " . $conn->error."</br> Can not create new User, Contact your administrator");
                die();
            }else{
                return($conn->insert_id);
            }
        }else{
            toErrorPage("There are two people with the same nickname, contact the administrator");
            die();
        }
    }
 
?>