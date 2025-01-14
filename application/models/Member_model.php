<?php
class Member_model extends CI_Model {

public function getMemberById($id)
{
    return $this->db->get_where('members', ['id_members' => $id])->row_array();
}

}