<?php defined('BASEPATH') || exit('No direct script access allowed');

class MY_Model extends CI_Model
{
  public function __construct() {
    parent::__construct();
    $this->db = $this->load->database('default', TRUE);
  }

  protected function _get_data($table = NULL) {
		if (empty($table)) {
			return array();
		}
		$result = $this->db->query('DESC '.$this->db->dbprefix($table))->result_array();
		$fields = array();
		foreach ($result as $v) {
			if ($v['Field'] == 'id') {
				continue;
			}
			$fields[] = $v['Field'];
		}
		$data = array();
		foreach ($_POST as $k => $v) {
			if (in_array($k, $fields)) {
				$data[$k] = $this->input->post($k);
			}
		}
		return $data;
	}
}
