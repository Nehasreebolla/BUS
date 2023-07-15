

<!DOCTYPE html>
<html>
<head>
    <title>Vote Yes or No</title>
    <link rel="icon" href="bus.png">
  <link rel="stylesheet" type="text/css" href="http://192.168.33.126/style.css">
</head>
<body>
<!--statusbar-->
    <ul>
      <li>
        <a href="./BUS FRONT_PAGE.html">
          <img src="bus.png" class="move-right">
        </a>
      </li>
      <li>
        <a href="./BUS FRONT_PAGE.html"><p class="move-right">HOME</p></a>
      </li>
      <li class="dropdown"><a href="#SETTINGS"><p class="move-right">SETTINGS</p></a>
<div class="dropdown-content">
           <script >window.addEventListener('message', function(event) {
      var color = event.data;
      document.body.style.backgroundColor = color;
    });
<!--statusbar-->

 function openTheme() {
      var url = './theme.html'; 
      var newWindow = window.open(url, '_blank');
    }
</script></a>
          <a href="#">Themes  <form id="background-form">
    <div id="background-selector">
      <button type="button" style="background-color:rgb(66,250,255);color:black;" onclick="openTheme()">Change Background Color</button>
    </div>
  </form>
</a>
        </div>
</li>
      <li class="dropdown"><a href="#"><p class="move-right">ABOUT</p></a>
<div class="dropdown-content">
          <a href="./About US.html">About US</a>
          <a href="https://www.google.com/maps/dir//IITH+Road,+Near+NH-65,+Sangareddy,+Kandi,+Telangana+502285/@17.5946904,78.0529996,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x3bcbefdc136bffbb:0x73414ff6594c9191!2m2!1d78.1230401!2d17.5947027?entry=ttu">IITH MAP</a> 
        </div>
</li>
<li class="dropdown"><a href="#"><p class="move-right">CUSTOMER VOTE</p></a>
<div class="dropdown-content">
          <a href="./USER%20VOTE.php">Hostel Circle to Main Gate</a>
          <a href="./USER%20VOTE1.php">MainGate to Hostel Circle</a>
          <a href="./USER%20VOTE2.php">Hostel Circle to New Hostels</a>
          <a href="./USER%20VOTE3.php">New Hostels to Hostel Circle</a>
        </div>
</li>
      
    </ul>  
    <h1 style="font-size:200%;margin-left:40%;margin-top:2%;">Hostel Circle to MainGate </h1>
    <h1 style="font-size:200%;margin-left:45%;margin-top:2%;">Vote Yes or No</h1>
    <form method="POST" action="">
        <label for="yes" style="color:green;font-size:200%;margin-left:45%;margin-top:5%;">Yes</label>
        <input type="radio" name="vote" value="yes" id="yes" required>

        <label for="no" style="color:red;font-size:200%;">No</label>
        <input type="radio" name="vote" value="no" id="no" required>

        <button type="submit" style="font-size:150%;color:blue;">Submit</button>
    </form>
</body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "BUS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT yes_count, no_count FROM vote_counts";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $yes_count = $row['yes_count'];
    $no_count = $row['no_count'];
} else {
    die("Error retrieving vote counts: " . mysqli_error($conn));
}

