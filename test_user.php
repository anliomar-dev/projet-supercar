<?php
include_once('php/connexionDB.php');
include_once('php/utils.php');

$firstname = 'omar';
$lastname = 'anli';
$address = '123 Main St';
$phone = '555-1234';
$email = 'omaranli@gmail.com';
$password = 'password12345';

//$result = create_user($firstname, $lastname, $address, $phone, $email, $password);
$result = login($email, $password);

if ($result) {
    //echo 'Utilisateur créé avec succès!';
    echo 'logged_in';
} else {
    echo 'Échec de la création de l\'utilisateur.';
}
?>