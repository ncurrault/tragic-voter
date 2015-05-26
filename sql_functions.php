<?php

// YAY INTERNET! (https://github.com/kch/heroku-php-pg/blob/master/index.php)
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

$sql_connection = pg_connect(pg_connection_string_from_database_url());
if (pg_connection_status($sql_connection) != PGSQL_CONNECTION_OK)
{
	error_log("Error connecting to database.");
}

function sqlQuery($q, $params=null)
{		
	global $sql_connection;
	
	if ($params)
	{
		$q_result = pg_query_params($sql_connection, $q, $params);
	}
	else
	{
		$q_result = pg_query($sql_connection, $q);
	}
	
	
	$ret = pg_fetch_all($q_result);
	if (!$ret) // I want to be able to iterate over the result in index.php
	{
		$ret = array( );
	}

	return $ret;
}

function sqlAddRow($table, $a) {
	$qPt1 = "INSERT INTO $table (";
	$qPt2 = "VALUES (";

	$queryParams = array( );
	$i=1;

	foreach ($a as $key => $val) {
		$qPt1 .= $key . ", ";
		$qPt2 .= '$' . $i . ", ";

		array_push($queryParams, $val);
		$i++;
	}

	$qPt1=substr($qPt1, 0, strlen($qPt1)-2) . ") ";
	$qPt2=substr($qPt2, 0, strlen($qPt2)-2) . ");";

	$q = $qPt1 . $qPt2;

	return sqlQuery($q, $queryParams);
}
?>