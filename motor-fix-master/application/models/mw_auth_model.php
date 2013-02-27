<?php
/*
 * Copyright (c) 2011 Imajiku -- http://imajiku.com
 * AUTHORS:
 *   Agung Hari Wijaya
 *   a9un9hari@gmail.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
* RR Auth modified to integrate easily with Codeigniter
* Wait, this is  beta version. :)
*
* @package     CodeIgniter
* @subpackage  Model
* @category    Auth
* @author      Agung Hari <a9un9hari@gmail.com><a9un9hari.com>
*/
class MW_auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	//Fungsi untuk anti-SQL injection
	function cleanuserinput($dirty){
		if (get_magic_quotes_gpc()){
			$clean = mysql_real_escape_string(stripslashes($dirty));
		}else{
			$clean = mysql_real_escape_string($dirty);
		}
		return $clean;
	}
	//Cek user ke dalam database
	function login($email,$password)
	{
		$login		= $this->db->query('SELECT id_user,email_user,password_user,permission
										FROM tb_user
										WHERE email_user = "'.$this->cleanuserinput($email).'"
										LIMIT 0,1');
		if($login->num_rows() == 1)
		{
			$result = $login->row();
			$password = md5($password);
			if($result->password_user == trim($password))
			{
				$data = array(
				   'lastvisitDate' => date('Y-m-d h:i:s')
				);
				$this->db->where('email_user', $this->cleanuserinput($email));
				$this->db->update('tb_user', $data); 	

				return $this->authenticate($this->cleanuserinput($email),$result->permission,$result->id_user);
			}
			else
			{
				$this->session->set_flashdata('message', '<span class="error">Maaf password dan email anda tidak cocok, coba login kembali.</span>');
				return false;
			}
			return false;
		}
		else
		{
			$this->session->set_flashdata('message', '<div class="error">Maaf, data anda tidak ada dalam sistim kami, silahkan masuk kembali.</div>');
			return false;
		}
	}
	//Masukkan session data
	function authenticate($email,$permission,$id)
	{
		$data = array(
				'email'  	=> $email,
				'usertype'  => $permission,
				'id'  		=> $id,
                'logged_in' => TRUE
               );
		$this->session->set_userdata($data);
		return true;
	}
	//mencari data dari user
	function info_user($field,$value,$identity)
	{
		$this->db->select($field);
		$query = $this->db->get_where('tb_user', array($identity => $value));
		$row = $query->row();
		return $row->$field;
	}
}
?>