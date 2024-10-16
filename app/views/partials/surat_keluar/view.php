<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Surat Keluar</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_surat">
                                        <th class="title"> Id Surat: </th>
                                        <td class="value"> <?php echo $data['id_surat']; ?></td>
                                    </tr>
                                    <tr  class="td-no_agenda">
                                        <th class="title"> No Agenda: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['no_agenda']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="no_agenda" 
                                                data-title="Enter No Agenda" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['no_agenda']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-no_kode">
                                        <th class="title"> No Kode: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['no_kode']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="no_kode" 
                                                data-title="Enter No Kode" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['no_kode']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-tgl_surat">
                                        <th class="title"> Tgl Surat: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['tgl_surat']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="tgl_surat" 
                                                data-title="Enter Tgl Surat" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tgl_surat']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-pengolah">
                                        <th class="title"> Pengolah: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $pengolah); ?>' 
                                                data-value="<?php echo $data['pengolah']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="pengolah" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['pengolah']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-kepada">
                                        <th class="title"> Kepada: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['kepada']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="kepada" 
                                                data-title="Enter Kepada" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['kepada']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-uraian_ringkasan">
                                        <th class="title"> Uraian Ringkasan: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['uraian_ringkasan']; ?>" 
                                                data-pk="<?php echo $data[''] ?>" 
                                                data-url="<?php print_link("surat_keluar/editfield/" . urlencode($data['id_surat'])); ?>" 
                                                data-name="uraian_ringkasan" 
                                                data-title="Enter Uraian Ringkasan" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['uraian_ringkasan']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-save"></i> Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                    <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                        <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                        </a>
                                        <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                        <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                            <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                            </a>
                                            <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                            <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                </a>
                                                <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                    <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                    </a>
                                                    <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                        <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
