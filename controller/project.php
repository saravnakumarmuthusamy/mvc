<?php
class project extends table
{
	public $params;
	function __construct($db, $params = array()){
		parent::__construct($db, 'project');
		$this->params = $params;
		 
	}


	function addProject($params=array())
	{
		
			clearErrorMessage();
			$error = false;
			$params = ($params) ? $params : $this->params;
		  	//print_r($this->params);exit();

			$rslt['user_Id'] = $params['eab_user']['user_id'];
			$rslt['evnt_StartDate'] = date('Y-m-d', strtotime($params['evnt_StartDate']));
			
			$rslt['createdDate'] = DB_DATE;
			$rslt['is_deleted'] = 0;
			$profileId = $this->insertRecord($rslt);
			return $profileId;
	}



	function updateProject($params=array())
	{
		
			clearErrorMessage();
			$error = false;
			$params = ($params) ? $params : $this->params;
			
		  	//print_r($this->params);exit();

			//$rslt['user_Id'] = $params['mnt_mobile_no'];
			$rslt['createdDate'] = DB_DATE;
			$rslt['is_deleted'] = 0;
			$rslt['is_approve']=0;

			//print_r($rslt);exit();
			$recUpdate = $this->updateRecord($rslt, 'evnt_Id');
			$profileId = $rslt['evnt_Id'];
			/*$profileId = $this->updateRecord($rslt,'evnt_Id');*/
			return $profileId;
	}

	function getProjectList($userId,$eventYear,$eventMonth,$eventApprove){
		$params = $this->params;
		$qry = "call getProjectList(%d,%d,%d,%d);";
		$qry = $this->db->prepareQuery($qry,$userId,$eventYear,$eventMonth,$eventApprove);
		//exit;
		$rslt = $this->db->getResultSet($qry);
		return $rslt;
	}

	function getProjectListAll($userId){
		$params = $this->params;
		$qry = "call getProjectListAll(%d);";
		 $qry = $this->db->prepareQuery($qry,$userId);
		//exit;
		$rslt = $this->db->getResultSet($qry);
		return $rslt;
	}


	function deleteProject($evntId){
			$rslt['evnt_Id'] = $evntId;
			$rslt['is_deleted'] = 1;
			//print_r($rslt);exit();
			$recUpdate = $this->updateRecord($rslt, 'evnt_Id');
			$profileId = $rslt['evnt_Id'];
			/*$profileId = $this->updateRecord($rslt,'evnt_Id');*/
			return $profileId;
	}

	


	
	

}
?>