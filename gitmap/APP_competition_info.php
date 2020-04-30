<head>
    <link rel="stylesheet" type="text/css" href="css/APP_CSS.css">
    <link rel="stylesheet" href="css/wflapp.css">
</head>
<!-- terugknop -->
<button class="ssbutton" type="submit" name="info"><a href="javascript:history.back()">Go Back</a></button>
<br>
<br>
<?php
$db = mysqli_connect('localhost', 'jobenam437', 'a5i3v6jf', 'jobenam437_wflapp');
$comp_id = $_GET['competition_id'];
$query1 = "SELECT * FROM competition WHERE competition_id = '$comp_id'";
$results1 = mysqli_query($db, $query1);
?>
<div class="container" style="margin-top:50px;">
    <table id="compinfo">
        <tr>
            <th>Competition id</th>
            <th>Competition name</th>
        </tr>
        <?php
        while ($row = $results1->fetch_assoc()) {
            //events
            $event0 = $row['event0'];//fake event, remains hidden
            $event1 = $row['event1'];
            $event2 = $row['event2'];
            $event3 = $row['event3'];
            $event4 = $row['event4'];
            $event5 = $row['event5'];
            $event6 = $row['event6'];
            $event7 = $row['event7'];
            $event8 = $row['event8'];
            $event9 = $row['event9'];
            echo '
<tr>
   <td>'.$comp_id.'</td>
   <td>'.$row['competition_name'].'</td>
</tr>
</table>
';
        }
        echo '<table id="compinfo">
    <tr>
       <th>Grade</th>
       <th>Weightclass</th>
    </tr>';
        $query1 = "SELECT * FROM `athletes` WHERE athlete_id 
          IN (SELECT athlete_id FROM `athletecompetition` 
          WHERE competition_id ='$comp_id')";
        $results1 = mysqli_query($db, $query1);
        $only1 = 1;
        while ($row = $results1->fetch_assoc()) {
            //switch case om de nummers naar letters te veranderen
            switch ($row['athlete_grade']) {
                case "0":
                    $athlete_grade_letter = "";
                    break;
                case "1":
                    $athlete_grade_letter = "A";
                    break;
                case "2":
                    $athlete_grade_letter = "B";
                    break;
                case "3":
                    $athlete_grade_letter = "C";
                    break;
                case "4":
                    $athlete_grade_letter = "N";
                    break;
                case "5":
                    $athlete_grade_letter = "J";
                    break;
            }
            //switch case om nummers naar namen te veranderen
            switch ($row['athlete_weightclass']) {
                case "0":
                    $athlete_weightclassA = "";
                    break;
                case "1":
                    $athlete_weightclassA = "95+";
                    break;
                case "2":
                    $athlete_weightclassA = "95";
                    break;
                case "3":
                    $athlete_weightclassA = "84";
                    break;
                case "4":
                    $athlete_weightclassA = "77";
                    break;
                case "5":
                    $athlete_weightclassA = "70";
                    break;
                case "6":
                    $athlete_weightclassA = "65";
                    break;
                case "7":
                    $athlete_weightclassA = "61";
                    break;
            }

            if ($only1 == 1) {
                echo '
<tr>
   <td>'.$athlete_grade_letter.'</td>
   <td>'.$athlete_weightclassA.'</td>
</tr>
</table><br>
';
                $only1 = 2;
            }
        }
        ?>

</div>
<?php
//select all athletes from selected competition
$query2 = "SELECT * FROM `athletes` WHERE athlete_id 
          IN (SELECT athlete_id FROM `athletecompetition` 
          WHERE competition_id ='$comp_id')";
$results2 = mysqli_query($db, $query2);
?>
<div id="container" style="margin-top:50px;">
    <table id="compstats">
        <tr>
            <th>id</th>
            <th>Picture</th>
            <th>Name athlete</th>
        </tr>
        <?php
        $participants_id = array();
        while ($row = $results2->fetch_assoc()) {
            $picture = $row['athlete_picture'];
            $athlete_id = $row['athlete_id'];

            echo '<tbody id="myTable">
              <tr>
                <td>'.$row['athlete_id'].'</td>
                <td><img src="'.$picture.'" id="pic"/>' .'</td>
                <td>'.$row['athlete_firstname'].' '.$row['athlete_lastname'].'</td>
              </tr>
          </tbody>';
            $participants_id[] = $row['athlete_id'];
        }
        // V V V  DISPLAY STATS FROM EVENT 1 TO 9  V V V
        echo '
<!-- Event1 -->
<table id="compstats" >
        <tr id="hoverknop" data-href="APP_event_info.php?event_id='.$event1.'&events7=0">
            <th>Event1</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event1'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event1 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event1.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event1.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event2 -->
<table id="compstats">
        <tr>
            <th>Event2</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event2'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event2 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event2.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event2.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event3 -->
<table id="compstats">
        <tr>
            <th>Event3</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event3'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event3 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event3.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event3.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event4 -->
<table id="compstats">
        <tr>
            <th>Event4</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event4'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event4 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event4.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event4.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event5 -->
<table id="compstats">
        <tr>
            <th>Event5</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event5'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event5 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event5.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event5.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event6 -->
<table id="compstats">
        <tr>
            <th>Event6</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event6'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event6 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event6.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event6.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event7 -->
<table id="compstats">
        <tr>
            <th>Event7</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event7'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event7 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event7.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event7.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event8 -->
<table id="compstats">
        <tr>
            <th>Event8</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event8'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event8== $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event8.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event8.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</table>
<!-- Event9 -->
<table id="compstats">
        <tr>
            <th>Event9</th>
        </tr>';
        //make array with all athletes that are participating in event
        $idInEvent = array();
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') AND event_id = '$event9'";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            $idInEvent[] = $row['athlete_id'];
        }
        $query2 = "SELECT DISTINCT * FROM `matches` WHERE match_id IN (SELECT match_id FROM `eventcompetition`
               WHERE competition_id = '$comp_id') ORDER BY athlete_id ASC";
        $results2 = mysqli_query($db, $query2);
        while ($row = $results2->fetch_assoc()) {
            if (in_array($row['athlete_id'], $participants_id)) {
                if ($event9 == $row['event_id']) {
                    if ($row['corner'] == "red") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event9.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(255,0,0,0.5);">';
                    } else if ($row['corner'] == "blue") {
                        echo '<td id="hoverknop" data-href="APP_event_info.php?event_id='.$event9.'&events7=0#section'.$row['athlete_id'].'" style="background-color:rgba(0,0,255,0.5);">';
                    }
                    echo $row['redyellowcard'].'<br>'.$row['points'].' points<br>'.$row['ko'].'</td></tr>';
                } else if (!in_array($row['athlete_id'], $idInEvent) && $row['event_id'] == $event0) {
                    echo '<td>Not participating</td></tr>';
                }
            }
        }
        echo '</tbody>';
        ?>
    </table>
</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="lisenme.js"></script>
<!-- Script om van elke tr een link te maken -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row => {
            row.addEventListener("click", () => {
                window.location.href = row.dataset.href;
            });
        });
    });
</script>
<!-- Script om van elke td een link te maken -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("td[data-href]");

        rows.forEach(row => {
            row.addEventListener("click", () => {
                window.location.href = row.dataset.href;
            });
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>