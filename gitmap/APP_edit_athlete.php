<?php
$db = mysqli_connect('localhost', 'jobenam437', 'a5i3v6jf', 'jobenam437_wflapp');
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/APP_CSS.css">
</head>

<div>
    <a href="APP_website2.php">Back to overview</a><br><br>
</div>
<?php
$athlete_id = $_GET['athlete_id'];
echo $athlete_id;

$query = "SELECT * FROM `athletes` WHERE athlete_id = '$athlete_id'";

$results = mysqli_query($db, $query);
while ($row = $results->fetch_assoc()) {
    //Dit is de bestaande foto voor het geval er geen nieuwe foto wordt geupload.
    $athlete_picture = $row['athlete_picture'];

    switch ($row['athlete_grade']) {
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
        default:
            echo "No correct athlete grade value";
    }

    switch ($row['athlete_weightclass']) {
        case "1":
            $athlete_weightclassA = "Heavyweight";
            break;
        case "2":
            $athlete_weightclassA = "Light Heavyweight";
            break;
        case "3":
            $athlete_weightclassA = "Middleweight";
            break;
        case "4":
            $athlete_weightclassA = "Welterweight";
            break;
        case "5":
            $athlete_weightclassA = "Lightweight";
            break;
        case "6":
            $athlete_weightclassA = "Featherweight";
            break;
        case "7":
            $athlete_weightclassA = "Bantamweight";
            break;
        case "8":
            $athlete_weightclassA = "Flyweight";
            break;
        case "9":
            $athlete_weightclassA = "Strawweight";
            break;
        default:
            echo "No correct athlete weightclass value";
    }

    //invulveld
    echo '<div id="field2">
    <form name="form1" method="post" action="" enctype="multipart/form-data">
        <h3>Edit Athlete</h3>
        <label>Name athlete <font color="red">*</font></label><br>
        <input type="text" name="athlete_name" value="' . $row['athlete_firstname'] . '"><br>
        <label>Last name athlete <font color="red">*</font></label><br>
        <input type="text" name="athlete_lastname" value="' . $row['athlete_lastname'] . '"><br>
        <label>Nickname athlete</label><br>
        <input type="text" name="athlete_nickname" value="' . $row['athlete_nickname'] . '"><br>
        <label>Gender athlete <font color="red">*</font></label><br>
        <select name="athlete_gender">
            <option value="' . $row['athlete_gender'] . '">' . $row['athlete_gender'] . '</option>
            <option value="Unspecified">Unspecified</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>
        <label>Picture athlete</label><br>
        <input type="file" name="athlete_picture"><br>
        <label>Height athlete (cm) <font color="red">*</font></label><br>
        <input type="number" name="athlete_height" value="' . $row['athlete_height'] . '"><br>
        <label>Weight athlete (kg) <font color="red">*</font></label><br>
        <input type="number" name="athlete_weight" value="' . $row['athlete_weight'] . '"><br>
        <label>Weightclass <font color="red">*</font></label><br>
        <select name="athlete_weightclass">
            <option value="'.$row['athlete_weightclass'].'">' . $athlete_weightclassA . '</option>
            <option value="9">Strawweight</option>
            <option value="8">Flyweight</option>
            <option value="7">Bantamweight</option>
            <option value="6">Featherweight</option>
            <option value="5">Lightweight</option>
            <option value="4">Welterweight</option>
            <option value="3">Middleweight</option>
            <option value="2">Light Heavyweight</option>
            <option value="1">Heavyweight</option>
        </select><br>
        <label>Athlete fighting grade <font color="red">*</font></label><br>
        <select name="athlete_grade">
            <option value="'. $row['athlete_grade'].'">' . $athlete_grade_letter . '</option>
            <option value="5">J</option>
            <option value="4">N</option>
            <option value="3">C</option>
            <option value="2">B</option>
            <option value="1">A</option>
        </select><br>
        <label>Athlete nationality <font color="red">*</font></label><br>
        <select name="athlete_nationality">
            <option>' . $row['athlete_nationality'] . '</option>
            <option value="Afganistan">Afghanistan</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antigua & Barbuda">Antigua & Barbuda</option>
            <option value="Argentina">Argentina</option>
            <option value="Armenia">Armenia</option>
            <option value="Aruba">Aruba</option>
            <option value="Australia">Australia</option>
            <option value="Austria">Austria</option>
            <option value="Azerbaijan">Azerbaijan</option>
            <option value="Bahamas">Bahamas</option>
            <option value="Bahrain">Bahrain</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="Barbados">Barbados</option>
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bonaire">Bonaire</option>
            <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
            <option value="Botswana">Botswana</option>
            <option value="Brazil">Brazil</option>
            <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
            <option value="Brunei">Brunei</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Canary Islands">Canary Islands</option>
            <option value="Cape Verde">Cape Verde</option>
            <option value="Cayman Islands">Cayman Islands</option>
            <option value="Central African Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Channel Islands">Channel Islands</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas Island">Christmas Island</option>
            <option value="Cocos Island">Cocos Island</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Cook Islands">Cook Islands</option>
            <option value="Costa Rica">Costa Rica</option>
            <option value="Cote DIvoire">Cote DIvoire</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Curaco">Curacao</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican Republic">Dominican Republic</option>
            <option value="East Timor">East Timor</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El Salvador">El Salvador</option>
            <option value="Equatorial Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland Islands">Falkland Islands</option>
            <option value="Faroe Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French Guiana">French Guiana</option>
            <option value="French Polynesia">French Polynesia</option>
            <option value="French Southern Ter">French Southern Ter</option>
            <option value="Gabon">Gabon</option>
            <option value="Gambia">Gambia</option>
            <option value="Georgia">Georgia</option>
            <option value="Germany">Germany</option>
            <option value="Ghana">Ghana</option>
            <option value="Gibraltar">Gibraltar</option>
            <option value="Great Britain">Great Britain</option>
            <option value="Greece">Greece</option>
            <option value="Greenland">Greenland</option>
            <option value="Grenada">Grenada</option>
            <option value="Guadeloupe">Guadeloupe</option>
            <option value="Guam">Guam</option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guinea">Guinea</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Hawaii">Hawaii</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="Indonesia">Indonesia</option>
            <option value="India">India</option>
            <option value="Iran">Iran</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Isle of Man">Isle of Man</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Korea North">Korea North</option>
            <option value="Korea Sout">Korea South</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Laos">Laos</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libya">Libya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macau">Macau</option>
            <option value="Macedonia">Macedonia</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Malawi">Malawi</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Midway Islands">Midway Islands</option>
            <option value="Moldova">Moldova</option>
            <option value="Monaco">Monaco</option>
            <option value="Mongolia">Mongolia</option>
            <option value="Montserrat">Montserrat</option>
            <option value="Morocco">Morocco</option>
            <option value="Mozambique">Mozambique</option>
            <option value="Myanmar">Myanmar</option>
            <option value="Nambia">Nambia</option>
            <option value="Nauru">Nauru</option>
            <option value="Nepal">Nepal</option>
            <option value="Netherland Antilles">Netherland Antilles</option>
            <option value="Netherlands">Netherlands (Holland, Europe)</option>
            <option value="Nevis">Nevis</option>
            <option value="New Caledonia">New Caledonia</option>
            <option value="New Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk Island">Norfolk Island</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau Island">Palau Island</option>
            <option value="Palestine">Palestine</option>
            <option value="Panama">Panama</option>
            <option value="Papua New Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Phillipines">Philippines</option>
            <option value="Pitcairn Island">Pitcairn Island</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Republic of Montenegro">Republic of Montenegro</option>
            <option value="Republic of Serbia">Republic of Serbia</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russia">Russia</option>
            <option value="Rwanda">Rwanda</option>
            <option value="St Barthelemy">St Barthelemy</option>
            <option value="St Eustatius">St Eustatius</option>
            <option value="St Helena">St Helena</option>
            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
            <option value="St Lucia">St Lucia</option>
            <option value="St Maarten">St Maarten</option>
            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
            <option value="Saipan">Saipan</option>
            <option value="Samoa">Samoa</option>
            <option value="Samoa American">Samoa American</option>
            <option value="San Marino">San Marino</option>
            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South Africa">South Africa</option>
            <option value="Spain">Spain</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syria">Syria</option>
            <option value="Tahiti">Tahiti</option>
            <option value="Taiwan">Taiwan</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania">Tanzania</option>
            <option value="Thailand">Thailand</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United Arab Erimates">United Arab Emirates</option>
            <option value="United States of America">United States of America</option>
            <option value="Uraguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Vatican City State">Vatican City State</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Vietnam">Vietnam</option>
            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
            <option value="Wake Island">Wake Island</option>
            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
            <option value="Yemen">Yemen</option>
            <option value="Zaire">Zaire</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
        </select><br>
        <label>Day of birth <font color="red">*</font></label><br>
        <input type="date" name="athlete_day_of_birth" min="1930-01-01" max="2015-01-01" value="' . $row['athlete_day_of_birth'] . '" required><br>
        <label>Description</label><br>
        <input type="text" name="athlete_description" value="' . $row['athlete_description'] . '"><br>
        <!--<label>Athlete wins</label><br>
        <input type="number" name="athlete_wins" value="' . $row['athlete_wins'] . '"><br>
        <label>Athlete losses</label><br>
        <input type="number" name="athlete_losses" value="' . $row['athlete_losses'] . '"><br>
        <label>Athlete draws</label><br>
        <input type="number" name="athlete_draws" value="' . $row['athlete_draws'] . '"><br>
        <label>Athlete total points</label><br>
        <input type="number" name="athlete_points" value="' . $row['athlete_points'] . '"><br>-->
        <br>
        <br>
</div>

<div id="field2">
    <h3>Contact</h3>
    <label>Email <font color="red">*</font></label><br>
    <input type="email" name="athlete_email" placeholder="example@mail.com" value="'. $row['athlete_email'].'" required><br>
    <label>Phone number 1 <font color="red">*</font></label><br>
    <input type="number" name="athlete_phone1" value="'. $row['athlete_phone1'].'" required><br>
    <label>Phone number 2</label><br>
    <input type="number" name="athlete_phone2" value="'. $row['athlete_phone2'].'"><br>
    <label>Adress</label><br>
    <input type="text" name="athlete_adress" placeholder="Streetname 123" value="'. $row['athlete_adress'].'"><br>
    <label>Postal code</label><br>
    <input type="text" name="athlete_postal_code" placeholder="1234AB" value="'. $row['athlete_postal_code'].'"><br>
    <label>City / place</label><br>
    <input type="text" name="athlete_city" value="'. $row['athlete_city'].'"><br>
</div>

<div id="field2">
    <h3 style="margin-bottom: 0;">Social media (links)</h3>
    <small>(Optioneel)</small><br>
    <label>Facebook</label><br>
    <input type="text" name="athlete_facebook" value="'. $row['athlete_facebook'].'" style="color: blue; text-decoration: underline;"><br>
    <label>Twitter</label><br>
    <input type="text" name="athlete_twitter" value="'. $row['athlete_twitter'].'" style="color: blue; text-decoration: underline;"><br>
    <label>Instagram</label><br>
    <input type="text" name="athlete_instagram" value="'. $row['athlete_instagram'].'" style="color: blue; text-decoration: underline;"><br>
    <label>LinkedIn</label><br>
    <input type="text" name="athlete_linkedin" value="'. $row['athlete_linkedin'].'" style="color: blue; text-decoration: underline;"><br>
    <label>Youtube</label><br>
    <input type="text" name="athlete_youtube" value="'. $row['athlete_youtube'].'" style="color: blue; text-decoration: underline;"><br>
    <br>
</div>
<div id="field2" style="padding: 40px; margin-top: 330px; margin-left: -190px;">
    <div class="input-group" style="float: left;">
        <button type="submit" class="btn" name="edit_athlete">Edit athlete</button>
    </div>
    </form>
</div>';
}
?>
<div id="field2">
    <?php
    if (isset($_POST['edit_athlete'])) {
        $athlete_firstname = (str_replace("'","",$_POST['athlete_name']));
        $athlete_lastname = (str_replace("'","",$_POST['athlete_lastname']));
        $athlete_nickname = (str_replace("'","",$_POST['athlete_nickname']));
        $athlete_gender = ($_POST['athlete_gender']);
        $athlete_height = ($_POST['athlete_height']);
        $athlete_weight = ($_POST['athlete_weight']);
        $athlete_weightclass = ($_POST['athlete_weightclass']);
        $athlete_grade = ($_POST['athlete_grade']);
        $athlete_nationality = ($_POST['athlete_nationality']);
        $athlete_day_of_birth = date('Y-m-d', strtotime($_POST['athlete_day_of_birth']));
        $athlete_description = (str_replace("'","",$_POST['athlete_description']));
        /*$athlete_wins = ($_POST['athlete_wins']);
        $athlete_losses = ($_POST['athlete_losses']);
        $athlete_draws = ($_POST['athlete_draws']);
        $athlete_points = ($_POST['athlete_points']);*/
        //contact gegevens
        $athlete_email = (str_replace("'","",$_POST['athlete_email']));
        $athlete_phone1 = ($_POST['athlete_phone1']);
        $athlete_phone2 = ($_POST['athlete_phone2']);
        $athlete_adress = ($_POST['athlete_adress']);
        $athlete_postal_code = (str_replace("'","",$_POST['athlete_postal_code']));
        $athlete_city = (str_replace("'","",$_POST['athlete_city']));
        //social media
        $athlete_facebook = (str_replace("'","",$_POST['athlete_facebook']));
        $athlete_twitter = (str_replace("'","",$_POST['athlete_twitter']));
        $athlete_instagram = (str_replace("'","",$_POST['athlete_instagram']));
        $athlete_linkedin = (str_replace("'","",$_POST['athlete_linkedin']));
        $athlete_youtube = (str_replace("'","",$_POST['athlete_youtube']));

        //$athlete_total_matches = $athlete_wins + $athlete_losses + $athlete_draws;

        //echo wat je hebt ingevuld
        echo $athlete_firstname . $athlete_lastname . $athlete_nickname . $athlete_weightclass . $athlete_grade . $athlete_nationality . $athlete_day_of_birth
            . $athlete_description;

        //check of picture input leeg is
        if ($_FILES['athlete_picture']['size'] == 0 && $_FILES['cover_image']['error'] == 0)
        {
            $dst = $athlete_picture;
        }
        else {
            // cover_image is empty (and not an error)
            //foto naar mapje sturen
            $fnm=$_FILES["athlete_picture"]["name"];
            $dst="pics/athletepics/".$fnm;
            move_uploaded_file($_FILES["athlete_picture"]["tmp_name"], $dst);
        }

        /*athlete_total_matches = '$athlete_total_matches', athlete_wins = '$athlete_wins', athlete_losses = '$athlete_losses', athlete_draws = '$athlete_draws', athlete_points = '$athlete_points'*/

        $query = "UPDATE athletes SET athlete_firstname = '$athlete_firstname', athlete_lastname = '$athlete_lastname', athlete_nickname = '$athlete_nickname', athlete_gender = '$athlete_gender',
                  athlete_picture = '$dst', athlete_height = '$athlete_height', athlete_weight = '$athlete_weight', athlete_weightclass = '$athlete_weightclass',
                  athlete_grade = '$athlete_grade', athlete_nationality = '$athlete_nationality', athlete_day_of_birth = '$athlete_day_of_birth', athlete_description = '$athlete_description',
                  athlete_email = '$athlete_email', athlete_phone1 = '$athlete_phone1', athlete_phone2 = '$athlete_phone2', athlete_adress = '$athlete_adress', athlete_postal_code = '$athlete_postal_code', athlete_city = '$athlete_city',
                  athlete_facebook = '$athlete_facebook', athlete_twitter = '$athlete_twitter', athlete_instagram = '$athlete_instagram', athlete_linkedin = '$athlete_linkedin', athlete_youtube = '$athlete_youtube'
                  WHERE athlete_id = $athlete_id";
        mysqli_query($db, $query);
        header('location: APP_website2.php');

    }
    ?>
</div>