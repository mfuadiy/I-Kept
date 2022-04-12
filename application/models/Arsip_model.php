<?php

/**
 * 
 */
class Arsip_model extends CI_Model
{
    public function getAktif()
    {
        $this->db->select('noreg, nama_pes');
        $this->db->from('dbpam_pa');
        $this->db->where('st_pes', 'A');
        $this->db->order_by('nama_pes', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getPasif()
    {
        $this->db->select('dbpn.npk, dbpn.nama');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpn.p_bln', '03');
        $this->db->where('dbpn.p_thn', '2022');
        $this->db->order_by('dbpn.nama', 'ASC');
        $query = $this->db->get()->result_array();
        return ($query);
    }

    public function getAktifByNpk($npk)
    {
        $this->db->select('nama_pes');
        $this->db->from('dbpam_pa');
        $this->db->where('noreg', $npk);
        $this->db->order_by('nama_pes', 'ASC');
        $query = $this->db->get()->row_array();
        return ($query);
        //return $this->db->get_where('dbpam_pa', ['noreg' => $npk])->row_array();
    }

    public function getPasifByNpk($npk)
    {
        $this->db->select('dbpn.nama');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpn.npk', $npk);
        $this->db->where('dbpn.p_bln', '03');
        $this->db->where('dbpn.p_thn', '2022');
        $this->db->order_by('dbpn.nama', 'ASC');
        $query = $this->db->get()->row_array();
        return ($query);
    }
}
