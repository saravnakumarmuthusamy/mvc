<?php

/*****************************************************************************************************
 ** Function Name : getObject
 ** Objective : Gets the Object Method based on the requested class it uses single ton method
 ****************************************************************************************************/
function getObject($className=''){
	loadClass($className);
	return getInstance($className);
}

/*****************************************************************************************************
 ** Function Name : loadClass
 ** Objective : used to require the mentioned class
 ** Parameters : $className : string
 ****************************************************************************************************/
function loadClass($className=''){
	$classFile = CONTROLLER_PATH.'/'.$className.'.php';
	
	if(file_exists($classFile)){
		require_once($classFile);
	}else{
		// Dont Delete For Reference - throw new ClassNotFoundException($message);
		echo $className.' : Class Not Found, set ClassPath';
		exit;
	}
}

/*****************************************************************************************************
 ** Function Name : getInstance
 ** Objective : This function is used to implement the singleton object for the class
 **             It will check whether the object for this class is already exists or not
 **             It will return the object, if exists, else it will create and return.
 ** Parameters : $className : string
 ** Return Value : Object
 ****************************************************************************************************/
function &getInstance ($class){
	static $instances = array();  // array of instance names
 	global $db, $params;
	if (!array_key_exists($class, $instances)) {
		   // instance does not exist, so create it
		   $instances[$class] = new $class($db);
	} // if
	$instance =& $instances[$class];
	//Change the parameter
	$instance->setParams($params);
	return $instance;
}

static $headerScript = array();
static $headerStyle = array();
/* Set the error message in session with given error code*/
function setErrorMessage($errCode, $errMsg)
{
	if(!isset($_SESSION['error']))
	{
		$_SESSION['error'] = array();	
	}
	$_SESSION['error'][$errCode] = $errMsg;
}
/* Set redirect to the page*/
function setRedirect($url)
{
	if($_POST['ajaxMode']){
		echo array2json(array('redirect' => $url));
	} else if($_GET['ajaxMode']){
		echo '<script type="text/javascript">window.location ="'.$url.'"</script>';
	} else {
		header('location: '. $url);
	}
	exit;
}
/* Clear the error */
function clearErrorMessage($errCode = '')
{
	if(isset($_SESSION['error'])){
		if($errCode) {
			unset($_SESSION['error'][$errCode]);
		} else {
			unset($_SESSION['error']);	
		}
	}
	unset($_SESSION['successMsg']);
}
/* Function Set Message*/
function setMessage($message)
{
	$_SESSION['successMsg'] = $message;
	return true;
}
/* Add the javascript reference to the header tag */
function addHeaderScript($scriptFile, $scriptPath = ROOT_HTTP_PATH, $scriptFolder = 'js')
{
	global $headerScript;
	$currentVersion = 3.1;
	if(is_array($scriptFile)){
		foreach($scriptFile as $key => $jsScript) {
			$jsScript .= '?'. $currentVersion;
			$headerScript[] = '<script type="text/javascript" src="'.$scriptPath.'/'.$scriptFolder.'/'.$jsScript.'"></script>';
		}
	} else {
		$scriptFile .= '?'. $currentVersion;
		$headerScript[] = '<script type="text/javascript" src="'.$scriptPath.'/'.$scriptFolder.'/'.$scriptFile.'"></script>';
	}
}
/* Get the Added Header scripts */
function getHeaderScript()
{
	global $headerScript;
	return (implode("\n", $headerScript));
}
/* Add the Css reference to the header tag */
function addHeaderStyle($styleFile, $stylePath = ROOT_HTTP_PATH, $styleFolder = 'css')
{
	global $headerStyle;
	if(is_array($styleFile)){
		foreach($styleFile as $key => $cssStyle) {
			$headerStyle[] = '<link rel="stylesheet" type="text/css" href="'.$stylePath.'/'.$styleFolder.'/'.$cssStyle.'" />';
		}
	} else {
		$headerStyle[] = '<link rel="stylesheet" type="text/css" href="'.$stylePath.'/'.$styleFolder.'/'.$styleFile.'" />';
	}
}
/* Get the Added Header scripts */
function getHeaderStyle()
{
	global $headerStyle;
	return (implode("\n", $headerStyle));
}

