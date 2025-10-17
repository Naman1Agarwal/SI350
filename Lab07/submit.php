<?php
$file_name = "LOG.txt";

function check_username($user, $file_name){
  $found = False;

  if (file_exists($file_name)){

    $fd = fopen($file_name, "r");
    while(!feof($fd)){
      $line = fgets($fd);
      $entries_array = explode("\t", $line);
      
      if ($entries_array[1] === $user){
        $found = True;
      }
    }
    fclose($fd);
  }
  return $found;
}

$pname = $_POST['Player_Name'] ?? '';
$player_email = $_POST['Player_Email'] ?? '';
$player_opponent = $_POST['Opponent'] ?? '';
$playing_match = $_POST['for_match'] ?? '';
$exp_level = $_POST['experience'] ?? '';
$player_password = $_POST['Player_Password'] ?? '';

$valid_input = true;
$missing = "";
$already_exists = false;


if (empty($pname)) {
    $valid_input = false;
    $missing = $missing . "Player Name\n";
}

if (empty($player_email)) {
    $valid_input = false;
    $missing = $missing . "Player Email\n";
}
elseif(check_username($player_email, $file_name)){
  $already_exists = true;
}

if (empty($playing_match)) {
    $valid_input = false;
    $missing = $missing . "Selection to Play Match\n";
}
if (empty($exp_level)) {
    $valid_input = false;
    $missing = $missing . "Experience Level\n";
}
if (empty($player_password)) {
    $valid_input = false;
    $missing = $missing . "Password\n";
} else {
    if (!preg_match('/[a-z]/', $player_password)) {
        $valid_input = false;
        $missing = $missing . "Password is missing a lower case letter\n";
    }
    if (!preg_match('/[A-Z]/', $player_password)) {
        $valid_input = false;
        $missing = $missing . "Password is missing an upper case letter\n";
    }
    if (!preg_match('/\d/', $player_password)) {
        $valid_input = false;
        $missing = $missing . "Password is missing a digit\n";
    }
}

if ($already_exists == true){ ?>
  <!DOCTYPE html>
  <html lang="en">
  <head> <title> Invalid Form </title> </head>
    <body>
    <p> <center> <b> Your account already exist! </b> </center> </p>
    <p> <center> Please go back to the login page! </center> </p>
    </body>
  </html>

<?php } elseif ($valid_input == false) { ?>
  <!DOCTYPE html>
    <html lang="en">
    <head> <title> Invalid Form </title> </head>
      <body>
      <h3> <center> Your form is not fully completed! </center> </h1>
      <p> <center> <b> You are missing the following: </b> </center> </p>
      <p> <center> <?php echo nl2br(htmlspecialchars($missing)); ?></center> </p>
      <p> <center> Please go back to complete your registration! </center> </p>
      </body>
    </html>

<?php } else { ?>
        
  <!DOCTYPE html>
  <html lang="en">
    <head> <title> Registration Form </title> </head>
    <body>
    <h3> <center> Your registration to play has been confirmed! </center> </h1>
    <p> <center> <b> The details for when you play are:  </b> </center> </p>
    <p> <center> Your name: <?php echo htmlspecialchars($pname); ?> </center> </p>
    <p> <center> Your email: <?php echo htmlspecialchars($player_email); ?> </center> </p>

    <?php if (empty($player_opponent)) {
        $player_opponent = "Naman";
    } ?>

    <p> <center> Your opponent: <?php echo htmlspecialchars($player_opponent); ?> </center> </p>
    <?php if ($playing_match == 'one') { ?>
        <p> <center> You are playing a match </center> </p>
    <?php } else { ?>
        <p> <center> You are not playing a match </center> </p>
    <?php } ?>
    <p> <center> Your playing level is <?php echo htmlspecialchars($exp_level); ?>! </center> </p>
    <p> <center> Make sure you remember your password: ****</center> </p>
    </body>
  </html>

  <?php
  $line = "";
  $pname = str_replace(["\n", "\r", "\r\n"], "&", $pname);
  $player_email = str_replace(["\n", "\r", "\r\n"], "&", $player_email);
  $playing_match = str_replace(["\n", "\r", "\r\n"], "&", $playing_match);
  $player_opponent = str_replace(["\n", "\r", "\r\n"], "&", $player_opponent);
  $exp_level = str_replace(["\n", "\r", "\r\n"], "&", $exp_level);
  $player_password = str_replace(["\n", "\r", "\r\n"], "&", $player_password);

  $line = $line . $pname . "\t";
  $line = $line . $player_email . "\t";
  $line = $line . $playing_match . "\t";
  $line = $line . $player_opponent . "\t";
  $line = $line . $exp_level . "\t";
  $line = $line . $player_password . "\t";
  $line = $line . "\n";

  $does_file_exist = file_exists($file_name);
  $file = fopen("LOG.txt", "a");

  if (!$does_file_exist) {
      $header = "name\tplayer_email\tplayer_match\tplayer_opponent\texperience\tpassword\n";
      fwrite($file, $header);
  }

  fwrite($file, $line);
  fclose($file);
  chmod($file_name, 0777);
  ?>

<?php } ?>