<?php
namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->adminTbl = 'tbl_admin';
        $this->rolePrivilegeTbl = 'tbl_role_privilege';
        $this->contactusTbl = 'tbl_contact_us';
        $this->countriesTbl = 'tbl_countries';
        $this->attributesTbl = 'tbl_attributes';
        $this->productTbl = 'tbl_product';
        $this->unitsTbl = 'tbl_units';

    }
    public function getAllUsers($id=null){
        $builder = $this->db->table($this->adminTbl.' u');
        $builder->select('u.*,rp.post_name');
        $builder->join($this->rolePrivilegeTbl.' rp','u.privilege_id=rp.privilege_id','left');
        if($id != null){
            $builder->where('u.user_id', $id);
        }
        $query = $builder->get();
        if($id != null){
            $result = $query->getRow();
        }else{
            $result = $query->getResult();
        }
        return $result;
    }
    public function get_contact_us_listing(){
        $builder = $this->db->table($this->contactusTbl.' cu');
        $builder->select('cu.*,c.countries_name');
        $builder->join($this->countriesTbl.' c','cu.country=c.countries_id','left');
        $builder->orderBy('cu.status', 'ASC');
        $builder->orderBy('cu.id', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function get_attributes_list(){
        $builder = $this->db->table($this->attributesTbl.' at');
        $builder->select('at.*,u.unit');
        // $builder->join($this->productTbl.' p','at.pro_id=p.pro_id','left');
        $builder->join($this->unitsTbl.' u','at.unit_id=u.id','left');
        $builder->orderBy('at.attr_id', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
}