<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'surat_keluar', 
			'label' => 'Surat Keluar', 
			'icon' => ''
		),
		
		array(
			'path' => 'surat_masuk', 
			'label' => 'Surat Masuk', 
			'icon' => ''
		),
		
		array(
			'path' => 'surat_undangan', 
			'label' => 'Surat Undangan', 
			'icon' => ''
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => '<i class="fa fa-user "></i>'
		)
	);
		
	
	
			public static $pengolah = array(
		array(
			"value" => "Bidang 1", 
			"label" => "Bidang 1", 
		),
		array(
			"value" => "Bidang 2", 
			"label" => "Bidang 2", 
		),
		array(
			"value" => "Bidang 3", 
			"label" => "Bidang 3", 
		),
		array(
			"value" => "TU", 
			"label" => "Tu", 
		),);
		
			public static $user_role_id = array(
		array(
			"value" => "Administrator", 
			"label" => "Administrator", 
		),
		array(
			"value" => "User", 
			"label" => "User", 
		),);
		
}