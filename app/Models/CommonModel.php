<?php
namespace App\Models;
use CodeIgniter\Model;

class CommonModel extends Model
{
    protected $useSoftDeletes = true;
    protected $deletedField  = 'deleted_at';
    protected $db;
    private $adminTbl;
    private $roleTbl;
    private $menuTbl;
    private $privilegeTbl;
    // public $settingTbl;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'admin';
        $this->roleTbl = 'tbl_role_privilege';
        $this->menuTbl = 'tbl_menu_list';
        $this->privilegeTbl = 'tbl_privilege';
        // $this->settingTbl = 'tbl_setting';
    }
    public function insertRecord($table, $data)
    {
        $builder = $this->db->table($table);
        $builder->Insert($data);
        return $this->db->insertID();
    }
    public function getAllRecord($table, $whereArr = null, $orderBy = null)
    {
        $builder = $this->db->table($table);
        if ($whereArr != null) {
            $builder->where($whereArr);
        }
        if ($orderBy != null) {
            $builder->orderBy($orderBy[0], $orderBy[1]);
        }
        $query = $builder->get();

        // echo $this->db->getLastQuery(); exit;

        $result = $query->getResult();
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    public function getOneRecord($table, $whereArr = null)
    {
        $builder = $this->db->table($table);
        if ($whereArr != null) {
            $builder->where($whereArr);
        }
        $query = $builder->get();

        $result = $query->getRow();
        // echo '<pre>';print_r($result); exit;
        return $result;
    }
    public function updateRecord($table, $data, $whereArr)
    {
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->update($data);
        return $result;
    }
    public function deleteRecord($table, $whereArr)
    {
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->delete();
        return $result;
    }
    // public function get_setting($id = '')
    // {
    //     $builder = $this->db->table($this->settingTbl);
    //     $builder->where('id', $id);
    //     $query = $builder->get();
    //     $result = $query->getRow();
    //     return $result;
    // }
    // public function update_setting($data, $id)
    // {
    //     $builder = $this->db->table($this->settingTbl);
    //     $builder->where('id', $id);
    //     //$query = $builder->get();
    //     $result = $builder->update($data);
    //     return $result;
    // }
}