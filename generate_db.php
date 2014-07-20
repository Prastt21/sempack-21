<?php
backup_tables('localhost','root','','sempak_db');

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		/* $tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		} */
		$tables = array("asuransi", "aula", "beasiswa", "informasi", "jenis_beasiswa", "jurusan",
                    "keterangan_ortu", "pendaftaran_asuransi","pendaftaran_beasiswa","pengguna","periode",
                    "sistem","sys_level","sys_level_menu","sys_menu");
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	$temp_table = $tables;
	krsort($temp_table);
	foreach($temp_table as $tablet)
	{
		@$return.= "\n DROP TABLE IF EXISTS ".$tablet.";\n";
	}
	
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);

		//@$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		
		@$return.= "\n\n ".str_replace('CREATE TABLE','CREATE TABLE',$row2[1]).";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("/\r\n/","\\r\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('./backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	// echo './backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
	
	/* creates a compressed zip file */
	function create_zip($files = array(),$destination = '',$overwrite = false) {
		//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite) { return false; }
		//vars
		$valid_files = array();
		//if files were passed in...
		if(is_array($files)) {
			//cycle through each file
			foreach($files as $file) {
				//make sure the file exists
				if(file_exists($file)) {
					$valid_files[] = $file;
				}
			}
		}
		//if we have good files...
		if(count($valid_files)) {
			//create the archive
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
				return false;
			}
			//add the files
			foreach($valid_files as $file) {
				$zip->addFile($file,$file);
			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
			
			//close the zip -- done!
			$zip->close();
			
			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
	}
	
	$files_to_zip = array(
	'./backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql'
	);

	$result = create_zip($files_to_zip,'./backup/BACKUP-SEMPAK-'.time().'.zip');
	echo './backup/BACKUP-SEMPAK-'.time().'.zip';
	//force_download('ss.sql',implode(',',$tables));
	unlink('./backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql');
}


?>
