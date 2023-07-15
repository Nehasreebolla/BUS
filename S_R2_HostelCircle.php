<!DOCTYPE html>
<head>
<style>
#table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: rgb(255,254,145);}

#table tr:hover {background-color: #ddd;}
#table tr{text-align: center;}
#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: rgb(14,214,224);
  color: black;
}
</style>
</head>
<?php
//to start connection
 $conn = mysqli_connect("localhost", "root", "", "BUS");   //mysqli i stands for improved
 if($conn->connect_error){ 									//conn is an object where connect_error is a property of it
 	die("Connection failed: ". $conn->connect_error);		//to terminate script execution
 }
 $SourceHostelCircle = "SELECT * from Route_2 where ID=2;";
 $result=$conn->query($SourceHostelCircle);
?>
 <table id="table">
 	<thead>
 		<tr >
 			<th>BUS 4</th>
 			<th>BUS 5</th>
 		</tr>
 	</thead>
     <tbody>
<?php
	if ($result->num_rows > 0) {
		//echo $column[1];
		//echo $column[2];
		while ($row = $result->fetch_row()) {
		   //echo  $row[0] . " ";
		  echo "<tr>";
			  echo  "<td> $row[1] </td>";
			  echo  "<td> $row[2] </td>";
			  //echo "<hr>";
		 echo"</tr>";
			 // echo "<br>";
			}

		} 
		else {
			echo "No data found.";
		}
?>

		</tbody>
</table> 
<?php
$conn->close(); // Close connection
?>
<?php
    $conn = mysqli_connect("localhost", "root", "", "BUS");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sourceHostelCircle = "SELECT BUS_4, BUS_5 FROM route_2 WHERE ID = 2;";
    $result = $conn->query($sourceHostelCircle);

    if ($result->num_rows > 0) {
        date_default_timezone_set("Asia/Kolkata");
        $currentTime = date('H:i');
    
        while ($row = $result->fetch_row()) {
            $busTime1 = $row[0];
            $busTime2 = $row[1];
       

            $startDateTime = new DateTime($currentTime);
            $endDateTime1 = new DateTime($busTime1);
            $endDateTime2 = new DateTime($busTime2);
    

            $timeDifference1 = $startDateTime->diff($endDateTime1);
            $timeDifference2 = $startDateTime->diff($endDateTime2);
       

            $minutesDifference1 = $timeDifference1->i;
            $hoursDifference1 = $timeDifference1->format('%h');

            $minutesDifference2 = $timeDifference2->i;
            $hoursDifference2 = $timeDifference2->format('%h');



            if ($minutesDifference1 <= 5 && $minutesDifference1 >0 && $hoursDifference1 == 0 && $startDateTime <= $endDateTime1) {
               
                echo "<script>alert('BUS IN " . $minutesDifference1 . " MINUTES " . $endDateTime1->format('H:i') . "');</script>";
            } else if ($minutesDifference2 <= 5 && $minutesDifference2 >0 && $hoursDifference2 == 0 && $startDateTime <= $endDateTime2) {
            
                echo "<script>alert('BUS IN " . $minutesDifference2 . " MINUTES " . $endDateTime2->format('H:i') . "');</script>";
            } 
            }        
        }
    
    ?>
<?php
$conn->close(); // Close connection
?>


</html>
