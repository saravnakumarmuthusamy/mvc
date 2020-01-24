<?php
class user extends table
{
	public $params;
	function __construct($db, $params = array())
	{
		parent::__construct($db, 'user');
		$this->params = $params;
	}
	function checkUserEmailExists($userEmail)
	{
		$qry = 'SELECT user_id, user_first_name, user_last_name, user_email, is_deleted FROM user WHERE LOWER(user_email) = "%s"';
		$qry = $this->db->prepareQuery($qry, strtolower($userEmail));
		$rslt = $this->db->getSingleRow($qry);
		if($rslt) {
			return $rslt;
		} else {
			return false;
		}
	}
	function checkFBUserExists($fb_id)
	{
		$qry = 'SELECT user_id, user_first_name, user_last_name, user_email, is_deleted FROM user WHERE LOWER(user_social_id) = "%s"';
		$qry = $this->db->prepareQuery($qry, strtolower($fb_id));

		$rslt = $this->db->getSingleRow($qry);
		if($rslt) {
			return $rslt;
		} else {
			return false;
		}
	}

	function checkUserNemeExists($userName,$userId=0){
		$qry ='SELECT user_id, user_name FROM user WHERE LOWER(user_name)= "%s"';
	    $qry = $this->db->prepareQuery($qry, strtolower($userName));
		$rslt = $this->db->getSingleRow($qry);
		if($rslt){
			if($userId && $rslt['user_id'] == $userId) 
				return false;
			return true;
		}
		return false;
	}
	
	function addUser($params=array())
	{


		clearErrorMessage();
		$error = false;
		$params = ($params) ? $params : $this->params;
		
			/*$rslt['user_name'] = safeSlug($params['userFullName']);*/
			$rslt['user_first_name'] = $params['user_first_name'];
			$rslt['user_middle_name'] = $params['user_middle_name'];
			$rslt['user_last_name'] = $params['user_last_name'];
			$rslt['user_email'] = $params['user_email'];
			$rslt['user_password'] = md5($params['user_password']);
			$rslt['user_phone'] = $params['user_phone'];
			$rslt['user_company'] = $params['company'];
			$rslt['user_job_title'] = $params['user_job_title'];
			$rslt['user_role'] = $params['user_role'];
			$rslt['user_login_type'] = $params['user_login_type'];
			

			/*$rslt['user_gender'] = $params['userGender'];
			$rslt['user_zip'] = $params['userZip'];
			$rslt['user_about_me'] = $params['userAboutMe'];
			$rslt['user_country'] = $params['userCountry'];
			$rslt['userSlug'] = safeSlug($params['userFullName']);
			if($params['userCountry'] == 'US'){ 
				$rslt['user_state'] = $params['userStateLst'];
			}else{
			    $rslt['user_state'] = $params['userStateTxt'];
			}*/
			$rslt['created_on'] = DB_DATE;
			$rslt['modified_on'] = DB_DATE;
			$rslt['is_deleted'] = 2;
			$authorization = getObject('authorization');
			$randId = $authorization->generateRandStr(16);
			$rslt['user_key']= $randId;
			//Insert the record into table
			//print_r($rslt);exit();
			$userId = $this->insertRecord($rslt);


			/*global $emailTemplateArray;
		
			$subject = "Test";
			$message ="Test";
			$to="saravana@sam.ai";
			$re=sendMail(NOTIFICATION_EMAIL, $to, $subject, $message);
			print_r($re);exit();
			*/
		/*	$from="saravana@sam.ai";
			$namefrom="saravana";
			$to="saravana@sam.ai";
			$nameto="saravana@sam.ai";
			$subject="test";
			$message="test";

			authgMail($from, $namefrom, $to, $nameto, $subject, $message) ;

			exit();*/

			//$url = 'https://love.sam.ai/beta/addLeadForEAB.php';
			$url = 'https://love.sam.ai/addLeadForEAB.php';
			$postArr =  array('firstName'=>$rslt['user_first_name'],
							  'lastName'=>$rslt['user_last_name'],
							  'email'=>$rslt['user_email'],
							  'company'=>$rslt['user_company'],
							  'jobTitle'=>$rslt['user_job_title'],
							  'phone'=>$rslt['user_phone'],
							  'user_type'=>$rslt['user_type']);
			phpcurl($postArr,$url);
			return $userId;
		
	}
	

