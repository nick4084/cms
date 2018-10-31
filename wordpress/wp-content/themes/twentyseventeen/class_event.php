<?php
class Event {

    private $id;
    private $title;
    private $date_time;
    private $status;
    private $type;
    private $details;
    private $location;
    private $dengue_no_of_case;
    private $psi_value;
    private $pm_2_5;
    private $pm_10;
    private $reporter_name;
    private $reporter_contact;
    private $created_by;
    
    function __construct(){
        
    }
    function loadEventById( $id ) {
        include "event-manager.php";
        $row = getEventbyId($id);
        
        if(isset($row)){
            $this->id = $row["id"];
            $this->title = $row["title"];
            $this->date_time = $row["date_time"];
            $this->type = $row["type"];
            $this->details = $row["details"];
            $this->location = $row["location"];
            $this->dengue_no_of_case = $row["dengue_no_of_case"];
            $this->psi_value = $row["psi_value"];
            $this->pm_2_5 = $row["pm_2_5"];
            $this->pm_10 = $row["pm_10"];
            $this->reporter_name = $row["reporter_name"];
            $this->reporter_contact = $row["reporter_contact"];
            $this->created_by = $row["created_by"];
        }
    }
    
    function factory_create ( $id, $title, $date_time, $status, $type, $details, $location, $dengue_no_of_case, $psi_value, $pm_2_5, $pm_10, $reporter_name, $reporter_contact, $created_by ) {
        $this->id = $id;
        $this->title = $title;
        $this->date_time = $date_time;
        $this->type = $type;
        $this->details = $details;
        $this->location = $location;
        $this->dengue_no_of_case = $dengue_no_of_case;
        $this->psi_value = $psi_value;
        $this->pm_2_5 = $pm_2_5;
        $this->pm_10 = $pm_10;
        $this->reporter_name = $reporter_name;
        $this->reporter_contact = $reporter_contact;
        $this->created_by = $created_by;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getDengue_no_of_case()
    {
        return $this->dengue_no_of_case;
    }

    /**
     * @return mixed
     */
    public function getPsi_value()
    {
        return $this->psi_value;
    }

    /**
     * @return mixed
     */
    public function getPm_2_5()
    {
        return $this->pm_2_5;
    }

    /**
     * @return mixed
     */
    public function getPm_10()
    {
        return $this->pm_10;
    }

    /**
     * @return mixed
     */
    public function getReporter_name()
    {
        return $this->reporter_name;
    }

    /**
     * @return mixed
     */
    public function getReporter_contact()
    {
        return $this->reporter_contact;
    }

    /**
     * @return mixed
     */
    public function getCreated_by()
    {
        return $this->created_by;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param mixed $dengue_no_of_case
     */
    public function setDengue_no_of_case($dengue_no_of_case)
    {
        $this->dengue_no_of_case = $dengue_no_of_case;
    }

    /**
     * @param mixed $psi_value
     */
    public function setPsi_value($psi_value)
    {
        $this->psi_value = $psi_value;
    }

    /**
     * @param mixed $pm_2_5
     */
    public function setPm_2_5($pm_2_5)
    {
        $this->pm_2_5 = $pm_2_5;
    }

    /**
     * @param mixed $pm_10
     */
    public function setPm_10($pm_10)
    {
        $this->pm_10 = $pm_10;
    }

    /**
     * @param mixed $reporter_name
     */
    public function setReporter_name($reporter_name)
    {
        $this->reporter_name = $reporter_name;
    }

    /**
     * @param mixed $reporter_contact
     */
    public function setReporter_contact($reporter_contact)
    {
        $this->reporter_contact = $reporter_contact;
    }

    /**
     * @param mixed $created_by
     */
    public function setCreated_by($created_by)
    {
        $this->created_by = $created_by;
    }

    
}