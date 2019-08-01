<?php
class Database {

	function create_database($data)
	{
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');
		if(mysqli_connect_errno())
			return false;
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);
		$mysqli->close();
		return true;
	}

	function create_tables($data)
	{
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
		if(mysqli_connect_errno())
			return false;
		// $query = file_get_contents('assets/sqlcommand.sql');
		// $mysqli->multi_query($query);
		// $mysqli->close();

				// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file('assets/sqlcommand.sql');
		// Loop through each line
		foreach ($lines as $line)
		{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
			    continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
			    // Perform the query
			    $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($mysqli) . '<br /><br />');
			    // Reset temp variable to empty
			    $templine = '';
			}
		}
		
		return true;
	}
}