/* Get Headers */
function getHeaders()
{
	$headerJs = getHeaderScript();
	$headerCss = getHeaderStyle();
	return $headerJs."\n".$headerCss;
}

/* Get the error message */
function getErrorMessage($errCode = '')
{
	if(isset($_SESSION['error'])){
		if($errCode) {
			return ($_SESSION['error'][$errCode]);
		} else {
			return ($_SESSION['error']);	
		}
	}
	return false;
}
/* Generate Select option from array */
function generateSelectOption($srcArr='', $optionSelected='', $optionValue='') {
	$optionsToDisplay = "";
	
	foreach ($srcArr as $srcArrKey => $srcArrValue) {
		$optionsToDisplay .= '<option value ="'. ( ($optionValue) ?  $srcArrValue : $srcArrKey ).'" ';
		if (is_array($optionSelected)) {
			if (in_array($srcArrKey, $optionSelected) || ( $optionValue && in_array($srcArrValue, $optionSelected) ) ) {				
				$optionsToDisplay .= "selected ";
			}
		} else if (($srcArrKey == $optionSelected || ( $optionValue && $srcArrValue == $optionSelected)) && $optionSelected!='') {
			$optionsToDisplay .= "selected ";
		}
		
		$optionsToDisplay .= ">".$srcArrValue."</option>";
	}
	return $optionsToDisplay;
}

/* Generate DB Select Options */
function generateDBSelectOption($srcArr='', $keyField, $valueField, $optionSelected='', $optionSkip = '') {
	$optionsToDisplay = "";
	foreach ($srcArr as $srcArrKey => $srcArrValue) {
		if($optionSkip == $srcArrValue[$keyField]) continue;
		$optionsToDisplay .= '<option value ="'. $srcArrValue[$keyField] .'" ';
		if (is_array($optionSelected)) {
			if (in_array($srcArrValue[$keyField], $optionSelected) ) {				
				$optionsToDisplay .= 'selected="selected" ';
			}
		} else if ($srcArrValue[$keyField] == $optionSelected) {
			$optionsToDisplay .= "selected ";
		}
		$optionsToDisplay .= ">".$srcArrValue[$valueField]."</option>";
	}
	return $optionsToDisplay;
}

