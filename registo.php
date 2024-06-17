<?php
session_start();
if ($_POST["password"] != $_POST["rpassword"]){
    header("Location: register.php?erro=pass");
    exit;
    }

include('connect.php');
$sql ="SELECT * from Utilizadores where email='$_POST[Email]'";
$result = $db->query($sql);
$rows=0;
while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
    $rows+=1;
    }
if ($rows !=0){
    header("Location: register.php?erro=email");
} 
else{
    $sql = "INSERT INTO Utilizadores (nome, apelido, telefone, email, pwd) VALUES ('$_POST[nome]', '$_POST[apelido]', '$_POST[telefone]', '$_POST[Email]', '$_POST[password]')";
    $result = $db->exec($sql);
    if(!$result) {
    echo $db->lastErrorMsg();
    } else {
    header("Location: login.php?error=none");
    }
    $db->close();
    
}
?>