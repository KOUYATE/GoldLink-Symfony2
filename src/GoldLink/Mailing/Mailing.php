<?php
/**
 * Created by PhpStorm.
 * User: kouyate
 * Date: 22/03/14
 * Time: 16:00
 */

$pdo = new PDO('mysql:host=localhost;dbname=goldlink','root','');
$req = $pdo->query('SELECT * FROM Mailing Order By id DESC Limit 0,10 ');

$mail = $req->fetchAll(PDO::FETCH_OBJ);

$req = $pdo->query('SELECT email FROM User');
$mailList = $req->fetchAll(PDO::FETCH_OBJ);
$messages = "GoldLink \nListe des nouveaux liens publics ajouter sur le rÃ©seau GoldLink!";
//construction du message
foreach($mail as $m){
    $messages .= "<a href='".$m->url."'>$m->url</a>\n";
}

$headers ='From: "GoldLink"<email@exemple.com>'."\n";
$headers .='Reply-To: email@exemple.com'."\n";
$headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
$headers .='Content-Transfer-Encoding: 8bit';
//envoi de mail à  toutes les utilisateurs
foreach($mailList as $user){
    mail($user->mail,'GoldLink - News',$messages,$headers);
}
//on vide la base de donnée
$req = $pdo->exec('DELETE * FROM Mailing');