/* Function to check value is empty or not */
function checkEmpty($value)
{
	return (trim($value) == '');
}
/* Function to check given email is valid */
function validateEmail($value)
{
	$regex= "/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/";
	return (preg_match($regex, $value));
}
/* Function to get IP Address*/
function getRealIpAddr()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	  $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   { //to check ip is pass from proxy
	  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['HTTP_FORWARDED_FOR']))  {
	  $ip = $_SERVER['HTTP_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {
	  $ip = $_SERVER['HTTP_X_FORWARDED'];
	} elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
	  $ip = $_SERVER['HTTP_FORWARDED'];
	} else {
	  $ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

//Function to replace the array contents in a template string
function replaceContent($inputArray, $content){	
	if($_SERVER['SERVER_NAME']) {
	  $inputArray['siteUrl'] = ROOT_HTTP_PATH;
	 } else {
	  $inputArray['siteUrl'] = 'http://www.bandjamit.com';
	 }
	$inputArray = array_change_key_case($inputArray, CASE_LOWER);
	$message = preg_replace_callback("/{([\w]*?)}/", function($m) use($inputArray) {
		 $var = strtolower($m[1]);
	 return ($inputArray[$var]); }
	 , $content);
	return $message;
}

// mail function changed on 26/mar/2012
function authgMail($from, $namefrom, $to, $nameto, $subject, $message) {
	
	
	$smtpServer = "relay.gothamweb.com";
	$port = "25"; 
	$timeout = "45";			
	
	$localhost = $_SERVER['REMOTE_ADDR'];	   // Defined for the web server.  Since this is where we are gathering the details for the email
	$newLine = "\r\n";			 // aka, carrage return line feed. var just for newlines in MS
	$secure = 0;				  // change to 1 if your server is running under SSL
	//connect to the host and port
	$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
	$smtpResponse = fgets($smtpConnect, 4096);
	
	if(empty($smtpConnect)) {
	   $output = "Failed to connect: $smtpResponse";
	   return $output;
	}
	else {
	   $logArray['connection'] = "<p>Connected to: $smtpResponse</p>";
	}
	
	//you have to say HELO again after TLS is started
   fputs($smtpConnect, "HELO $smtpServer". $newLine);
   $smtpResponse = fgets($smtpConnect, 4096);
   $logArray['heloresponse2'] = "$smtpResponse";

	//email from
	fputs($smtpConnect, "MAIL FROM: <$from>" . $newLine);
	$smtpResponse = fgets($smtpConnect, 4096);
	$logArray['mailfromresponse'] = "$smtpResponse";
	
	//email to
	fputs($smtpConnect, "RCPT TO: <$to>" . $newLine);
	$smtpResponse = fgets($smtpConnect, 4096);
	$logArray['mailtoresponse'] = "$smtpResponse";
	
	//the email
	fputs($smtpConnect, "DATA" . $newLine);
	$smtpResponse = fgets($smtpConnect, 4096);
	$logArray['data1response'] = "$smtpResponse";
	
	//construct headers
	$headers = "MIME-Version: 1.0" . $newLine;
	$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
	$headers .= "Return-Path: {$username}" . $newLine;
	$headers .= "Reply-To: {$username}" . $newLine;
	//$headers .= "To: $nameto <$to>" . $newLine;
	$headers .= "From: $namefrom <$from>" . $newLine;
	$headers .= "X-Mailer: PHP/". phpversion();
	
	//observe the . after the newline, it signals the end of message
	fputs($smtpConnect, "To: $to\r\nFrom: $from\r\nSubject: $subject\r\n$headers\r\n\r\n$message\r\n.\r\n");
	$smtpResponse = fgets($smtpConnect, 4096);
	$logArray['data2response'] = "$smtpResponse";
	
	// say goodbye
	fputs($smtpConnect,"QUIT" . $newLine);
	$smtpResponse = fgets($smtpConnect, 4096);
	$logArray['quitresponse'] = "$smtpResponse";
	$logArray['quitcode'] = substr($smtpResponse,0,3);
	fclose($smtpConnect);
	
	//a return value of 221 in $retVal["quitcode"] is a success
	return($logArray);
}

//Function to send Email

function sendMailold($fromEmail, $toEmail, $subject, $message, $bcc = '', $sender='', $cc='')
{
	require_once(SITE_PATH.'/library/phpMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPDebug = 2; //Alternative to above constant
	$mail->isSMTP();
	$mail->SMTPDebug = 2; //Alternative to above constant
	$mail->Host = "mail.officebird.com";
	$mail->Port = 2525;
	$mail->SMTPAuth = true;
	$mail->Username = 'cs@officebird.com';
	$mail->Password = 'Test#123';
	$sender = ($sender) ? $sender : 'Eab';
	$mail->setFrom($fromEmail, $sender);
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	if(is_array($toEmail)){
		foreach($toEmail as $email) {
			$mail->addAddress($email);
		}
	} else {
		$mail->addAddress($toEmail);
	}
	if(is_array($ccEmail)) {
		foreach($ccEmail as $email) {
			$mail->addCC($email);
		}
	} else if($ccEmail){
		$mail->addCC($email);
	}
	if(is_array($bccEmail)) {
		foreach($bccEmail as $email) {
			$mail->addBCC($email);
		}
	} else if($bccEmail){
		$mail->addBCC($email);
	}
	if($mail->send()){
		return true;
	}
	return false;
}

function sendMail($fromEmail, $toEmail, $subject, $message, $bccEmail = '', $sender='', $ccEmail='',$attachment = '')
{
	//require_once('var/www/html/development.sam.ai/EAB/library/phpMailer/PHPMailerAutoload.php');
		require_once(SITE_PATH.'/library/phpMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		$mail->SMTPDebug = true;
		$mail->isMail();
	} else {
		$mail->isSMTP();
		$mail->SMTPDebug = 2; //Alternative to above constant
		$mail->Host = "mail.officebird.com";
		$mail->Port = 2525;
		$mail->SMTPAuth = true;
		$mail->Username = 'cs@officebird.com';
		$mail->Password = 'Test#123';
	}
	
	$sender = ($sender) ? $sender : NOTIFICATION_NAME;
	$mail->setFrom($fromEmail, $sender);
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	//$mail->Body = $message;
	if(is_array($toEmail)){
		foreach($toEmail as $email) {
			$mail->addAddress($email);
		}
	} else {
		$mail->addAddress($toEmail);
	}
	if(is_array($ccEmail)) {
		foreach($ccEmail as $email) {
			$mail->AddCC($email);
		}
	} else if($ccEmail){
		$mail->AddCC($ccEmail);
	}
	if(is_array($bccEmail)) {
		foreach($bccEmail as $email) {
			$mail->AddBCC($email);
		}
	} else if($bccEmail){
		$mail->AddBCC($bccEmail);
	}
	if(!empty($attachment)) {
	    $mail->AddAttachment($attachment);
	}
	if($mail->send()){
		return true;
	}
	return false;
}




function sendMail2($fromEmail, $toEmail, $subject, $message, $bccEmail = '', $sender='', $ccEmail='',$attachment = '')
{
	
	//echo ROOT_HTTP_PATH."sdfsdfds";exit();
	//require_once(ROOT_HTTP_PATH.'/library/phpMailer/PHPMailerAutoload.php');

	require_once(SITE_PATH.'/library/phpMailer/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	if($_SERVER['SERVER_NAME'] == 'localhost'){
		$mail->SMTPDebug = true;
		$mail->isMail();
	} else {
		$mail->isSMTP();
		$mail->SMTPDebug = 2; //Alternative to above constant
		$mail->Host = "mail.officebird.com";
		$mail->Port = 2525;
		$mail->SMTPAuth = true;
		$mail->Username = 'cs@officebird.com';
		$mail->Password = 'Test#123';
	}
	
	$sender = ($sender) ? $sender : NOTIFICATION_NAME;
	$mail->setFrom($fromEmail, $sender);
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	//$mail->Body = $message;
	if(is_array($toEmail)){
		foreach($toEmail as $email) {
			$mail->addAddress($email);
		}
	} else {
		$mail->addAddress($toEmail);
	}
	if(is_array($ccEmail)) {
		foreach($ccEmail as $email) {
			$mail->AddCC($email);
		}
	} else if($ccEmail){
		$mail->AddCC($ccEmail);
	}
	if(is_array($bccEmail)) {
		foreach($bccEmail as $email) {
			$mail->AddBCC($email);
		}
	} else if($bccEmail){
		$mail->AddBCC($bccEmail);
	}
	if(!empty($attachment)) {
	    $mail->AddAttachment($attachment);
	}
	if($mail->send()){
		return true;
	}
	return false;
}



function sendMailNew(){

  require_once(SITE_PATH.'/library/phpMailer/PHPMailerAutoload.php');
	//$mail = new PHPMailer();
	$mail = new PHPMailer(true);
 
//Send mail using gmail
if($send_using_gmail){
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "saravanaitech@gmail.com"; // GMAIL username
    $mail->Password = "Sargoms17588"; // GMAIL password
}
 
//Typical mail data

$email="saravna@sam.ai";
$name="saravna";
 $email_from='saravanaitech@gmail.com';
$name_from="saravna";
$mail->AddAddress($email, $name);
$mail->SetFrom($email_from, $name_from);
$mail->Subject = "My Subject";
$mail->Body = "Mail contents";
 
try{
    $mail->Send();

    echo "Success!"; exit();
} catch(Exception $e){
    //Something went bad
    echo "Fail :(".$e;
    exit();
}
}


/*function sendMail($fromEmail, $toEmail, $subject, $message, $fromName = '', $priority = 3)
{
	$hotmailDomainArr = array('hotmail', 'live', 'msn');
	$domain =preg_match('/[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}/', $toEmail, $domainMatches);
	$domainName = $domainMatches[1];
	$hotmailDomains  = implode('|', array_values($hotmailDomainArr));
	$isHotmail = (preg_match("/^[$hotmailDomains]/", $domainName) > 0);
	if($isHotmail){
		$mail = new Mail();
		$mail->hostname = 'relay.gothamweb.com';
		$mail->port = 25;
		$mail->timeout = 45;
		$mail->protocol = 'smtp';
		$mail->setTo($toEmail);
		$mail->setFrom($fromEmail);
		$mail->setSender("Band Jam It");
		$mail->setSubject($subject);
		$mail->setHtml($message);
		$mail->send();
	} else {
		authgMail($fromEmail, 'Band Jam It', $toEmail, 'Customer', $subject, $message);	
	}
}*/


//Function to send Email
/*function sendMail($fromEmail, $toEmail, $subject, $message, $fromName = '', $priority = 3)
{
	require_once(SITE_PATH.'/library/class.mail.php');
	$mailObj = new mail();				
	$mailObj->fromEmail($fromEmail, $fromName);
	$mailObj->toEmail($toEmail);
	$mailObj->subject($subject );
	$mailObj->bodyMessage( $message);
	$mailObj->setPriority($priority); 
	$mailObj->sendMail();
}*/

//File Upload Error
function fileUploadErrorMessage($error_code)
{
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'Photo upload failed';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
} 

//Function to make the upload file as safe file
function safeFile($fileName)
{
	//skip the special characters other than dot(.) and _
	$find = array('/[^a-z0-9\_\.]/i', '/[\_]+/');
	$repl = array('_', '_');
	$fileName = preg_replace ($find, $repl, $fileName);
	return (strtolower($fileName));
}
/* Get Total Records in a result set */
function getTotalRecords($result)
{
	if(is_array($result)){
		return isset($result[0]['totalRows']) ? $result[0]['totalRows'] : count($result);
	} else {
		return 0;
	}
}
/* Function to get file name return base name and extension as array */
function getFileInfo($fileName)
{
	$fileArray = explode('.', $fileName);
	$fileExt = array_pop($fileArray);
	$fileBaseName = implode('.', $fileArray);
	return array($fileBaseName, $fileExt);
}

/* Get JPG name of Given file */
function getJpgFileName($fileName)
{
	list($fileBaseName, $fileExt) = getFileInfo($fileName);
	return $fileBaseName.'.jpg';
}

/* Make a single dimension array from a two dimensional array for a given key */
function getSingleArray($resultArray, $dbKey, $asString = false, $seperator = ', ')
{
	$singleArr = array();
	if(!empty($resultArray)){
		foreach($resultArray as $key => $value){
			//Check for the single dimension array
			if(!is_array($value)){
				$singleArr[] = 	$resultArray[$dbKey];
				break;
			}
			if($value[$dbKey])
				$singleArr[] = $value[$dbKey];
		}
	} else {
		return false;
	}
	if($asString) {
		return implode($seperator, $singleArr);
	} else {
		return $singleArr;
	}
}
/* Convert array to json format */
function array2json($arr) {
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array();
    $is_list = false;

    //Find out if the given array is a numerical array
    $keys = array_keys($arr);
    $max_length = count($arr)-1;
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true;
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
            if($i != $keys[$i]) { //A key fails at position check.
                $is_list = false; //It is an associative array.
                break;
            }
        }
    }

    foreach($arr as $key=>$value) {
        if(is_array($value)) { //Custom handling for arrays
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
        } else {
            $str = '';
            if(!$is_list) $str = '"' . $key . '":';

            //Custom handling for multiple data types
            if(is_numeric($value)) $str .= $value; //Numbers
            elseif($value === false) $str .= 'false'; //The booleans
            elseif($value === true) $str .= 'true';
            else $str .= '"' . addslashes($value) . '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

            $parts[] = $str;
        }
    }
    $json = implode(',',$parts);
    
    if($is_list) return '[' . $json . ']';//Return numerical JSON
    return '{' . $json . '}';//Return associative JSON
}

