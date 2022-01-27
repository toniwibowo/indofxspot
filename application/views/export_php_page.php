public function <?php echo str_replace('-', '_', $page->slug)?>()
{
	$this->db->where("slug", "<?php echo $page->slug ?>");
	$data["content"] = $this->db->get("page")->row();

<?php 
	$add_crumb = "[";
	if ($page->breadcrumb != "null") {
	$crumbs = json_decode($page->breadcrumb);
	foreach ($crumbs as $value) {
		$add_crumb .= '"'.$value->label.'" => "'.$value->link.'",';
 	}
} else { 
	$add_crumb .= '"page" => ""';
} 
	$add_crumb .= "]";
?>
<?php if ($page->view == 'default'): ?>
   	$view = "page";
<?php else: ?>
   	$view = "page/<?php echo $page->view ?>";
<?php endif ?>
	$this->output_view->set_wrapper('page', $view, $data);

<?php if ($page->template == 'frontend'): ?>
	$template = "<?php echo $front_template ?>";
<?php else: ?>
	$this->output_view->auth();
	$template = "<?php echo $admin_template ?>";
<?php endif ?>
	$template_data["judul"] = "<?php echo $page->title ?>";
	$template_data["crumb"] = <?php echo $add_crumb ?>;

	$this->output_view->output($template, $template_data);
}
