<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Task extends \Core\Model
{

    /**
     * Gets all the tasks as an associative array
     *
     * @return array
     */
    public static function getAll(int $offset = 0, int $perPage = 3) : array
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, username, email, task, status FROM tbl_tasks ORDER BY id LIMIT '.$offset.', '.$perPage.'');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Gets task with given the id
     */
    public static function getOne(int $id) : array {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, username, email, task, status FROM tbl_tasks WHERE id='.intval($id).'');
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public static function getCount(){
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(*) FROM tbl_tasks');
        return $stmt->fetchColumn(); 
    }

    /**
     * adds task into tbl_tasks table
     */
    public function add($data) : int
    {
        $db = static::getDB();
        $sql = "INSERT INTO tbl_tasks (username, email,task,status)
            VALUES ('".$data['username']."', '".$data['email']."', '".$data['task']."','new')";
        $db->exec($sql);
        return $db->lastInsertId();
    }

    public function edit($data) {
        $db = static::getDB();
        if(!empty($data['username'])){
            $fieldItems[] = "username = '".$data['username']."'";
        }
        if(!empty($data['email'])){
            $fieldItems[] = "email = '".$data['email']."'";
        }
        if(!empty($data['task'])){
            $fieldItems[] = "task = '".$data['task']."'";
        }
        if(!empty($data['status'])){
            $fieldItems[] = "status = '".$data['status']."'";
        }
        $fields = implode(',', $fieldItems);
        if(!empty($fields)) {
            $sql = "UPDATE tbl_tasks SET {$fields} WHERE id=".intval($data['id'])."";
            $db->exec($sql);
        }
    }

    public function delete(int $id) {
        $db = static::getDB();
        $sql = "DELETE FROM tbl_tasks WHERE id = ".intval($id);
        $db->exec($sql);
    }
}
