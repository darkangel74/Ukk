<?php
	class General_model extends CI_model
	{
		function construct()
		{
			parent::__construct();
		}
		function insert($table,$data)		
		{			
			if($table == FALSE OR $data == FALSE)
			{
				return FALSE;
			}
			else
			{
				if(!is_array($data))
				{
					return FALSE;
				}
				else
				{
					$insert = $this->db->insert($table,$data);
					return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
				}
			}
		}
		
		function update($table,$data,$where)
		{
			if($table == FALSE OR $data == FALSE OR $where == FALSE)
			{
				return FALSE;
			}
			else
			{
				if(!is_array($data))
				{
					return FALSE;
				}
				else
				{
					$this->db->where($where);
					$update = $this->db->update($table,$data);
					return TRUE;
				}
			}
		}
		function delete($table,$where=NULL)
		{
			if(!empty($where))
			{
				$this->db->where($where);
			}
			if(!empty($table))
			{
				$this->db->delete($table);
			}
			else
			{
				return FALSE;
			}
		}
		function select($table, $where=NULL, $field=NULL, $limit=NULL, $orderby=NULL, $join=FALSE, $like=FALSE)
		{
			if(!empty($join))
			{
				if(is_array($join))
				{
					foreach($join as $row)
					{
						$val_1		= $row[1];
						$val_2		= $row[2];
						$val_3		= $row[3];
						$this->db->join($val_1, $val_2, $val_3);
					}
				}
				else
				{
					return FALSE;
				}				
			}
			if(!empty($like))
			{
				if(is_array($like))
				{
					$val_1		= $like[0];
					$val_2		= $like[1];
					$val_3		= $like[2];
					$this->db->like($val_1, $val_2, $val_3); // 'NAMA_FIELD', 'lIKE OPO', '%'
				}
			}
			if(!empty($orderby))
			{
				if(is_array($orderby))
				{
					$val_1		= $orderby[1];
					$val_2		= $orderby[2];
					$this->db->order_by($val_1, $val_2); 
				}
				else
				{
					$this->db->order_by($orderby);
				}				
			}
			if(!empty($limit))
			{
				if(is_array($limit))
				{
					$this->db->limit($limit[1], $limit[0]);
				}
				else
				{
					$this->db->limit($limit);
				}
			}
			if(empty($field))
			{
				if(!empty($where))
				{
					$this->db->where($where);					
				}
				$query = $this->db->get($table);
				if($query->num_rows() < 1)
				{
					$query->free_result();
					return FALSE;
				}
				else
				{
					$res = $query;
					return $res;
				}
			}
			else
			{
				$this->db->select($field);
				if(!empty($where))
				{
					$this->db->where($where);				
				}
				$query = $this->db->get($table);
				if($query->num_rows() < 1)
				{
					$query->free_result();
					return FALSE;
				}
				else
				{
					$res = $query;
					return $res;
				}
			}
		}
		function total($table,$where=NULL,$field=NULL)
		{
			if(empty($field))
			{
				if(!empty($where))
				{
					$this->db->where($where);
				}
				$query = $this->db->get($table);
				return $query->num_rows();
			}
			else
			{
				$this->db->select($select);
				if(!empty($where))
				{
					$this->db->where($where);
				}
				$query = $this->db->get($table);
				return $query->num_rows();
			}
		}
	}
?>