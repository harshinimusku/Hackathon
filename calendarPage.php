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
		<div id = "navbar" class = "sticky">
			<p id="logo">Soar</p>
			<a href = "login.html"> Login </a>
			<a href = "calendarPage.php"> Calendar </a>
			<a href = "index.html"> Home </a>
		</div>
		
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
			<form id="eventForm" class = "addEventInfo" action="calendarDatabase.php">
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
			$('#calendar').on('selectDate', function(event, newDate, oldDate) {
				document.getElementById('eDate').value = $('#calendar').evoCalendar('getActiveDate');
				document.getElementById('addEvent').style.display='block';
			});
		</script>
			
		
		<?php   
		   include_once 'config.php';
		   if (mysqli_select_db($conn, 'calendar'))
			{
			}
		   // SQL query to select data from database
		   $events = '';
		   $username = $_COOKIE['username'];
		   $sql = "SELECT * FROM calendarinfo";
		   $result = mysqli_query($conn, $sql);
			while($rows=$result->fetch_assoc())
			{
               $eN = $rows['eventName'];
			   $eD = $rows['eventDate'];
			   $eDe = $rows['details'];	
			   $j = $rows['journal'];
			   $uN = $rows['username'];
			   echo $username;
			   if($uN == $username)
			   {
				   if($eN != "Journal" && $eN != "journal")
				   {
						$events = $events.'newEvent("'.$eN.'","'.$eD.'","'.$eDe.'","event");';
				   }
				   if($j != "")
				   {
						$events = $events.'newEvent("Journal","'.$eD.'","'.$j.'","birthday");';
				   }
				}
			}
			echo '<script> 
					window.onload = function() {'.$events.';}
				</script>';
		?>
		
	</body>
</html>