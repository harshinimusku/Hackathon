<!DOCTYPE html>
<html>
	<head>
	
		<title>Calendar</title>
		
		<!--For a website icon if needed-->
		 <link rel = "icon" href = "Soar.png" type = "image/gif" sizes = "16x16">
		
		<!--Stylesheet for the Soar website-->
		<link rel="stylesheet" href="sky.css"/>
		
		<!--Stylesheets for the Evo Calender from GitHub by edlynvillegas-->
		<!--From https://github.com/edlynvillegas/evo-calendar -->
		<link rel="stylesheet" href="evo-calendar.min.css"/>
		<link rel="stylesheet" href="evo-calendar.royal-navy.min.css"/>
	</head>
	<body>
		<!--Makes the navigation bar !-->
		<div id = "navbar" class = "sticky">
			<p id="logo">Soar</p>
			<!-- Put settings page here-->
			<a href = "index.html"> Settings </a>
			<a href = "calendar.php"> Calendar </a>
			<a href = "index.html"> Home </a>
		</div>
		
		<!-- The calendar itself-->
		<div id="calendar"></div>
	
		<!--Scripts run for the evo calendar functionality-->
		<!--From https://github.com/edlynvillegas/evo-calendar -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="evo-calendar.min.js"></script>
		
		<script>
			<!-- Initializing the calendar-->
			$(document).ready(function() {
				$('#calendar').evoCalendar({
					'theme': 'Royal Navy',
					'format': 'MM dd, yyyy'
				});
			})
		</script>
		
		<script>
			function newEvent(name, date, description, type)
			{
				var id = ""+name+date;
				$('#calendar').evoCalendar('addCalendarEvent', {
					id: id,
					name: name,
					description: description,
					date: date,
					type: type
				});
			}
		</script>
		
		<!-- Pop-up that will ask for event info-->
		<div id="addEvent">
			<!-- Form for retaining and submitting the info -->
			<form id="eventForm" class = "addEventInfo" action="database.php">
				<!-- Div for all of the form inputs and buttons -->
				<div class = "addEventInfo">
					<!-- Close button -->
					<button type="button" onclick="document.getElementById('addEvent').style.display='none'" class="cancel">X</button>
					<!-- Header/Title of the pop-up -->
					<h1 id="addHeader">Add New Event</h1>
					
					<!-- Input for event name-->
					<label for="eName"><b>Event Name</b></label>
					<input placeholder="Event Name" id="eName" name="eName" required/>
					
					<!-- Header/Title of the pop-up -->
					<label for="eDesc"><b>Description</b></label>
					<input placeholder="Event time, details, etc..." name="eDesc"/>
					
					<input id = "eDate" class="hidden"  name="eDate"/>
					<input id = "uName" class="hidden" name="uName"/>
					
					<label for="journal"><b>Journal</b></label>
					<input placeholder="How are you feeling today?" name="journal"/>
					<input type="submit" value="Submit">
				</div>
			</form>
		</div>

		<script>
			//Displays the pop up when the date is clicked 
			$('#calendar').on('selectDate', function(event, newDate, oldDate) {
				setHiddenInfo();
				document.getElementById('addEvent').style.display='block';
			});
			function setHiddenInfo(){
				document.getElementById("eDate").value = $('#calendar').evoCalendar('getActiveDate');
				document.getElementById("uName").value = 'Username';
			}
		</script>
		
		<?php   
		   include_once 'config.php';
		   $mysqli = new mysqli($servername, $username, $password, 'calendar');
		   // SQL query to select data from database
		   $sql = "SELECT * FROM calendarinfo";
		   $result = $mysqli->query($sql);
		   $mysqli->close();
		   $i = 0;
		   $events = '';
			while($rows=$result->fetch_assoc())
			{
               $eN = $rows['eventName'];
			   $eD = $rows['eventDate'];
			   $eDe = $rows['details'];	
			   $j = $rows['journal'];
			   if($eN != "Journal" && $eN != "journal")
			   {
					$events = $events.'newEvent("'.$eN.'","'.$eD.'","'.$eDe.'","event");';
			   }
			   if($j != "")
			   {
					$events = $events.'newEvent("Journal","'.$eD.'","'.$j.'","birthday");';
			   }
			}
			echo '<script> 
					window.onload = function() {'.$events.';}
				</script>';
		?>
		
	</body>
	
</html>