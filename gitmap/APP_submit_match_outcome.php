<?php
$db = mysqli_connect('localhost', 'jobenam437', 'a5i3v6jf', 'jobenam437_wflapp');

$blue_id = $_GET['blue_id'];
$red_id = $_GET['red_id'];
$athlete_id = $_GET['athlete_id'];
$event_id = $_GET['event_id'];
$comp_id = $_GET['comp_id'];
$redyellowcard = $_GET['redyellowcard'];
$points = $_GET['points'];
$tkoko = $_GET['ko'];

if ($blue_id == 0) {
    $corner = "red";
} else if ($red_id == 0) {
    $corner = "blue";
}
//get match_id
$query = "SELECT * FROM `eventcompetition` WHERE event_id = '$event_id' AND competition_id = '$comp_id' AND bluecorner = '$athlete_id' OR redcorner = '$athlete_id'";
$results = mysqli_query($db, $query);
while ($row = $results->fetch_assoc()) {
    $match_id = $row['match_id'];
}

$vraag = "UPDATE matches SET redyellowcard = '$redyellowcard', points = '$points',
          ko = '$tkoko', corner = '$corner'
          WHERE match_id = '$match_id' AND athlete_id = '$athlete_id'";


$resultaat = mysqli_query($db, $vraag);
header('location: APP_event_info.php?event_id='.$event_id.'&events7=0#section'.$athlete_id);
?>