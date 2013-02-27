<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
 * @subpackage  Libraries
 * @category    Auth
 * @author      Agung Hari <a9un9hari@gmail.com><a9un9hari.com>
 */
class MW_auth {

    function __construct() {
        $this->ci = & get_instance();
    }

    function login($identity, $password) {
        return $this->ci->mw_auth_model->login($identity, $password);
    }

    function logged_in() {
        if ($this->ci->session->userdata('logged_in')) {
            return true;
        } else {
            return false;
        }
    }

    function info_user($field, $value) {
        $identity = 'email_user';
        return $this->ci->mw_auth_model->info_user($field, $value, $identity);
    }

    function require_authentication() {
        if (!logged_in()) {
            redirect('user/login', 'refresh');
        }return true;
    }

    function cek_access($permission) {
        if ($this->ci->session->userdata('usertype') == $permission) {
            return true;
        } else {
            return false;
        }
    }

    function logout() {
        $this->ci->session->sess_destroy();
        redirect('user/login', 'refresh');
    }

}