<?php

// Name of the file
$filename = 'assets/sqlcommand.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'db_1';

// Connect to MySQL server
$mysqli  = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database) or die('Error connecting to MySQL server: ' . mysqli_connect_errno());


// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
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
 echo "Tables imported successfully";
?>