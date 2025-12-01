<?php
namespace App\Models\Admin;
use CodeIgniter\Model;
class Auth_model extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
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
    public function get_profile_data(){
        $builder = $this->db->table($this->adminTbl);
        $builder->where('user_id', session('user_id'));
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_profile($data, $id){
        $builder = $this->db->table($this->adminTbl);
        $builder->where('user_id', $id);
        $result = $builder->update($data);
        return $result;
    }
    
}