<?php
class Update {

    private $update_id;
    private $date_time;
    private $post_comment;
    private $update_user;
    private $update_event_id;
    
    
    function __construct(){
        
    }
    function loadUpdateById($update_event_id) {
        include "update-manager.php";
        $updatearray = getUpdatebyId($update_event_id);
        return $updatearray;
    
    }
    
    function factory_create ( $update_id, $date_time, $post_comment, $update_user, $update_event_id ) {
        $this->update_id = $update_id;
        $this->date_time = $date_time;
		$this->post_comment = $post_comment;
		$this->update_user = $update_user;
		$this->update_event_id = $update_event_id;
	}
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->update_id;
    }
    /**
     * @return mixed
     */
    public function getDate_time()
    {
        $time = strtotime($this->date_time);
        $newformat = date('Y-m-d',$time);
        return $newformat;
    }

    /**
     * @return mixed
     */
	  public function getPost_Comment()
    {
        return $this->post_comment;
    }
    public function getUpdate_User()
    {
        return $this->update_user;
    }
	/**
     * @return mixed
     */
    public function getEvent_ID()
    {
        return $this->update_event_id;
    }

    /**
     * @return mixed
     */

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->update_id = $id;
    }


    /**
     * @param mixed $date_time
     */
    public function setDate_time($date_time)
    {
        $this->date_time = $date_time;
    }

    /**
     * @param mixed $status
     */
    public function setPost_Comment($postcomment)
    {
        $this->post_comment = $postcomment;
    }

    /**
     * @param mixed $type
     */
    public function setUpdateUser($updateuser)
    {
        $this->update_user = $updateuser;
    }
	public function setEvent_ID($updateEvent)
    {
        $this->update_event_id = $updateEvent;
    }


  


    
}