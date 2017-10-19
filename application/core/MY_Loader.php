<?php
/**
 * PHP Codeigniter Simplicity
 *
 * Copyright (C) 2013  John Skoumbourdis.
 *
 * GROCERY CRUD LICENSE
 *
 * Codeigniter Simplicity is released with dual licensing, using the GPL v3 and the MIT license.
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	Codeigniter Simplicity
 * @copyright  	Copyright (c) 2013, John Skoumbourdis
 * @license    	https://github.com/scoumbourdis/grocery-crud/blob/master/license-grocery-crud.txt
 * @version    	0.6
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 */
class MY_Loader extends CI_Loader {

	private $_javascript = array();
	private $_css = array();
	private $_inline_scripting = array("infile"=>"", "stripped"=>"", "unstripped"=>"");
	private $_sections = array();
	private $_cached_css = array();
	private $_cached_js = array();
	public $CI = null;

	
	function __construct(){

		if(!defined('SPARKPATH'))
		{
			define('SPARKPATH', 'sparks/');
		}

		parent::__construct();
		$this->CI =& get_instance();
	}
	
	function active_menu($url)
	{
		#if(base_url(uri_string())==base_url('settings/general')) echo ' class="active"';
		if(base_url(uri_string())==base_url($url))
		{
			return ' class="active"';
		}
		else
		{
			return false;
		}
	}
	
	function template($template_name, $data = array(), $return = FALSE)
	{
		$menu = array();
		$this->CI->load->model('Accounts_Model');
		
		/* 
		* Here we need the guy who feels the need of doing this the right way
		*/
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_companies')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('companies') . '><a href="' . base_url('companies') . '"><i class="icon mdi icon mdi-balance"></i> Companies</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_clients')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('clients') . '><a href="' . base_url('clients') . '"><i class="icon mdi icon mdi-accounts-list"></i> Clients</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_quotes')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('quotes') . '><a href="' . base_url('quotes') . '"><i class="icon mdi icon mdi-format-list-numbered"></i> Quotes</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_orders')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('orders') . '><a href="' . base_url('orders') . '"><i class="icon mdi icon mdi-assignment"></i> Orders</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_invoices')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('invoices') . '><a href="' . base_url('invoices') . '"><i class="icon mdi icon mdi-accounts-list"></i> Invoices</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_teams')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('teams') . '><a href="' . base_url('teams') . '"><i class="icon mdi icon mdi-accounts"></i> Teams</a></li>');
		}
		
		if($this->CI->Accounts_Model->get_permission($this->CI->session->userdata('account_group_id'), 'view_projects')===true)
		{
			
			array_push($menu, '<li' . $this->active_menu('projects') . '><a href="' . base_url('projects') . '"><i class="icon mdi icon mdi-cloud-circle"></i> Projects</a></li>');
		}
		
		$data['menu'] = $menu;
		$data['sidebar'] = $this->view('templates/sidebar', $data, TRUE);
		$data['sidebar_right'] = $this->view('templates/sidebar_right', NULL, TRUE);
		$data['header'] = 	$this->view('templates/header', $data, TRUE);
		$data['footer'] 	= 	$this->view('templates/footer', NULL, TRUE);
		
		$this->load->view($template_name, $data);
	}
}