	function addFBUser($params=array())
	{
		clearErrorMessage();
		$error = false;
		$params = ($params) ? $params : $this->params;
		
			/*$rslt['user_name'] = safeSlug($params['userFullName']);*/
			$rslt['user_first_name'] = $params['firstName'];
			$rslt['user_last_name'] = $params['lastName'];
			$rslt['user_email'] = $params['email'];
			/*$rslt['user_password'] = md5($params['password']);*/
			$rslt['user_phone'] = $params['phone'];
			$rslt['user_middle_name'] = $params['middleName'];
			$rslt['user_company'] = $params['company'];
			$rslt['user_job_title'] = $params['title'];
			$rslt['user_type'] = $params['user_type'];
			$rslt['user_login_type'] = $params['user_login_type'];
			if($params['registerLINUser']==1){
				$rslt['user_social_id'] = $params['user_info']['linkedinId'];
				$rslt['user_social_name'] = $params['user_info']['firstName'].' '.$params['user_info']['lastName'];
				
			}else if($params['registerFBUser']==1){
				$rslt['user_social_id'] = $params['fb_id'];
				$rslt['user_social_name'] = $params['fb_name'];
				
			}
			

			/*$rslt['user_gender'] = $params['userGender'];
			$rslt['user_zip'] = $params['userZip'];
			$rslt['user_about_me'] = $params['userAboutMe'];
			$rslt['user_country'] = $params['userCountry'];
			$rslt['userSlug'] = safeSlug($params['userFullName']);
			if($params['userCountry'] == 'US'){ 
				$rslt['user_state'] = $params['userStateLst'];
			}else{
			    $rslt['user_state'] = $params['userStateTxt'];
			}*/
			$rslt['created_on'] = DB_DATE;
			$rslt['modified_on'] = DB_DATE;
			$rslt['is_deleted'] = 2;
			$authorization = getObject('authorization');
			$randId = $authorization->generateRandStr(16);
			$rslt['user_key']= $randId;
			//Insert the record into table
	//print_r($rslt);exit();
			$userId = $this->insertRecord($rslt);

			//$url = 'https://love.sam.ai/beta/addLeadForEAB.php';
			$url = 'https://love.sam.ai/addLeadForEAB.php';
			$postArr =  array('firstName'=>$rslt['user_first_name'],
							  'lastName'=>$rslt['user_last_name'],
							  'email'=>$rslt['user_email'],
							  'company'=>$rslt['user_company'],
							  'jobTitle'=>$rslt['user_job_title'],
							  'phone'=>$rslt['user_phone'],
							  'user_type'=>$rslt['user_type']);
			phpcurl($postArr,$url);
			
			return $userId;
		
	}


	// activate user
	function activateUser($userId, $key)
	{
		$qry = 'SELECT user_id, user_key FROM user WHERE user_id = %d';
		$qry = $this->db->prepareQuery($qry, $userId);
		$rslt = $this->db->getSingleRow($qry);
		if(!$rslt){
			return false;
		}
		if($key == md5($rslt['user_key'])){
			$record['user_id'] = $userId;
			$record['is_deleted'] = 0;
			$record['modified_on'] = DB_DATE;
			$this->updateRecord($record, 'user_id');
			return true;
		}
		return false;
	}
	