function getTotalPages($totalRecords, $recPerPage)
{
	if($totalRecords == 0) return 0;
	$totalPages = ceil( $totalRecords / $recPerPage);
	if ($totalPages <= 1) return 1;	
	return $totalPages;
}

function getPagination($totalRecords, $currPage, $recPerPage, $urlValue = '')
{
	global $url;
	if(!$urlValue){
		$urlValue = $url;
	}
	$pagination = '';
	if($totalRecords == 0) return;
	$totalPages = ceil( $totalRecords / $recPerPage);
	if ($totalPages <= 1) return;	
	$pagination .= '<ul class="pagination">';
	for($pgCnt = 1; $pgCnt <= $totalPages; $pgCnt++){
		$pageUrl = addUrlParams($urlValue, array('page' => $pgCnt));
		if($pgCnt == $currPage){
			$pagination .= '<li class="current">';
			$pagination .= '<span><a href="'.$pageUrl.'">'.$pgCnt.'</a></span>';
		} else {
			$pagination .= '<li>';
			$pagination .= '<span><a href="'.$pageUrl.'">'.$pgCnt.'</a></span>';
		}
		$pagination .= '</li>';
	}
	$pagination .= '</ul>';
	return $pagination;
}

function addUrlParams($url, $params = array())
{
	$pageUrl = $url;
	if(empty($params))
		return $url;
	$pos = strpos($url, '?');
	$existingParams  = array();
	if ($pos !== false &&  $pos >= 0){
		//Get the existing parameters
		$urlArray = explode('?', $url);
		$oldParams = explode('&', $urlArray[1]);
		$pageUrl = $urlArray[0];
		foreach($oldParams as $key => $value)
		{
			list($urlParam, $urlValue) = explode('=', $value);
			//Check the parameter in given parameter list
			if(!array_key_exists($urlParam, $params)){
				$existingParams[$urlParam] = $urlValue;
			}
		}
	}
	$urlParams = array();
	
	if(!empty($existingParams))
		$params = array_merge($existingParams, $params);
	foreach($params as $key => $value)
	{
		array_push($urlParams, $key .'='.urlencode($value));
		//array_push($urlParams, $key .'='.$value);
	}
	$uri = implode('&amp;', $urlParams);
	$pageUrl .= '?'.$uri;
	return $pageUrl;
}

