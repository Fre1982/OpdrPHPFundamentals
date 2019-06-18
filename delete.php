<?php

require_once 'inc/db.class.php';

session_start();
  
if(isset($_GET['id'])){
// post-id opslaan
$post_id = $_GET['id'];
// verbinding met tabel maken en post verwijderen met het post_id
$db = new db();
$data = $db->deleteDataById('posts', $post_id);
}
header("Location: index.php");
exit;