	// update user info
	function updateUserInfo($userId)
	{
		$params = $this->params;
		$error = false;
		if($params['userFullName']){
			if($this->checkUserNemeExists($params['userFullName'], $userId)){
				setErrorMessage('userFullName', '');
				$error = true;
			}
		}
		if(!$error){
				
				$rslt['user_id'] = $userId;
				//$rslt['user_name'] = safeSlug($params['userFullName']);
				$rslt['user_first_name'] = $params['userFirstName'];
				$rslt['user_last_name'] = $params['userLastName'];
				$rslt['user_gender'] = $params['userGender'];
				$rslt['user_country'] = $params['userCountry'];
				if($params['userCountry'] == 'US'){ 
						$rslt['user_state'] = $params['userStateLst'];
				}else{
			   			$rslt['user_state'] = $params['userStateTxt'];
				}
				$rslt['user_about_me'] = $params['userAboutMe'];
				$rslt['user_zip'] = $params['userZip'];
				//$rslt['userSlug'] = safeSlug($params['userFullName']);
		
				list($month, $day, $year) = explode('/', $params['userDOB']);
				$dobDate = mktime(0, 0, 0, $month, $day, $year);
				$rslt['user_dob'] = date('Y-m-d', $dobDate);
				$rslt['modified_on'] = DB_DATE;
				//Insert the record into table
				$recUpdate = $this->updateRecord($rslt, 'user_id');
				/* Update the user play list */
				$userPlay = getObject('userPlay');
				$params['userId'] = $userId;
				$userPlay->addUserPlayList($params);
				/* Upload the image */
				/*$imgUpload = $this->uploadUserImage($userId);*/
				return $userId;
		}
		return false;
	}
	function getUserInfoByUserId($userId){
		$qry = "SELECT * FROM user WHERE user_id = %d";
		$qry = $this->db->prepareQuery($qry, $userId);
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}
	function checkLogin($email,$password){
		$qry = "SELECT * FROM user WHERE user_email = '%s' AND user_password='%s'";
		$qry = $this->db->prepareQuery($qry, $email,md5($password));
		//echo $qry;exit();
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}
	/* Get the user with given facebook Id*/
	function getUserWithFaceboookId($facebookId)
	{
		$qry = 'SELECT user_id FROM '. $this->table . ' WHERE user_fb_id = %s';
		$qry = $this->db->prepareQuery($qry, $facebookId);
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}
	
	/* Add a user from facebook login */
	function addFacebookUser($userInfo)
	{
		$newUser = false;
		$userName = $userInfo['username'] ? $userInfo['username'] : $userInfo['first_name'];
		$record['modified_on'] = DB_DATE;
		$record['user_country'] = $userInfo['country'];
		$record['user_state'] =  $userInfo['state'];
		$record['user_zip'] = $userInfo['zip'];
		
		if($userInfo['birthday']){
			list($month, $date, $year) = explode('/', $userInfo['birthday']);
			$record['user_dob'] = $year .'-'.$month.'-'.$date;
		}
		if($userData = $this->checkUserEmailExists($userInfo['email']))
		{
			$record['user_fb_id'] = $userInfo['id'];
			$record['user_fb_name'] = $userName;
			$record['user_id'] = $userData['user_id'];
			$record['user_fb_location'] = $userInfo['location']['name'];
			if($userData['is_deleted'] == 2 || $userData['is_deleted'] == 1)
			{
				$record['is_deleted'] = 0;
			}
			$update = $this->updateRecord($record, 'user_id');
			return array('userId' => $record['user_id'], 'isNewUser'=>$newUser);
		}
		
		//Check for user id exist in the table already
		$returnUser = $this->getUserWithFaceboookId($userInfo['id']);
		$record['user_fb_name'] = safeSlug($userName);
		$record['user_first_name'] = $userInfo['first_name'];
		$record['user_last_name'] = $userInfo['last_name'];
		$record['user_name'] = safeSlug($userName);
		$record['userSlug'] = safeSlug($userName);
		$record['user_fb_id'] = $userInfo['id'];
		$record['user_email'] = $userInfo['email'];
		$record['user_gender'] = substr($userInfo['gender'], 0, 1);
		$record['user_fb_location'] = $userInfo['location']['name'];
		if($returnUser) {
			$userId = $returnUser['user_id'];
			$record['user_id'] = $userId;
			$update = $this->updateRecord($record, 'user_id');
		} else {
			
			$record['created_on'] = DB_DATE;
			$insertId = $this->insertRecord($record);
			$userId = $insertId;
			$newUser = true;
		}
		return array('userId' => $userId, 'isNewUser'=>$newUser);
	}

	// Get userinfo function 
	function getUserInfo($userId)
	{
		$qry = "SELECT *  FROM user 
				WHERE user_id='{$userId}'";
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}
	
