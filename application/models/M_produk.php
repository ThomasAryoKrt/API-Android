<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model{

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getProduk(){
        $this->db->select('
            produk.id,
            produk.admin_id,
            admin.nama_admin,
            produk.nama,
            produk.stok,
            produk.kategori,
            produk.harga');
        $this->db->from('produk');
        $this->db->join('admin', 'admin.id = produk.admin_id');
        $this->db->where('produk.kategori',2);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getProdukSup(){
        $this->db->select('
            produk.id,
            produk.admin_id,
            admin.nama_admin,
            produk.nama,
            produk.stok,
            produk.kategori,
            produk.harga');
        $this->db->from('produk');
        $this->db->join('admin', 'admin.id = produk.admin_id');
        $this->db->where('produk.kategori',1);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertProduk($data){
        $this->db->insert('produk', $data);

        $insert_id  = $this->db->insert_id();
        $result     = $this->db->get_where('produk', array('id' => $insert_id));

        return $result->row_array();
    }

    public function updateProduk($data, $id){
        $this->db->where('id', $id);
        $this->db->update('produk', $data);

        $result = $this->db->get_where('produk', array('id' => $id));

        return $result->row_array();
    }

    public function updateProdukSup($data,$data2,$id){
        $this->db->insert('produk', $data2);
        $this->db->where('id', $id);
        $this->db->update('produk', $data);

        $result = $this->db->get_where('produk', array('id' => $id));

        return $result->row_array();
    }

    public function deleteProduk($id){
        $result = $this->db->get_where('produk', array('id' => $id));

        $this->db->where('id', $id);
        $this->db->delete('produk');

        return $result->row_array();
    }

    public function cekprodukExist($id){
        $data = array(
            "id" => $id
        );

        $this->db->where($data);
        $result = $this->db->get('produk');

        if (empty($result->row_array())) {
            return false;
        }

        return true;
    }
}
