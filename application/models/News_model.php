<?php

class News_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    function insert_news($data) 
    {
        $this->db->insert('berita', $data);
    }

    function select_all()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('tgl_berita');
        return $This->db->get();
    }

    function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->where('no_berita', $id);
        return $this->db->get();
    }

    function update_berita($id, $data)
    { 
        $this->db->where('no_berta', $id);
        $this->db->update('berita', $data);
    }

    function delete_berita($id) 
    {
        $this->db->where('no_berita', $id);
        $this->db->delete('berita');
    }

    function select_all_paging($limit = array()) 
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('tgl_berita', 'desc');
        if($limit != NULL) $this->db->limit($limit['perpage'], $limit['offset']);
        
        return $this->db->get();
    }
}

?>