	// Get userinfo function 
	function getUserBasicInfo($userId)
	{
		$qry = "SELECT user_id, user_first_name, user_last_name, user_gender, user_about_me, user_image, user_email, user_state, state_name, user_name, country_name, userSlug FROM user 
		INNER JOIN country ON country.country_code = user.user_country
		LEFT JOIN state ON state.state_code = user.user_state
		WHERE user_id='{$userId}' and is_deleted = 0";
		$rslt = $this->db->getSingleRow($qry);
		if($rslt){
			$userPlay = getObject('userPlay');
			$playText = $userPlay->getUserPlayListAsText($rslt['user_id']);
			$rslt['play_list'] = $playText['playItems'];
		}
		return $rslt;
	}
	
	/* function to delete user profile */
	function updateIsDelete($userId)
	{
		$qry = "UPDATE user SET is_deleted='1' WHERE user_id= %d";
		$qry = $this->db->prepareQuery($qry, $userId);
		$rslt = $this->db->query($qry);
		return $rslt;	
	}
	
	/* function to delete user profile by Admin*/
	function deleteUserByAdmin($userId)
	{
		$qry = "UPDATE user SET is_deleted='3' WHERE user_id= %d";
		$qry = $this->db->prepareQuery($qry, $userId);
		$rslt = $this->db->query($qry);
		if($rslt){
			 $qry = "SELECT user_email, user_first_name, user_last_name FROM user WHERE user_id={$userId}";
			 $qry = $this->db->prepareQuery($qry, $userId);
			 $reslt = $this->db->getSingleRow($qry);
			 /*send email*/
			 global $emailTemplateArray;
	 		 $mailInfo['firstName'] = $reslt['user_first_name'];
			 $mailInfo['lastName'] = $reslt['user_last_name'];
			 $email = $reslt['user_email'];
			 $emlTemplateObj = getObject('emailTemplate');
			 $deleteUserTemplate = $emlTemplateObj->getEmailTemplateDetail('deleteUser');
			 $mailSubject = $deleteUserTemplate['tmpl_subject'];
			 $mailMessage = $deleteUserTemplate['tmpl_message'];
			 $subject = replaceContent($mailInfo, $mailSubject);
			 $message = replaceContent($mailInfo, $mailMessage);
			 sendMail(NOTIFICATION_EMAIL, $email, $subject, $message); 
			 return $reslt;
		}	
	}
	
	/* Update the profile image */
	function udpateUserImage($userId, $userImage)
	{		
		$qry = "SELECT user_image FROM user WHERE user_id='{$userId}'";
		$rslt = $this->db->getSingleRow($qry);
		//Update the new Image
		$record['user_image'] = $userImage;
		$record['user_id'] = $userId;
		$record['modified_on'] = DB_DATE;
		$updateRecord = $this->updateRecord($record, 'user_id');
		return $updateRecord;
	}
	
	/*Function to update the password*/
	function updatePassword($userId, $userPassword)
	{
		$qry = "UPDATE user SET user_password = '%s' WHERE user_id= %d";
		$qry = $this->db->prepareQuery($qry, md5($userPassword), $userId);
		$rslt = $this->db->query($qry);
		return $rslt;
	}
	
	/* Function to check given password is valid for given user */
	function checkPassword($userId, $userPassword)
	{
		$qry = "SELECT user_id FROM user WHERE user_password = '%s' AND user_id= %d";
		$qry = $this->db->prepareQuery($qry, md5($userPassword), $userId);
		$rslt = $this->db->getSingleRow($qry);
		if($rslt) {
			return true;
		} else {
			return false;
		}
	}
	
	//Get the user id by given email address.
	function getUserByEmailId($emailId)
	{
		$qry = "SELECT user_id FROM user WHERE LOWER(user_email)='%s' AND is_deleted=0";
		$emailId = trim(strtolower($emailId));
		$qry = $this->db->prepareQuery($qry, $emailId);
		$rslt = $this->db->getSingleRow($qry);
		if($rslt){
			return $rslt['user_id'];
		} else {
			return false;
		}
	}
	
