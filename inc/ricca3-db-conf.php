<?php
## Release build 2013.27.5
#############################################################################################
/**
 * <?php $wpdb->update( $table, $data, $where, $format = null, $where_format = null ); ?>
 * <?php $wpdb->insert( $table, $data, $format ); ?>
 * <?php $wpdb->delete( $table, $where, $where_format = null ); ?>
 * 
 * table: ricca3_logdb
 * 
 * type = UPDATE, INSERT, DELETE
 * tabla 
 * data 
 * donde 
 * format 
 * where_format 
 * stampuser
 * stampreferer = $_SERVER['HTTP_REFERER']
 * stampplace   = $_SERVER['REQUEST_URI']
 * stampremote  = $_SERVER['REMOTE_ADDR']
 * stampversion 
 * returns      = TRUE, FALSE
 * 
 *------------------------------------------------------------------------------ 
 * 
 * <?php $wpdb->query('query'); ?>
 * <?php $wpdb->get_row('query', output_type, row_offset); ?>
 * <?php $wpdb->get_results( 'query', output_type ); ?>
 * 
 * table: ricca3_logquery
 * 
 * type = QUERY, GETROW, GETRESULTS
 * query
 * stampuser
 * stampreferer = $_SERVER['HTTP_REFERER']
 * stampplace   = $_SERVER['REQUEST_URI']
 * stampremote  = $_SERVER['REMOTE_ADDR']
 * stampversion 
 * returns      = TRUE, FALSE
 * 
 * 
 */
#############################################################################################

#############################################################################################
/**
 * Database Update
 *
 *$wpdb->update('ricca3_credits_avaluacions', array( 'pendi' => '' ), array( 'idcredaval' => $res_cred[0]['idcredaval']) );
 *
 *<?php $wpdb->update( $table, $data, $where, $format = null, $where_format = null ); ?>
 * 
 *table 
 * (string) The name of the table to update.
 *
 *data 
 * (array) Data to update (in column => value pairs). Both $data columns and $data values should be "raw" (neither should be SQL escaped). 
 * This means that if you are using GET or POST data you may need to use stripslashes() to avoid slashes ending up in the database.
 * 
 *where 
 * (array) A named array of WHERE clauses (in column => value pairs). Multiple clauses will be joined with ANDs. Both $where columns and 
 * $where values should be "raw".
 * 
 *format 
 * (array|string) (optional) An array of formats to be mapped to each of the values in $data. If string, that format will be used for all 
 * of the values in $data.
 * 
 *where_format 
 * (array|string) (optional) An array of formats to be mapped to each of the values in $where. If string, that format will be used for all 
 * of the items in $where.
 * 
 * Possible format values: %s as string; %d as integer (whole number) and %f as float. (See below for more information.) 
 * If omitted, all values in $where will be treated as strings.
 * 
 *This function returns the number of rows updated, or false if there is an error.
 *
 * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 * 
 * !! $wpdb->update RETORNA FALSE SI NO HI HAN CANVIS EN L'ENTRADA I PER TANT NO MES S'ENREGISTRA EL 'TRUE'.
 * 
 */
