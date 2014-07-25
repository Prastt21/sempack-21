
<?php
session_start();
if (isset($_SESSION['nama_operator'])) {
	
    $text = $_POST['text'];
	date_default_timezone_set('Asia/Jakarta');
    $date = date('j M y/H:i');
    $handle = fopen("messages.html", 'a+');
	$messageall = file_get_contents('./messages.html', true);
	$count = strlen($messageall);
	$old = '';
	
	/* delete ketika data sudah diatas 30000 karakter sembari backup*/
	if($count > 30000 ){
		$dom = new DOMDocument;
		$dom->loadHTML( $messageall );

		$xpath = new DOMXPath( $dom );
		$pDivs = $xpath->query(".//div[@class='message']");

		foreach ( $pDivs as $div ) {
		  $div->parentNode->removeChild( $div );
		}
		
		$old = preg_replace( "/.*<body>(.*)<\/body>.*/s", "", $dom->saveHTML() );
		$oldhandle = fopen("messages_old.html", 'a+');
		fwrite($oldhandle, $messageall);
		file_put_contents("messages.html",'');
	}
	/* end */
	$new = '<div class="message">
						<div class="info_wrap">		
							<div class="name">' . $_SESSION['nama_operator'] .'</div>
							<div class="right">'.$date .'</div>
						</div>
						<div class="message_text">' . $text . '</div>
					</div>';
    fwrite($handle, $new);
    fclose($handle);
}
?>
