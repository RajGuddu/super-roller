<?php
namespace App\Models;
use CodeIgniter\Model;
class Common_model extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->usersTbl = 'tbl_users';
        $this->privilegeTbl = 'tbl_privilege';
        $this->privilegePathTbl = 'tbl_privilege_path';
        $this->settingTbl = 'tbl_setting';
        $this->bannerTbl = 'tbl_banner';
        $this->pageTbl = 'tbl_page';
    }
    public function getAllRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAllRecordOrderByDesc($table, $whereArr=null, $orderBy=null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        if($orderBy != null){
           $builder->orderBy($orderBy[0],$orderBy[1]);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getOneRecord($table, $whereArr = null){
        $builder = $this->db->table($table);
        if($whereArr != null){
            $builder->where($whereArr);
        }
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function insertRecord($table, $data){
        $builder = $this->db->table($table);
        $builder->Insert($data);
        return $this->db->insertID();
    }
    public function updateRecord($table, $data, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->update($data);
        return $result;
    }
    public function deleteRecord($table, $whereArr){
        $builder = $this->db->table($table);
        $builder->where($whereArr);
        $result = $builder->delete();
        return $result;
    }
    public function get_setting($id=''){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function update_setting($data='', $id=''){
        $builder = $this->db->table($this->settingTbl);
        $builder->where('id',$id);
        //$query = $builder->get();
        $result = $builder->update($data);
        return $result;
    }
    public function get_banners(){
        $builder = $this->db->table($this->bannerTbl.' b');
        $builder->select('b.*, p.page_name');
        $builder->join($this->pageTbl.' p', 'b.page = p.id');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
}