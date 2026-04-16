<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    private $adminTbl;
    private $usersTbl;
    // private $menuTbl;
    // private $privilegeTbl;
    // public $settingTbl;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'admin';
        $this->usersTbl = 'users';
        // $this->menuTbl = 'tbl_group_menu_list';
        // $this->privilegeTbl = 'tbl_group_privilege';
        // $this->settingTbl = 'tbl_setting';
        // $this->privilegePathTbl = 'tbl_privilege_path';
    }
    public function isvalidate($email)
    {
        //$pass=md5($password);
        $builder = $this->db->table($this->adminTbl);
        $builder->where('email', $email);
        $builder->where('status', 1);
        $query = $builder->get();
        //print_r($query);exit;
        $result = $query->getRow();
        //print_r($result);exit;
        return $result;
    }

    public function is_users_validate($email)
    {
        $builder = $this->db->table($this->usersTbl); // users table
        $builder->where('email', $email);
        $builder->where('status', 1);
        $query = $builder->get();
        return $query->getRow();
    }
    public function get_profile_data()
    {
        $builder = $this->db->table($this->adminTbl);
        $builder->where('email', session('email'));
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_profile($data, $id)
    {
        $builder = $this->db->table($this->adminTbl);
        $builder->where('user_id', $id);
        $result = $builder->update($data);
        return $result;
    }
    public function is_user_privilege($privilegeId, $menuId, $functionId = null)
    {
        $builder = $this->db->table($this->privilegeTbl);
        $builder->where('group_id', $privilegeId);
        $builder->where('menu_id', $menuId);
        if ($functionId == null) {
            $functionId = 1;
        }
        $builder->where('FIND_IN_SET(' . $functionId . ', crud_ids)');
        $query = $builder->get();
        $value = $query->getRow();
        return $value;
    }
    public function getCurrentUrlPrivilege($customPath)
    {
        $builder = $this->db->table($this->privilegePathTbl);
        $builder->where('custom_path', $customPath);
        $query = $builder->get();
        $value = $query->getRow();
        return $value;
    }
}