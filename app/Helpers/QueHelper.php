<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
class QueHelper
{
   public static function getProjectTaskByStatus($statusId, $projectName) {
        $query = DB::select('select s.id as statusId, s.name as status_name , u.name as project_name  from sections as s inner join users as u on u.section_id = s.id where  s.id = ?',[$statusId]);        
        return $query;
    }
    
    public static function getAllStatus($projectName) {
        $query = DB::select('select * from tickets where serving_time is null and served_time is null and section_id = ?',[$projectName]);
        return $query;
    }
    
    public static function editTaskStatus($status_id, $task_id) {

        $query = DB::update("UPDATE tickets SET station_id = ? WHERE id = ?",[$status_id, $task_id]);

        return $query;
    }
	
	public static function addTaskItem($title, $projectName,$status_id) {
        // $db_handle = new DBController();
		// $query = "INSERT INTO tbl_task (title, description, project_name, status_id, created_at) VALUES ('".mysqli_real_escape_string($db_handle,$title)."','',$projectName , $statusId,'".date("Ymd")."')";
        // $result = $db_handle->runBaseQuery($query);
        // return $result;
    }
}