	/* Delete the user account by user */
	function deleteUserAccount($userId = 0)
	{
		if(!$userId) $userId = $_SESSION['userId'];
		if(!$userId){
			return false;
		}
		$record['user_id'] = $userId;
		$record['modified_on'] = DB_DATE;
		$record['is_deleted'] = 1;
		$updateRecord = $this->updateRecord($record, 'user_id');
		
		return true;
	}
		
	/* function to get list if users*/
	function getUserLists($start=0, $limit=0, $randOrder=0, $showImages=0)
	{
			$qry = 'SELECT * FROM user WHERE is_deleted = 0 ';
			if($showImages){
				$qry .=" AND user_image!=''";
			}
			if($randOrder) {
				$qry .= " ORDER BY RAND()";
			} else {
				$qry .= " ORDER BY user_id ASC";
			}
			if($limit){
				$qry .= " LIMIT $start, $limit";
			}
			$rslt =$this->db->getResultSet($qry);
			if($rslt && $limit){
				$rslt[0]['totalRows'] = $this->db->getTotalRows($qry);
			}		

			return $rslt;
	}
	
	/* function to get list if users*/
	function getHomeUserList($start=0, $limit=0, $randOrder=0, $showImages=0)
	{
			$qry = 'SELECT user_id,user_first_name,user_last_name,user_name,user_image,userSlug, IF(session_login_status, user_chat_status, 0) AS online FROM user 
					LEFT JOIN user_session ON user_id = session_user_id AND session_login_status = '.STATUS_LOGGED_IN.'
					WHERE user.is_deleted = 0';
				
			if($showImages){
				$qry .=" AND user_image!=''";
			}
			if($randOrder) {
				$qry .= " ORDER BY RAND()";
			} 
			if($limit){
				$qry .= " LIMIT $start, $limit";
			}
			$rslt =$this->db->getResultSet($qry);
			if($rslt && $limit){
				$rslt[0]['totalRows'] = $this->db->getTotalRows($qry);
			}		

			return $rslt;
	}

	/*Function to change user Chat status*/
	function changeUserChatStatus($newStatus)
	{
		//Update the status
		$qry = 'UPDATE user SET user_chat_status = %d WHERE user_id = %d';
		$qry = $this->db->prepareQuery($qry, $newStatus, $this->params['userId']);
		$this->db->query($qry);
		//Return the status
		$qry = 'SELECT user_chat_status FROM user WHERE user_id = %d';
		$qry = $this->db->prepareQuery($qry, $this->params['userId']);
		$result = $this->db->getSingleRow($qry);
		return $result['user_chat_status'];
	}
	
	/*function to change user search by email and username*/
	function searchUserByNameOrEmail($params=array(),$start=0, $limit=0)
	{
		$params = $params ? $params : $this->params;
		$loginUserId = $params['userId'] ? $params['userId'] : 0;
		
		$where = array();
		if($loginUserId) {
			$inviteJoin = " LEFT JOIN (SELECT 1 as invite_sent, inv_inviter,  inv_invitee FROM invitation WHERE is_deleted = 0 AND 
						   (inv_invitee = {$loginUserId} OR inv_inviter = {$loginUserId}) AND inv_status != 2) AS invitation 
						   ON ((user_id=inv_inviter OR user_id = inv_invitee) AND user_id != {$loginUserId})";
			$inviteSent = 'IFNULL(invite_sent, 0) as invite_sent,';
		}
					   
		$qry = 'SELECT DISTINCT user_id, user_state, user_email, user_first_name, user_last_name, user_name, user_about_me, userSlug, user_image,'.$inviteSent.'				
				user_gender, user_country, country_name, state_name FROM user '. $inviteJoin .'
				LEFT JOIN country ON country.country_code = user_country
				LEFT JOIN state ON state.state_code = user_state WHERE user.is_deleted = 0';
		
		if($params['srchUserEmail']){
			$userEmail = "  user_email LIKE '%%%s%%'";
			$userEmail = $this->db->prepareQuery($userEmail, $params['srchUserEmail']);
		}
		