function getUserGenderImage($recordSet, $userImageWidth = 0)
{
	if(!is_array($recordSet)){
		return;
	}
	if(!$userImageWidth) $userImageWidth = GROUP_IMAGE_WIDTH;
	foreach($recordSet as $key => $value){
		//Check the array is single dimensional array
		if(!is_array($value)){
			if($recordSet['user_image']){
				$recordSet['user_image'] = ROOT_HTTP_PATH."/imageCreate.php?file=".$recordSet['user_image'].'&amp;w='.$userImageWidth;
			} else {
				$recordSet['user_image'] = TEMPLATE_HTTP_PATH.'/images/noimage_'.$recordSet['user_gender'].'_'.$userImageWidth.'.jpg';
			}
			break;
		}
		if($value['user_image']){
			$recordSet[$key]['user_image'] = ROOT_HTTP_PATH."/imageCreate.php?file=".$value['user_image'].'&amp;w='.$userImageWidth;
		} else {
			$recordSet[$key]['user_image'] = TEMPLATE_HTTP_PATH.'/images/noimage_'.$value['user_gender'].'_'.$userImageWidth.'.jpg';
		}
	}
	return $recordSet;
}

function generateDateArray($fromDate, $totalDays, $includeFromDate = true)
{
	$incStr = "+1 DAY";	
	$fromDateVal = is_numeric($fromDate) ? $fromDate : strtotime($fromDate);
	if($includeFromDate) {
		$dateArr[] = $fromDateVal;
		$dayCnt = 1;
	} else {
		$dayCnt = 0;
	}
	for(; $dayCnt < $totalDays; $dayCnt++) {
		$fromDateVal = strtotime($incStr, $fromDateVal);
		$dateArr[] = $fromDateVal;
	}
	return $dateArr;
}

