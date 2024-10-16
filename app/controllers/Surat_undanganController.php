<?php 
/**
 * Surat_undangan Page Controller
 * @category  Controller
 */
class Surat_undanganController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "surat_undangan";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("id_surat", 
			"no_agenda", 
			"tgl_surat", 
			"no_surat", 
			"dari", 
			"isi_surat", 
			"tanggal", 
			"tempat", 
			"disposisi", 
			"tgl_diterima", 
			"jam_pelaksanaan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				surat_undangan.id_surat LIKE ? OR 
				surat_undangan.no_agenda LIKE ? OR 
				surat_undangan.tgl_surat LIKE ? OR 
				surat_undangan.no_surat LIKE ? OR 
				surat_undangan.dari LIKE ? OR 
				surat_undangan.isi_surat LIKE ? OR 
				surat_undangan.tanggal LIKE ? OR 
				surat_undangan.tempat LIKE ? OR 
				surat_undangan.disposisi LIKE ? OR 
				surat_undangan.tgl_diterima LIKE ? OR 
				surat_undangan.jam_pelaksanaan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "surat_undangan/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("surat_undangan.id_surat", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Surat Undangan";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("surat_undangan/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("id_surat", 
			"no_agenda", 
			"tgl_surat", 
			"no_surat", 
			"dari", 
			"isi_surat", 
			"tanggal", 
			"tempat", 
			"disposisi", 
			"tgl_diterima", 
			"jam_pelaksanaan");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("surat_undangan.id_surat", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Surat Undangan";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("surat_undangan/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("no_agenda","tgl_surat","no_surat","dari","isi_surat","tanggal","tempat","disposisi","tgl_diterima","jam_pelaksanaan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_agenda' => 'required',
				'tgl_surat' => 'required',
				'no_surat' => 'required',
				'dari' => 'required',
				'isi_surat' => 'required',
				'tanggal' => 'required',
				'tempat' => 'required',
				'disposisi' => 'required',
				'tgl_diterima' => 'required',
				'jam_pelaksanaan' => 'required',
			);
			$this->sanitize_array = array(
				'no_agenda' => 'sanitize_string',
				'tgl_surat' => 'sanitize_string',
				'no_surat' => 'sanitize_string',
				'dari' => 'sanitize_string',
				'isi_surat' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'tempat' => 'sanitize_string',
				'disposisi' => 'sanitize_string',
				'tgl_diterima' => 'sanitize_string',
				'jam_pelaksanaan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("surat_undangan");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Surat Undangan";
		$this->render_view("surat_undangan/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_surat","no_agenda","tgl_surat","no_surat","dari","isi_surat","tanggal","tempat","disposisi","tgl_diterima","jam_pelaksanaan");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_agenda' => 'required',
				'tgl_surat' => 'required',
				'no_surat' => 'required',
				'dari' => 'required',
				'isi_surat' => 'required',
				'tanggal' => 'required',
				'tempat' => 'required',
				'disposisi' => 'required',
				'tgl_diterima' => 'required',
				'jam_pelaksanaan' => 'required',
			);
			$this->sanitize_array = array(
				'no_agenda' => 'sanitize_string',
				'tgl_surat' => 'sanitize_string',
				'no_surat' => 'sanitize_string',
				'dari' => 'sanitize_string',
				'isi_surat' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'tempat' => 'sanitize_string',
				'disposisi' => 'sanitize_string',
				'tgl_diterima' => 'sanitize_string',
				'jam_pelaksanaan' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("surat_undangan.id_surat", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("surat_undangan");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("surat_undangan");
					}
				}
			}
		}
		$db->where("surat_undangan.id_surat", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Surat Undangan";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("surat_undangan/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_surat","no_agenda","tgl_surat","no_surat","dari","isi_surat","tanggal","tempat","disposisi","tgl_diterima","jam_pelaksanaan");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'no_agenda' => 'required',
				'tgl_surat' => 'required',
				'no_surat' => 'required',
				'dari' => 'required',
				'isi_surat' => 'required',
				'tanggal' => 'required',
				'tempat' => 'required',
				'disposisi' => 'required',
				'tgl_diterima' => 'required',
				'jam_pelaksanaan' => 'required',
			);
			$this->sanitize_array = array(
				'no_agenda' => 'sanitize_string',
				'tgl_surat' => 'sanitize_string',
				'no_surat' => 'sanitize_string',
				'dari' => 'sanitize_string',
				'isi_surat' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'tempat' => 'sanitize_string',
				'disposisi' => 'sanitize_string',
				'tgl_diterima' => 'sanitize_string',
				'jam_pelaksanaan' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("surat_undangan.id_surat", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("surat_undangan.id_surat", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("surat_undangan");
	}
}
