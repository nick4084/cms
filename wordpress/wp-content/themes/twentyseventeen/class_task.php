<?php
class Task {

    private $id;
    private $action_scope;
	private $status;
	private $event_id;
	private $assigned_user;
    
    function __construct(){
        
    }
    function loadTaskById( $id ) {
        include "task-manager.php";
        return getTaskbyId($id);
		
    }
    
    function factory_create ( $id, $action_scope ,$status , $event_id,$assigned_user ) {
        $this->id = $id;
        $this->action_scope = $action_scope;
        $this->status = $status;
        $this->event_id = $event_id;
		$this->assigned_user = $assigned_user;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
	
	public function getAction_scope()
    {
        return $this->action_scope;
    }
	
	public function getStatus()
    {
        return $this->status;
    }
	
	public function getEvent_id()
    {
        return $this->event_id;
    }
	
	public function getAssigned_user()
    {
        return $this->assigned_user;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
	
	public function setAction_scope($action_scope)
    {
        $this->action_scope = $action_scope;
    }
	
	public function setStatus($status)
    {
        $this->status = $status;
    }
	
	public function setEvent_id($event_id)
    {
        $this->event_id = $event_id;
    }
	
	public function setAssigned_user($assigned_user)
    {
        $this->assigned_user = $assigned_user;
    }



    
}