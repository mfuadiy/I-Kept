<?php

/**
 * 
 */
class Pajak_model extends CI_Model
{
    public function getPensiun()
    {
        // $where = array(
        //     'okverifi !='     => '',
        //     'tgl_akhir ='     => ''
        // );
        // return $this->db->get_where('dbpnm_pn', $where)->result_array();


        $this->db->select('*');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpn.p_bln', '08');
        $this->db->where('dbpn.p_thn', '2022');
        $this->db->order_by('dbpn.nama', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getAnalytic()
    {
        $this->db->select('*');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpn.p_bln', '08');
        $this->db->where('dbpn.p_thn', '2022');
        //$this->db->where("dbpnm_pn.npk LIKE " . "'%88__'");
        //$this->db->where("dbpnm_pn.tgmlb BETWEEN" . "'1988-01-01'" . "AND" . "'1988-12-31'");
        $this->db->order_by('dbpn.nama', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getBank()
    {
        $this->db->select('*');
        $this->db->from('dbpn');
        //$this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('p_bln', '08');
        $this->db->where('p_thn', '2022');
        $this->db->order_by('lokgj', 'ASC');
        $this->db->group_by('lokgj');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getDetail($npk)
    {
        $this->db->select('*');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpnm_pn.npk', $npk);
        $this->db->where('dbpn.p_bln', '08');
        $this->db->where('dbpn.p_thn', '2022');
        $this->db->order_by('dbpnm_pn.nama', 'ASC');
        $query = $this->db->get()->row_array();
        return ($query);
    }
}
