<?php
$filename = "LOG.txt";

function check_username_password($username, $password, $filename){
  $found = False;

  if (file_exists($filename)){

    $fd = fopen($filename, "r");
    
    while(!feof($fd)){
      $line = fgets($fd);
      $players_array = explode("\t", $line);
      $temp_username = $players_array[1];
      $temp_password = $players_array[5];
      
      if ($temp_username == $username && $temp_password == $password){
        $found = True;
      }
    }
    fclose($fd);
  }
  return $found;
}

$player_email = $_POST['Player_Email'] ?? '';
$player_password = $_POST['Player_Password'] ?? '';

if (check_username_password($player_email, $player_password, $filename)){

}
else{
    
}

?>