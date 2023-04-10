<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Datul_model extends CI_Model
{
    public function getPensiun($npk)
    {
        return $this->db->get_where('dbpnm_pn', ['npk' => $npk])->row_array();
    }

    public function getAhliWaris($npk)
    {
        return $this->db->get_where('aw_pn', ['npk' => $npk])->result_array();
    }

    public function getDatul()
    {
        return $this->db->get('datul')->result_array();
    }

    public function getAllPensiun()
    {
        $this->db->select('dbpnm_pn.npk, dbpnm_pn.nopen, dbpnm_pn.nama');
        $this->db->from('dbpnm_pn');
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk');
        $this->db->where('dbpn.p_bln', '01');
        $this->db->where('dbpn.p_thn', '2023');
        $this->db->order_by('dbpn.nama', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getAllSurat($limit, $start, $keyword = null)
    {
        $this->db->select('*');
        $this->db->from('surat_masuk');
        if ($keyword) {
            $this->db->like('perihal', $keyword);
            $this->db->or_like('no_surat', $keyword);
            $this->db->or_like('tgl_surat', $keyword);
            $this->db->or_like('no_agenda', $keyword);
        }
        $this->db->order_by('date_created', 'DESC');
        return $this->db->get('', $limit, $start)->result_array();
    }

    public function getSurat()
    {
        return $this->db->get('surat_masuk')->result_array();
    }
}
