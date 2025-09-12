<?php
$pname = $_POST['Player_Name'] ?? '';
$player_email = $_POST['Player_Email'] ?? '';
$player_opponent = $_POST['Opponent'] ?? '';
$playing_match = $_POST['for_match'] ?? '';
$exp_level = $_POST['experience'] ?? '';
$player_password = $_POST['Player_Password'] ?? '';

$valid_input = true;
$missing = "";

if (empty($pname)){
  $valid_input = false;
  $missing = $missing . "Player Name\n";
}
if (empty($player_email)){
  $valid_input = false;
  $missing = $missing . "Player Email\n";
}
if (empty($playing_match)){
  $valid_input = false;
  $missing = $missing . "Selection to Play Match\n";
}
if (empty($exp_level)){
  $valid_input = false;
  $missing = $missing . "Experience Level\n";
}
if (empty($player_password)){
  $valid_input = false;
  $missing = $missing . "Password\n";
}

if ($valid_input == False){ ?>

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

        <?php 
        if (empty($player_opponent)){
          $player_opponent = "Naman";
        }
      ?>

        <p> <center> Your opponent: <?php echo htmlspecialchars($player_opponent); ?> </center> </p>
        <?php 
        if ($playing_match == 'one') { 
          ?>
            <p> <center> You are playing a match </center> </p>
            <?php } else {?>
              <p> <center> You are not playing a match </center> </p>
                <?php } ?>

                <p> <center> Your playing level is <?php echo htmlspecialchars($exp_level); ?>! </center> </p>
                <p> <center> Make sure you remember your password: ****</center> </p>

                </body>
                </html>

                <?php
                $file = fopen("LOG.txt", "a+");
      $line = "";
      $line = $line . $pname . "\t";
      $line = $line . $player_email . "\t";
      $line = $line . $playing_match . "\t";
      $line = $line . $player_opponent . "\t";
      $line = $line . $exp_level . "\t";
      $line = $line . $player_password . "\t";
      $line = $line . "\n";

      fwrite($file, $line);
      fclose($file);
      ?>

        <?php } ?>