		if($params['srchUserName'])
		{
			$whereUser = " AND (user_name LIKE '%%%s%%' ";
			if($userEmail){
				$whereUser .= "OR {$userEmail}";
			}
			$whereUser .= ')';
		}
		if($whereUser){
			$qry .= $whereUser;
			$args = preg_match_all('/%s/', $qry, $matches);
			if($args > 0){
				$argsArray = array_fill(1, $args, $params['srchUserName']);
			}
			$qry = $this->db->prepareQuery($qry, $argsArray);
		} elseif($userEmail) {
			$qry .= ' AND '. $userEmail;
		}
		
		$qry .= ' ORDER BY user_name ASC ';
		
		if($limit){
			$qry .= " LIMIT $start, $limit";
		}
		$rslt = $this->db->getResultSet($qry);
		if($rslt){
			if($limit)
				$rslt[0]['totalRows'] = $this->db->getTotalRows($qry);
			$userPlay = getObject('userPlay');
			foreach($rslt as $key => $value)
			{
				$playText = $userPlay->getUserPlayListAsText($value['user_id']);
				$rslt[$key]['play_list'] = $playText['playItems'];
			}
		}
		return $rslt;
	}
	
	/* Function to search with given details */
	function searchUserDetail($params=array(), $start=0, $limit=0)
	{
		$params = $params ? $params : $this->params;
		//$params = array_map(array($this->db, 'sqlSafe'),$params);
		array_walk_recursive($params, array($this->db, 'sqlSafe'));
		$where = array();
		$join = '';
		$firstName = $params['userFirstNameSrch'];
		$loginUserId = $params['userId'] ? $params['userId'] : 0;
		if(trim($params['userSearch'])) {
			$keywords = preg_split('/[\s,]+/', $params['userSearch']);
			$keywordSrch = array();
			foreach($keywords as $key)
			{
				$whereUser = "(user_name LIKE '%%%s%%' OR user_first_name LIKE '%%%s%%' OR user_last_name LIKE '%%%s%%' OR user_email LIKE '%%%s%%')";
				 $args = preg_match_all('/%s/', $whereUser, $matches);
				 if($args > 0)
				 {
					$argsArray = array_fill(1, $args, trim($key));
				}
				$cond = $this->db->prepareQuery($whereUser, $argsArray);
				$keywordSrch[] = $cond;
			}
			$where[] = implode (' OR ', $keywordSrch);
		}
		
		if($firstName)
		{
			$where[] = "(user_first_name LIKE '{$firstName}%')";
		}
			$lastName = $params['userLastNameSrch'];
		if($lastName){
			$where[] = "(user_last_name LIKE '{$lastName}%')";
		}
		$userName = $params['srchUserName'];
		if($userName){
			$where[] = "(user_name LIKE '%{$userName}%')";
		}
		$userEmail = $params['srchUserEmail'];
		if($userEmail){
			$where[] = "(user_email LIKE '%{$userEmail}%')";
		}
		$gender = $params['userGenderSrch'];
		if($gender) {
			if(is_array($gender)) $gender = implode("','", $gender);
			$where[] = "user_gender IN ('{$gender}')";
		}
		$minAge = (int) $params['minAgeSrch'];
		$maxAge = (int) $params['maxAgeSrch'];
		if($minAge && $maxAge){
			$where[] = "(YEAR('".DB_DATE_ONLY."') - YEAR (user_dob) BETWEEN {$minAge} AND {$maxAge})";
		} elseif($minAge) {
			$where[] = "(YEAR('".DB_DATE_ONLY."') - YEAR (user_dob) >= {$minAge})";
		} elseif($maxAge) {
			$where[] = "(YEAR('".DB_DATE_ONLY."') - YEAR (user_dob) <= {$maxAge})";
		}
		$country = $params['userCountry'];
		if($country){
			$where[] ="(user_country = '{$country}')";
			$state = ($country == 'US') ? $params['userStateLst'] : $params['userStateTxt'];
			if($state){
				$where[] = "(user_state = '{$state}')";
			}
		}
		
		$zip = $params['userZipSrch'];
		if($zip){
			$where[] = "user_zip LIKE '%%{$zip}%%'";
		}		
		$playListArr = $params['playListSrch'] ? $params['playListSrch'] : $params['catList'];
		if($playListArr){
			 $playList = implode(',', $playListArr);
			 $playJoin = "INNER JOIN (SELECT DISTINCT play_user_id FROM user_play WHERE play_cat_id IN ($playList)) 
					as play_cat ON play_user_id = user_id";
		}
		
		$videoType = $params['cateType'];
		if($videoType){
			$vidJoin = "INNER JOIN (SELECT DISTINCT vid_user_id FROM video WHERE vid_type IN ($videoType))
			 		as vid_user ON vid_user_id = user_id";
		}

		//Check Invitation send status
		if($loginUserId) {
			$inviteJoin = " LEFT JOIN (SELECT 1 as invite_sent, inv_inviter,  inv_invitee FROM invitation WHERE is_deleted = 0 AND 
						   (inv_invitee = {$loginUserId} OR inv_inviter = {$loginUserId}) AND inv_status != 2) AS invitation 
						   ON ((user_id=inv_inviter OR user_id = inv_invitee) AND user_id != {$loginUserId})";
			$inviteSent = 'IFNULL(invite_sent, 0) as invite_sent,';
		}
		$qry = 'SELECT DISTINCT user_id, user_first_name, user_last_name, user_name, user_about_me, userSlug, user_email, user_state, user_image, user_gender, 
				user_country, country_name, state_name, user_zip, YEAR("'.DB_DATE_ONLY.'") - YEAR (user_dob) AS user_age, '.$inviteSent.' user_dob
				FROM user '. $playJoin .$inviteJoin .$vidJoin.'
				LEFT JOIN country ON country.country_code = user_country 
				LEFT JOIN state ON state.state_code = user_state WHERE user.is_deleted = 0';
		
		if($where)
		{
			$whereCond = implode (' AND ', $where);
			$qry .= ' AND ('.$whereCond .')';
		}
		//echo $qry;
		//exit;
		if($limit){
			$qry .= " LIMIT $start, $limit";
		}
		//echo $qry;
		$rslt = $this->db->getResultSet($qry);
		if($rslt)
		{
			if($limit)
				$rslt[0]['totalRows'] = $this->db->getTotalRows($qry);
			$userPlay = getObject('userPlay');
			foreach($rslt as $key => $value)
			{
				$playText = $userPlay->getUserPlayListAsText($value['user_id']);
				$rslt[$key]['play_list'] = $playText['playItems'];
			}
		}
		
		return $rslt;
	}
	
	/* Function upload user file */
	function uploadUserImage($userId = 0)
	{
		$error = false;
		$uploaddir = USER_IMAGE_PATH.'/';
		if ($_FILES['userImage']["error"] > 0) {
			//setErrorMessage('userImage', fileUploadErrorMessage($_FILES['userImage']["error"]));
			$error = true;
		}
		if(isset($_FILES['userImage']) && $_FILES['userImage']['tmp_name']) {
			$file_size = @filesize($_FILES['userImage']["tmp_name"]);
			$filename = time().'_'.safeFile(basename($_FILES['userImage']['name']));
			$file = $uploaddir . $filename;
			//Get the image size
			list($imgWidth, $imgHeight) = getimagesize($_FILES['userImage']['tmp_name']);
			if (!$error && ($imgWidth == 0 || $imgHeight == 0)) {
				//setErrorMessage('userImage', 'Invalid Image');
				$error = true;
			}
			if (!$error && move_uploaded_file($_FILES['userImage']['tmp_name'], $file)) {
			    //return success status, image http path and new file name<br />
				$userId = ($userId) ? $userId : $_SESSION['userId'];
				$uploadImg = $this->udpateUserImage($userId, $filename);
				$userPhoto = getObject('userPhoto');
				$rslt = $userPhoto->insertRegisterData($userId, $filename, $this->params['userFullName']);
			} else {
				//setErrorMessage('userImage', 'No Permission to upload the image');
				//$error = true;
			}
		}
		 return (!$error);
	}
	
	// function for age calculation
	function ageCalculation($start=0, $limit=0)
	{
		 $qry = 'SELECT (YEAR( CURDATE()) - YEAR(user_dob)) AS age FROM user WHERE is_deleted = 0 ORDER BY user_id ASC';
	     if($limit){
				$qry .= " LIMIT $start, $limit";
			}
			$rslt =$this->db->getResultSet($qry);
			if($rslt && $limit){
				$rslt[0]['totalRows'] = $this->db->getTotalRows($qry);
			}
			return $rslt;	
	}
	
	// userKey
	function userKeyUpdate($userId)
	{
		$authorization = getObject('authorization');
		$randId = $authorization->generateRandStr(16);
		$rslt = $randId;
			if($rslt)
			{
				$record['user_key'] = $rslt;
				$record['user_id'] = $userId;
				$updateRecord = $this->updateRecord($record, 'user_id');
			}
		return $rslt;	
	}
	
	function getUserNameByKewords($request)
	{
		 $qry = "SELECT user_id as id, user_name as value, user_image as image
		  FROM user WHERE user_first_name LIKE '%%%s%%' OR user_last_name LIKE  '%%%s%%' OR user_name LIKE '%%%s%%' order by user_first_name ASC LIMIT 10";
		 $qry = $this->db->prepareQuery($qry, $request,$request,$request );  
		 $rslt =$this->db->getResultSet($qry);
		 return $rslt;			
	}
	
	function getUserName()
	{
		 $qry = "SELECT user_id, user_name AS UserName FROM user";
		 $rslt =$this->db->getResultSet($qry);
		 return $rslt;	
	}
	
	function userNameUpdate($userId, $userName)
	{
		$record['userSlug'] = $userName;
		$record['user_id'] = $userId;
		$updateRecord = $this->updateRecord($record, 'user_id');
	}
	
	/* Get User slug url for given user array */
	function getUserSlugArray($userArr)
	{
		if(!is_array($userArr)) {
			return $userArr;
		}
		foreach($userArr as $key => $value){
			if(!is_array($value)){
				if(trim($userArr['user_name'])) {
					$userArr['userSlug'] = 	ROOT_HTTP_PATH.'/'.strtolower($userArr['user_name']);
				} else {
					$userArr['userSlug'] = 	ROOT_HTTP_PATH.'/'.$userArr['user_id'];
				}
				break;
			}
			if(trim($value['user_name'])) {
				$userArr[$key]['userSlug'] = ROOT_HTTP_PATH.'/'.strtolower($value['user_name']);
			} else {
				$userArr[$key]['userSlug'] = ROOT_HTTP_PATH.'/'.$value['user_id'];
			}
		}
		return $userArr;
	}
	
	/* Get User Information from slug */
	function getUserInfoBySlug($userSlug)
	{

		$userSlug = strtolower($userSlug);
		$cond = 'LOWER(userSlug) = "%s"';

		$qry ='SELECT user_id, user_name, CONCAT(user_first_name, " ",IFNULL(user_last_name,"")) AS user_full_name FROM user WHERE '.$cond.' AND is_deleted=0';
	    $qry = $this->db->prepareQuery($qry, $userSlug);
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}
	
	
	/* Get Url for the user */
	function getUrlForUser($userId=0)
	{	
		if(!$userId) $userId = $_SESSION['userId'];
		if(!$userId) return;
		$qry ='SELECT user_id, user_name FROM user WHERE user_id=%d AND is_deleted=0';
	    $qry = $this->db->prepareQuery($qry, $userId);
		$rslt = $this->db->getSingleRow($qry);
		if($rslt) {
			$rslt = $this->getUserSlugArray($rslt);
		}
		return $rslt;
	}

	function getUserList(){
		$params = $this->params;
		$qry = "call getUserList();";
		$qry = $this->db->prepareQuery($qry);	
		$rslt = $this->db->getResultSet($qry);
		return $rslt;
	}

	function deleteUser($user_id,$is_deleted){
		$qry = "call actionDeleteUser(%d,%d);";
		$qry = $this->db->prepareQuery($qry,$user_id,$is_deleted);	
		$rslt = $this->db->getSingleRow($qry);
		return $rslt;
	}

	function getUserRole(){
		$params = $this->params;
		$qry = "call getUserRole();";
		$qry = $this->db->prepareQuery($qry);	
		$rslt = $this->db->getResultSet($qry);
		return $rslt;
	}


}
?>