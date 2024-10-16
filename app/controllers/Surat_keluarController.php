<?php 
/**
 * Surat_keluar Page Controller
 * @category  Controller
 */
class Surat_keluarController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "surat_keluar";
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
			"no_kode", 
			"tgl_surat", 
			"pengolah", 
			"kepada", 
			"uraian_ringkasan");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				surat_keluar.id_surat LIKE ? OR 
				surat_keluar.no_agenda LIKE ? OR 
				surat_keluar.no_kode LIKE ? OR 
				surat_keluar.tgl_surat LIKE ? OR 
				surat_keluar.pengolah LIKE ? OR 
				surat_keluar.kepada LIKE ? OR 
				surat_keluar.uraian_ringkasan LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "surat_keluar/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("surat_keluar.id_surat", ORDER_TYPE);
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
		$page_title = $this->view->page_title = "Surat Keluar";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("surat_keluar/list.php", $data); //render the full page
	}
// No View Function Generated Because No Field is Defined as the Primary Key on the Database Table
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
			$fields = $this->fields = array("no_agenda","no_kode","tgl_surat","pengolah","kepada","uraian_ringkasan");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'no_agenda' => 'required',
				'no_kode' => 'required',
				'tgl_surat' => 'required',
				'pengolah' => 'required',
				'kepada' => 'required',
				'uraian_ringkasan' => 'required',
			);
			$this->sanitize_array = array(
				'no_agenda' => 'sanitize_string',
				'no_kode' => 'sanitize_string',
				'tgl_surat' => 'sanitize_string',
				'pengolah' => 'sanitize_string',
				'kepada' => 'sanitize_string',
				'uraian_ringkasan' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("surat_keluar");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Surat Keluar";
		$this->render_view("surat_keluar/add.php");
	}
// No Edit Function Generated Because No Field is Defined as the Primary Key
// No Delete Function Generated Because No Field is Defined as the Primary Key on the Database Table/View
}
