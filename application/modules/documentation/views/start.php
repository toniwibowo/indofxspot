<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			<h1>3 Min Quick Start</h1>
			<br>
			<h3><a href="#page-builder" id="page-builder">#</a> Page Builder</h3>
			<p>Page builder let's build static or dynamic page less coding, let's start!</p>
			<ol>
				<li>First go to <strong>Page Builder</strong> in backend</li>
				<li>There's <strong>Add Page</i></strong> button to create page</li>
				<li>In Add Page there's form : 
					<ul>
						<li><strong>Title</strong><br>Title for title of page, this is required.</li>
						<li><strong>Featured Image</strong><br>Featured image for add image that showing in the page.</li>
						<li><strong>Link</strong><br>Link for create link of page this is required and unique.</li>
						<li><strong>Template</strong><br>Template has 2 options Frontend and Backend, Frontend for page that show in frontend page Backend that show in Backend Page.</li>
						<li><strong>Breadcrumb</strong><br>Breadcrumb for list menu history.</li>
						<li><strong>Content</strong><br>Content for main content of page.</li>
						<li><strong>Keyword</strong><br>Keyword for meta tag keyword.</li>
						<li><strong>Description</strong>Description for meta tag description.</li>
						<li><strong>View</strong>View is list of view template that you created.</li>
					</ul>
				</li>
				<li>After fill the form and save, in the list of page you get link the page, for example <strong>page/about</strong>, can be accsess via <strong>domain.com/page/about</strong></li>
			</ol>
			<h3><a href="#crud-builder" id="crud-builder">#</a> CRUD Builder</h3>
			<p>CRUD Builder let's build CRUD (Create, Read, Update, Delete) apps without coding, let's start</p>
			<ol>
				<li>First go to <strong>CRUD Builder</strong> in backend</li>
				<li>There's <strong>Add Table</i></strong> button to create CRUD apps</li>
				<li>In Add Page there's form : 
					<ul>
						<li><strong>Table name</strong><br>Table name is list of table you created in database.</li>
						<li><strong>Subject</strong><br>Subject for subject of CRUD.</li>
						<li><strong>Title</strong><br>Title for title of page CRUD.</li>
						<li><strong>Required</strong><br>Required for list field are required.</li>
						<li><strong>Columns</strong><br>Columns for list columns that show in CRUD page.</li>
						<li><strong>Field</strong><br>Field for list field that show in the CRUD page.</li>
						<li><strong>Upload</strong><br>Upload for field upload file.</li>
						<li><strong>Relation 1-n</strong><br>Relation 1-n is relation one to many field.</li>
						<li><strong>Action</strong><br>Action for limit action of CRUD.</li>
						<li><strong>Breadcrumb</strong><br>Breadcrumb for list menu history.</li>
					</ul>
				</li>
				<li>After fill the form and save, in the list of CRUD Builder you get link the page, for example <strong>myigniter/table/book</strong>, can be accsess via <strong>domain.com/myigniter/table/book</strong></li>
			</ol>
			<h3><a href="#controller" id="controller">#</a>Example Controller</h3>
			<p>This example controller for who don't want using builder, you can also export that you build in builder by clicking green button <strong><i class="fa fa-code"></i> PHP</strong></p>
<pre><code class="html">&lt;?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Example Controller.
 */
class Example extends MX_Controller
{
    private $title;
    private $front_template;
    private $admin_template;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('output_view'); // Magic library

        $this->title = 'Hello World'; // Set title page
        $this->front_template = 'template/front_template'; // Set frontend template
        $this->admin_template = 'template/admin_template'; // Set backend template
    }

    /**
     * Frontend Hello World page.
     */
    public function index()
    {
        $this->load->model('bookModel'); // Load smart model
        $data['book'] = $this->bookModel->search(); // Search model
        $data['helloWorld'] = 'Hello World'; // Data send to wrapper

        $this->output_view->set_title($this->title);
        $this->output_view->set_wrapper('page', 'hello_world', $data);
        $this->output_view->output($this->front_template);
    }
......
</code></pre>
			<p>Full example can be found in <strong>application/modules/example/controllers/Example.php</strong> or <a href="<?php echo site_url('documentation/welcome') ?>" title="Full Documentation">Full Documentation</a></p>
		</div>
	</div>
</div>
<script>hljs.initHighlightingOnLoad();</script>