function generatePreviousDateArray($fromDate, $totalDays, $includeFromDate = true)
{
	$incStr = "+1 DAY";	
	$fromDateVal = is_numeric($fromDate) ? $fromDate : strtotime($fromDate);
	$fromDateVal = ($includeFromDate) ? $fromDateVal : strtotime('-1 Day', $fromDateVal);
	$fromDateVal = strtotime("-{$totalDays} DAY", $fromDateVal);
	for($dayCnt = 0; $dayCnt < $totalDays; $dayCnt++) {
		$fromDateVal = strtotime($incStr, $fromDateVal);
		$dateArr[] = $fromDateVal;
	}
	return $dateArr;
}

/* Function get relative time of video comparing to current time */
function getRelativeTime($date)
{
	$givenTime = strtotime($date);
	$delta =  (int)(time() - $givenTime);
	$minute = (int) ($delta / 60);
	$hour = (int) ($minute / 60);
	$day = (int) ($hour / 24);
	$month = (int) date('n') - (int) date('n', $givenTime);
	$year = (int) date('Y') - (int) date('Y', $givenTime);
	if($year > 1) {
		$returnStr = $year . ' Years';
	} else if($month > 1){
		$returnStr = $month . ' Months';
	} else if($day) {
		$returnStr = $day . ' '.(($day > 1) ? 'Days' : 'Day');
	} elseif ($hour) {
		$returnStr = $hour . ' '.(($hour > 1) ? 'Hours' : 'Hour');
	} elseif ($minute) {
		if($minute > 30) {
			$returnStr = 'Half an hour';
		} else {
			$returnStr = $minute . ' '.(($minute > 1) ? 'Minutes' : 'Minute');
		}
	} else {
		$returnStr = $delta . ' '.(($delta > 1) ? 'Seconds' : 'Second');
	}
	$returnStr .= ' Ago';
	return $returnStr;
}