$vote_given=0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vote = $_POST['vote'];

    if ($vote === 'yes') {
        $yes_count++;
        $sql = "UPDATE vote_counts SET yes_count = $yes_count";
        mysqli_query($conn, $sql);
        $vote_given=1;
        echo '<p style="font-size: 150%; color: blue; margin-left: 46%; margin-top: 3%;">Thank you for voting Yes!<br></p>';
    } elseif ($vote === 'no') {
        $no_count++;
        $sql = "UPDATE vote_counts SET no_count = $no_count";
        mysqli_query($conn, $sql);
        echo '<p style="font-size: 150%; color: blue; margin-left: 46%; margin-top: 3%;">Thank you for voting No!<br></p>';
         $vote_given=1;
    } else {
        echo "Invalid vote option!";
        $vote_given=0;
    }

} 
?>


    <?php
    $sourceHostelCircle = "SELECT BUS_1, BUS_2, BUS_3 FROM Route_1 WHERE ID = 2;";
    $routeResult = $conn->query($sourceHostelCircle);

    if ($routeResult && $routeResult->num_rows > 0) {
        data_default_timezone_set("Asia/Kolkata");
        $currentTime = date('H:i');

        while ($row = $routeResult->fetch_row()) {
            $busTime1 = $row[0];
            $busTime2 = $row[1];
            $busTime3 = $row[2];

            $startDateTime = new DateTime($currentTime);
            $endDateTime1 = new DateTime($busTime1);
            $endDateTime2 = new DateTime($busTime2);
            $endDateTime3 = new DateTime($busTime3);

            $timeDifference1 = $startDateTime->diff($endDateTime1);
            $timeDifference2 = $startDateTime->diff($endDateTime2);
            $timeDifference3 = $startDateTime->diff($endDateTime3);

            $minutesDifference1 = $timeDifference1->i;
            $hoursDifference1 = $timeDifference1->format('%h');

            $minutesDifference2 = $timeDifference2->i;
            $hoursDifference2 = $timeDifference2->format('%h');

            $minutesDifference3 = $timeDifference3->i;
            $hoursDifference3 = $timeDifference3->format('%h');

            if ($minutesDifference1 >=5 && $minutesDifference1 <=8 && $hoursDifference1 == 0 && $startDateTime >= $endDateTime1) {
         
                $yes_count = 0;
                $no_count = 0;
                $sql = "UPDATE vote_counts SET yes_count = 0, no_count = 0";
                $result = mysqli_query($conn, $sql);

                echo '<p style="font-size: 150%; color: green; margin-left: 45%; margin-top: 3%;">NO BUS IN THIS TIME<br></p>';
                if (!$result) {
                    die("Error resetting vote counts: " . mysqli_error($conn));
                }

            } elseif ($minutesDifference2 >= 5 && $minutesDifference2 <= 8 && $hoursDifference2 == 0 && $startDateTime >= $endDateTime2) {
      
                $yes_count = 0;
                $no_count = 0;
                $sql = "UPDATE vote_counts SET yes_count = 0, no_count = 0";
                $result = mysqli_query($conn, $sql);
                echo '<p style="font-size: 150%; color: green; margin-left: 45%; margin-top: 3%;">NO BUS IN THIS TIME<br></p>';
                if (!$result) {
                    die("Error resetting vote counts: " . mysqli_error($conn));
                }

            } elseif ($minutesDifference3 >= 5 && $minutesDifference3 <= 8 && $hoursDifference3 == 0 && $startDateTime >= $endDateTime3) {
    
                $yes_count = 0;
                $no_count = 0;
                $sql = "UPDATE vote_counts SET yes_count = 0, no_count = 0";
                $result = mysqli_query($conn, $sql);
                echo '<p style="font-size: 150%; color: green; margin-left: 45%; margin-top: 3%;">NO BUS IN THIS TIME<br></p>';
                if (!$result) {
                    die("Error resetting vote counts: " . mysqli_error($conn));
                }
            }
        }
    }
   
         echo '<p style="font-size: 150%; color: purple; margin-left: 46%; margin-top: 3%;">YES: ' . $yes_count . '<br></p>';
    
    
         echo '<p style="font-size: 150%; color: purple; margin-left: 46%; margin-top: 2%;">NO: ' . $no_count . '<br></p>'; 
    
if($yes_count==0 && $no_count==0)
{ $yes_prcntge=0;
  $no_prcntge=0;
}
else{
$yes_prcntge=$yes_count*100/($yes_count+$no_count);
  $no_prcntge=$no_count*100/($yes_count+$no_count);
}
   echo '<p style="font-size: 150%; color: purple; margin-left: 45%; margin-top: 3%;">YES PERCENTAGE: ' . $yes_prcntge . '<br></p>';
    echo '<p style="font-size: 150%; color: purple; margin-left: 45%; margin-top: 3%;"> NO PERCENTAGE: ' . $no_prcntge. '<br></p>';
    if($vote_given==1){
     echo '<script>
        setTimeout(function() {
            window.location.href = "./BUS%20FRONT_PAGE.html";
        }, 3000);
    </script>';
}
?>