#############################################################################################
function ricca3_dbupdate($table, $data, $where, $format = null, $where_format = null) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
//	if($current_user->roles != 'super_admin' or $current_user->roles != 'advanced') return;
//  echo 'User roles: ' . implode(', ', $current_user->roles) . "\n";	
	if( implode(', ', $current_user->roles) == 'contributor' ) return;
	$stampversion = '2014.23.1';
	$encodeddata  = json_encode($data,  JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
	$encodedwhere = json_encode($where, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
	$return_value = $wpdb->update( $table, $data, $where, $format, $where_format );
	if( $return_value > 0 ){
		$wpdb->insert( 'ricca3_logdb',
				array(  type         => 'UPDATE',
						tabla        => $table,
						data         => $encodeddata,
						donde        => $encodedwhere,
						format       => $format,
						where_format => $where_format,
						stampuser    => $current_user->user_login,
						stampreferer => $_SERVER['HTTP_REFERER'],
						stampplace   => $_SERVER['REQUEST_URI'],
						stampremote  => $_SERVER['REMOTE_ADDR'],
						stampversion => $stampversion,
						returns      =>  'TRUE'));
		return $return_value;
	}else{
//		$wpdb->insert( 'ricca3_logdb',
//				array(  type         => 'UPDATE',
//						table        => $table,
//						data         => $encodeddata,
//						where        => $encodedwhere,
//						format       => $format,
//						where_format => $where_format,
//						stampuser    => $current_user->user_login,
//						stampreferer => $_SERVER['HTTP_REFERER'],
//						stampplace   => $_SERVER['REQUEST_URI'],
//						stampremote  => $_SERVER['REMOTE_ADDR'],
//						stampversion => $stampversion,
//						returns      =>  'FALSE'));
		return FALSE;
	}
}

#############################################################################################
/**
 * Database Insert
 * 
 * $wpdb->insert('ricca3_alumne_especialitat', array('idalumne' => $row_cre['idalumne'], 'idgrup' => $row_cre['idgrup'], 
 * 'idany' => $row_any['idany'], 'idestat_es' => 1, 'repeteix' => 'R'));
 * 
 *  <?php $wpdb->insert( $table, $data, $format ); ?>
 *   
 *table 
 * (string) The name of the table to insert data into.
 * 
 *data 
 * (array) Data to insert (in column => value pairs). Both $data columns and $data values should be "raw" (neither should be SQL escaped).
 * 
 *format 
 * (array|string) (optional) An array of formats to be mapped to each of the value in $data. If string, that format will be used for all 
 * of the values in $data. If omitted, all values in $data will be treated as strings unless otherwise specified in 
 * wpdb::$field_types.
 * 
 *Possible format values: %s as string; %d as integer (whole number); and %f as float. (See below for more information.)
 *
 *After insert, the ID generated for the AUTO_INCREMENT column can be accessed with:
 * $wpdb->insert_id
 * 
 * This function returns false if the row could not be inserted.
 * 
 *Please note: The value portion of the data parameter's column=>value pairs must be scalar. If you pass an array (or object) as a value 
 *to be inserted you will generate a warning similar to "mysql_real_escape_string() expects parameter 1 to be string, array given on 
 *line 880 in file /var/www/html/wp-includes/wp-db.php".
 *
 * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_dbinsert($table, $data, $format = null) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	if( implode(', ', $current_user->roles) == 'contributor' ) return;
	$stampversion = '2014.23.1';
	if($wpdb->insert( $table, $data, $format )){
		
	}else{
		
	}
}

#############################################################################################
/**
 * Database Delete
 * 
 * $wpdb->delete('ricca3_pla', array('idany' => $_POST['any']));
 * 
 * <?php $wpdb->delete( $table, $where, $where_format = null ); ?>
 * 
 *Parameters
 *$table
 * (string) (required) Table name.
 * Default: None
 * 
 *$where
 * (array) (required) A named array of WHERE clauses (in column -> value pairs). 
 * Multiple clauses will be joined with ANDs. Both $where columns and $where values should be 'raw'.
 * Default: None
 * 
 *$where_format
 * (string/array) (optional) An array of formats to be mapped to each of the values in $where. 
 * If a string, that format will be used for all of the items in $where. A format is one of '%d', '%f', '%s' (integer, float, string; 
 * see below for more information). If omitted, all values in $where will be treated as strings unless otherwise specified in wpdb::$field_types.
 * Default: null
 *
 * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_dbdelete($table, $where, $where_format = null) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	if( implode(', ', $current_user->roles) == 'contributor' ) return;
	$stampversion = '2014.23.1';
	$encodedwhere = json_encode($where, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);	
	$return_value = $wpdb->delete( $table, $where, $where_format);
	if($return_value){
		$wpdb->insert( 'ricca3_logdb',
				array(  type         => 'DELETE',
						tabla        => $table,
						donde        => $encodedwhere,
						where_format => $where_format,
						stampuser    => $current_user->user_login,
						stampreferer => $_SERVER['HTTP_REFERER'],
						stampplace   => $_SERVER['REQUEST_URI'],
						stampremote  => $_SERVER['REMOTE_ADDR'],
						stampversion => $stampversion,
						returns      =>  'TRUE'));
		return $return_value;
	}else{
		return FALSE;
	}
}

#############################################################################################
/**
 * Database Query
 *
 *<?php $wpdb->query('query'); ?>
 * 
 *query 
 * (string) The SQL query you wish to execute.
 * 
 * This function returns an integer value indicating the number of rows affected/selected. For CREATE, ALTER, TRUNCATE and DROP SQL statements, 
 * this function returns TRUE on success. If a MySQL error is encountered, the function will return FALSE. Note that since both 0 and FALSE 
 * may be returned, you can use the equality == operator to test for falsy returns (i.e., a returned value that is logically FALSE). 
 * Using the identicality === operator may result in unexpected behavior as it compares the types returned in addition to the values...
 * 
 * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_dbquery($query) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$stampversion = '2014.23.1';
	if($wpdb->query($query)){
		
	}else{
		
	}
}

#############################################################################################
/**
 * Database Get_row
 * 
 *  <?php $wpdb->get_row('query', output_type, row_offset); ?>
 *   
 *query 
 * (string) The query you wish to run.
 * 
 *output_type 
 * One of three pre-defined constants. Defaults to OBJECT.
 *  OBJECT - result will be output as an object.
 *  ARRAY_A - result will be output as an associative array.
 *  ARRAY_N - result will be output as a numerically indexed array.
 *  
 *row_offset 
 * (integer) The desired row (0 being the first). Defaults to 0.
 * 
  * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_dbgetrow($query, $output_type, $row_offset) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$stampversion = '2014.23.1';
	$return_value = $wpdb->get_row($query, $output_type, $row_offset);
	if( $return_value ){
		
	}else{
		
	}
}

#############################################################################################
/**
 * Database Get Results
 *
 * <?php $wpdb->get_results( 'query', output_type ); ?>
 *  
 *query 
 * (string) The query you wish to run. Setting this parameter to null will return the data from the cached results of the previous query.
 * 
 *output_type 
 * One of four pre-defined constants. Defaults to OBJECT. See SELECT a Row and its examples for more information.
 *  OBJECT - result will be output as a numerically indexed array of row objects.
 *  OBJECT_K - result will be output as an associative array of row objects, using first column's values as keys (duplicates will be discarded).
 *  ARRAY_A - result will be output as an numerically indexed array of associative arrays, using column names as keys.
 *  ARRAY_N - result will be output as a numerically indexed array of numerically indexed arrays.
 *  
 *Since this function uses the $wpdb->query() function all the class variables are properly set. 
 *The results count for a 'SELECT' query will be stored in $wpdb->num_rows.
 *
 * @since ricca3.v.2014.23.1
 * @author Efraim Bayarri
 */
#############################################################################################
function ricca3_dbgetresults($query, $output_type) {
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$stampversion = '2014.23.1';
	$return_value = $wpdb->get_results($query, $output_type);
	if( $return_value ){
		
	}else{
		
	}
}