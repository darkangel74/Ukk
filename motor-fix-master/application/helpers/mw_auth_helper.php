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
* MW Auth modified to integrate easily with Codeigniter
* Wait, this is  beta version. :)
*
* @package     CodeIgniter
* @subpackage  Helper
* @category    Auth
* @author      Agung Hari <a9un9hari@gmail.com><a9un9hari.com>
*/
	function info_user($field,$value)
	{
		$ci =& get_instance();
		return $ci->mw_auth->info_user($field,$value);
	}
	function require_authentication()
	{
		$ci =& get_instance(); 
		return $ci->mw_auth->require_authentication();
	}
	function cek_access($permission){
		$ci =& get_instance(); 
		return $ci->mw_auth->cek_access($permission);
	}
	function logged_in()
	{
		$ci =& get_instance();
		return $ci->mw_auth->logged_in();
	}
	function logout()
	{
		$ci =& get_instance();
		return $ci->mw_auth->logout();
	}

?>