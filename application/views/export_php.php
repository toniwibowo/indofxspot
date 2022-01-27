public function <?php echo $table->table_name ?>()
{
	$crud = new grocery_CRUD();
	
	$crud->set_table("<?php echo $table->table_name ?>");
	$crud->set_subject("<?php echo $table->subject ?>");
<?php if ($table->required != ""): 
$required = str_replace("[", "", $table->required);
$required = str_replace("]", "", $required);
?>
	$crud->required_fields(<?php echo $required ?>);
<?php endif ?>
<?php if ($table->columns != "") { 
$columns = str_replace("[", "", $table->columns);
$columns = str_replace("]", "", $columns);
?>
	$crud->columns(<?php echo $columns ?>);			
<?php } ?> 
<?php if ($table->field != "") { 
$field = str_replace("[", "", $table->field);
$field = str_replace("]", "", $field);
?>
	$crud->fields(<?php echo $field ?>);
<?php } ?>
<?php if ($table->uploads != "") {
	$fields_upload = json_decode($table->uploads);
	foreach ($fields_upload as $field_upload) {
?>
	$crud->set_field_upload("<?php echo $field_upload ?>", "assets/uploads/files");
<?php } } ?>
<?php if ($table->relation_1 != "null") {
	$fields_relation = json_decode($table->relation_1);
	foreach ($fields_relation as $field_relation) { 
?>
	$crud->set_relation("<?php echo $field_relation->field ?>", "<?php echo $field_relation->table_name?>", "<?php echo $field_relation->field_view?>");
<?php } } ?>
<?php if ($table->action != "") {
	$action = json_decode($table->action);
	if (!in_array("Create", $action)) {
?>
	$crud->unset_add();
<?php 	}
	if (!in_array("Read", $action)) {
?>
	$crud->unset_read();
<?php 	}
	if (!in_array("Update", $action)) {
?>
	$crud->unset_edit();
<?php	}
	if (!in_array("Delete", $action)) {
?>
	$crud->unset_delete();
<?php 	}
}?>
	$data = (array) $crud->render();

	$this->output_view->set_wrapper('page', 'grocery', $data, false);

	$template_data['grocery_css'] = $data['css_files'];
	$template_data['grocery_js']  = $data['js_files'];
	$template_data["judul"] = "<?php echo $table->title ?>";
<?php 
	$add_crumb = "[";
	if ($table->breadcrumb != "null") {
	$crumbs = json_decode($table->breadcrumb);
	foreach ($crumbs as $value) {
		$add_crumb .= '"'.$value->label.'" => "'.$value->link.'",';
 	}
} else { 
	$add_crumb .= '"table" => ""';
} 
	$add_crumb .= "]";
?>
	$template_data["crumb"] = <?php echo $add_crumb ?>;

	$template = "<?php echo $admin_template ?>";
	$this->output_view->auth();
	$this->output_view->output($template, $template_data);
}