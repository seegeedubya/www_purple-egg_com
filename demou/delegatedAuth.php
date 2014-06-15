<?php

$authlog = "./demou.auth.txt";

//$fd = fopen($authlog, "a");


file_put_contents($authlog, "\n\nNew POST received 20091019\n", FILE_APPEND);
file_put_contents($authlog, "=== HEADER ===\n", FILE_APPEND);

ob_start();
//print_r( $_SERVER );
var_dump($_SERVER);
$output = ob_get_clean();

// if you want to append the print_r output of $some_array to, let's say, log.txt:

file_put_contents($authlog, $output, FILE_APPEND);

//ob_start();
//print_r( $ );
//$output = ob_get_clean();

// if you want to append the print_r output of $some_array to, let's say, log.txt:

//file_put_contents( $authlog, $output, FILE_APPEND);




	
	//$headers = request_headers();
	//foreach ($headers as $header => $value) {
//		logToFile($authlog, "$header: $value\n");
//		if ($header = "Authorization") {
//			$aolAuthorization = $value;
//		}
//	}


	
	

	$authorization ="AUTH: ".$_SERVER["Authorization"]."\n\n";
	
	
file_put_contents($authlog,$authorization, FILE_APPEND);
//	logToFile($authlog, "AUTHORIZATION: $authorization\n");
	//

	logToFile($authlog, "\n=== POST ===\n");

	// Then grab the request from the POST itself
	$aolSamlRequest = $_POST['SAMLRequest'];
	$aolSigAlg = $_POST['SigAlg'];
	$aolSignature = $_POST['Signature'];
	logToFile($authlog, "AOL SAML REQUEST: $aolSamlRequest\n");
	logToFile($authlog, "SIGNATURE ALGORITHM: $aolSigAlg\n");
	logToFile($authlog, "SIGNATURE: $aolSignature\n");


	
	
	logToFile($authlog, "\n=== DECODING ===\n");
	
	$b64 = base64_decode(str_replace(" " , "+", $aolSamlRequest));
	logToFile($authlog, "\n$b64\n\n");
	
	
	// Now we deal with the SAML AuthnRequest message
	//$decodedSAMLRequest = base64_decode(urldecode($aolSamlRequest));
	//$decodedSAMLRequest = base64_decode($aolSamlRequest);
	//logToFile($authlog, "\n$decodedSAMLRequest\n\n");

fclose($fd);

function logToFile($filename, $msg)
{
	// open file
	$fd = fopen($filename, "a");

	// append date/time to message
	$str = "[" . date("Y-m-d h:i:s", mktime()) . "] " . $msg;

	// write string
	fwrite($fd, $str . "\n");

	// close file
	fclose($fd);
}



?>