/* Function to delete the caches files*/
	function scanD() {
	$cache = CACHE_PATH.'/category/';
		$files = scandir($cache);
		if(is_array($files)) {
			if(count($files)>2) {
				array_shift($files);
				array_shift($files);
				return $scanDir = $files;
			} else {
				return; 
			} 
		} else {
			return; 
		}
	}
	function delD($pattern) {
	$scanD = scanD();
	$cache = CACHE_PATH.'/category/';
		if(count($scanD)>2) {
			foreach($scanD as $k=>$v) {
				if(preg_match($pattern, $v, $matches))
					unlink($cache.$v);
			}
			return true;
		} else {
			return;
		}
}


// --------------------------------------------------------------------------------
/**
 * Crop function with copy image
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop_copy($w, $h, $uploadfile, $res_img, $crop = 1)
{
	
	
    $size = getimagesize($uploadfile);
    if ($size)
    {
        $width  = $size[0];
        $height = $size[1];

        $imgObjName  =  'Image_Transform_Driver_GD';
        $img         = new $imgObjName();

        if ($width > $w || $height > $h)
        {
            $wx = $w;
            $hx = $h;

            $img -> load($uploadfile);

            if (1 == $crop)
            {
                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // ?rop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }
               
                $img -> save($res_img);
                $img -> load($res_img);
            }
            else
            {
                $coeff = $height / $width;

                if ($coeff*$wx > $hx)
                   $wx = $width*$hx / $height;
                else
                   $hx = $height*$wx / $width;
            }

            if ($img -> resize($wx, $hx))
            {
                $img -> save($res_img,'jpeg');
                return true;
            }
            else
            {
                return false;
            }    
        }
        else
		{
            copy($uploadfile, $res_img); 
		}	
    }
    else
    {
        return false;
    }  
}#i_crop_copy

function safeSlug($fileName)
{
	$find = array('/[^a-z0-9\_]/i', '/[\_]+/');
	$repl = array('-', '-');
	$fileName = preg_replace ($find, $repl, $fileName);
	$fileName = trim($fileName, '-');	
	return (strtolower($fileName));
}




function ToLower($str)
{
	return mb_strtolower($str, 'utf8');
}/** ToLower */


//debug
function deb($var)
	{
		echo "<pre>";
		print_r($var);
		die;
	}
function phpcurl($post = array(), $url, $token = '', $method = "POST", $json = false, $ssl = true){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url);    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    if($method == 'POST'){
        curl_setopt($ch, CURLOPT_POST, 1);
    }
    if($json == true){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json','Authorization: Bearer '.$token,'Content-Length: ' . strlen($post)));
    }else{
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    if($ssl == false){
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    // curl_setopt($ch, CURLOPT_HEADER, 0);     
    $r = curl_exec($ch);    
    if (curl_error($ch)) {
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        print_r('Error: ' . $err . ' Status: ' . $statusCode);
        // Add error
        $this->error = $err;
    }
    curl_close($ch);
    return $r;
}


?>