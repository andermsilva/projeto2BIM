<?php 
 namespace App\Models\Entidades;

 class Status{

    private int $statusId;
    private string $status;

    
    public function getStatusId()
    {
        return $this->statusId;
    }

    
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    
    public function getStatus()
    {
        return $this->status;
    }

    
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
 }
?>