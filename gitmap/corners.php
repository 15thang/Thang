<?php

$db = mysqli_connect('localhost', 'jobenam437', 'a5i3v6jf', 'jobenam437_wflapp');

$event_id = $_GET['event_id'];

$json_array = array();

$query = "SELECT * FROM `athletes` WHERE athlete_id IN (SELECT redcorner FROM `eventcompetition` WHERE event_id = '$event_id')";

$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $json_array[] = $row;
}

echo json_encode($json_array, JSON_PRETTY_PRINT);

// Optie 1: SUPER SQL
event_id, redcorder_id, redcorder_name, bluecorder_id, bluecorder_name,
[15,203,"Jan",205,"Piet"]

// Athlete.fromJSON(...)



// Optie 2: Super veel SQL

// SELECT * FROM eventcomp WHERE event_id = ...
while ($row = mysqli_fetch_assoc($result)) {

    $redcornerquery = // SELECT * FROM `athletes` WHERE athlete_id = $row["redcorner"]
    $bluecornerquery = // SELECT * FROM `athletes` WHERE athlete_id = $row["redcorner"]
}

// Nadeel: VEEEEEL QUERIES
// Voordeel:
[
  {
      event_id: 15,
    red_corder: {
      id: 203,
      name: "Jan"
    },
    blue_corder: {
      id: 204,
      name: "Piet"
    },
  }
]

for(var noteJSON in ...){
    final redAthlete = Atlethe.from(noteJSON.red_corner)
  final blueAthlete = Atlethe.from(noteJSON.red_corner)
}


//
[
  {
      event_id: 15,
    red_corder: {
      id: 203,
      name: "Jan"
    },
    blue_corder: {
      id: 204,
      name: "Piet"
    },
  }
]

// SELECT * FROM eventcomp WHERE event_id = ...

$athlete_ids = []
$events = []
while ($row = mysqli_fetch_assoc($result)) {

    $events.push($row)
  $athlete_ids.push($row["red_corner"])
  $athlete_ids.push($row["blue_corner"])
}

// SELECT * FROM atlethes WHERE id IN ($athlete_ids)


// Voeg de atleten samen

for($event of $events){
    // Ga op zoek naar de atleet in de rode hoek

}