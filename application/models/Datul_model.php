<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Datul_model extends CI_Model
{
    public function getPensiun($npk)
    {
        $this->db->select('*');
        $this->db->from('dbpnm_pn');
        $this->db->join('pn', 'pn.npk = dbpnm_pn.npk', 'right');
        $this->db->where('dbpnm_pn.npk', $npk);
        // $this->db->or_where('dbpnm.kota', 'Karawang');
        $this->db->order_by('dbpnm_pn.nama', 'ASC');
        $query = $this->db->get()->row_array();
        return ($query);
    }

    public function getAhliWaris($npk)
    {
        return $this->db->get_where('aw_pn', ['npk' => $npk])->result_array();
    }

    public function getDatul()
    {
        return $this->db->get('datul')->result_array();
    }

    public function getAllPensiun($limit, $start, $keyword = null)
    {
        $this->db->select('dbpnm_pn.npk, dbpnm_pn.nopen, dbpnm_pn.nama');
        $this->db->from('dbpnm_pn');
        if ($keyword) {
            $this->db->like('dbpnm_pn.npk', $keyword);
            $this->db->or_like('dbpnm_pn.nama', $keyword);
        }
        $this->db->join('dbpn', 'dbpn.npk = dbpnm_pn.npk');
        $this->db->where('dbpn.p_bln', '02');
        $this->db->where('dbpn.p_thn', '2022');
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
