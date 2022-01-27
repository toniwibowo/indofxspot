<h1>Welcome to myigniter</h1>
<p>myIgniter is a custom PHP framework for web developer. Combined between Codeigniter 3.x.x with AdminLTE, and Bootstrap, include auto PHP Grocery CRUD for create table with Create-Read-Update-Delete and Ion authentication system.</p>
<h2><a href="#features" id="features">#</a> Features</h2>
<ul>
    <li>CRUD Builder</li>
    <li>Page Builder</li>
    <li>Modular Extension</li>
    <li>Smart model</li>
    <li>Grocery CRUD with Bootstrap 3.x Theme</li>
    <li>Grocery CRUD with lastest DataTables Plugins</li>
    <li>RESTful Server</li>
    <li>Integerate Codeigniter with AdminLTE</li>
    <li>Integerate IonAuth with Grocery CRUD</li>
    <li>Gulp Build System</li>
    <li>Additional Snippets for Sublime Text 2/3</li>
</ul>
<h2><a href="#requirements" id="requirements">#</a> Requirements</h2>
<ul>
	<li>PHP 5 or higher</li>
	<li>Apache / Nginx (Recomended)</li>
	<li>Mysql / SQL</li>
	<li>Node.js and Gulp (Optional)</li>
</ul>
<h2><a href="#installation" id="installation">#</a> Installation</h2>
<ul>
    <li>Extract myIgniter.zip in your server</li>
    <li>Setting database.php with your databse server</li>
    <li>Change base url to your domain in config.php</li>
    <li>Import examples.sql</li>
</ul>
<h2><a href="#dependency" id="dependency">#</a> Dependency</h2>
<ul>
    <li>GroceryCRUD with Bootstrap 3 Theme</li>
    <li>RESTful server</li>
    <li>AdminLTE</li>
    <li>IonAuth</li>
</ul>
<h2><a href="#documentation" id="documentation">#</a> Documentation</h2>
<ul>
    <li><a href="<?php echo base_url('user_guide') ?>">Codeigniter</a></li>
    <li><a href="http://www.grocerycrud.com/documentation/options_functions/">Grocery CRUD</a></li>
    <li><a href="http://benedmunds.com/ion_auth/">IonAuth</a></li>
    <li><a href="https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html">AdminLTE</a></li>
</ul>
<h3>Config</h3>
<h4>myignter</h4>
<p>Location : <strong>application/config/myigniter.php</strong></p>
<pre><code class="html">$config['site'] = [
    'title' => 'myIgniter', // Default Title entire page
    'favicon' => 'assets/img/favicon-96x96.png', // Default Favicon
    'logo' => 'assets/img/logo/myIgniter.png' // Default Logo
];

// Template
$config['template'] = [
    'front_template' => 'template/front_template', // Default front template
    'backend_template' => 'template/admin_template', // Default backend template
    'auth_template' => 'template/auth_template' // Default auth template
];

// Auth view
$config['view'] = [
    'login' => 'auth/login', // Default login view template
    'register' => 'auth/register', // Defaul register view template
    'forgot_password' => 'auth/forgot_password', // Default forgot password view template
    'reset_password' => 'auth/reset_password' // Default reset password view template
];

// Route
$config['route'] = [
    'default_page' => 'home', // Default first page route
    'login_success' => 'page/home' // Default redirect after success logedin
];

// Email Configuration
$config['email_config'] = [ 
    'protocol' => 'smtp',
    'smtp_host' => 'mail.kotaxdev.co',
    'smtp_user' => 'support@kotaxdev.co',
    'smtp_pass' => '',
    'smtp_port' => 587,
    'mailtype' => 'html',
    'charset' => 'iso-8859-1'
];

// Debugbar
$config['debugbar'] = false; // True show debugbar
</code></pre>
<h3>Library</h3>
<h4>Output_view</h4>
<p>Location : <strong>application/libraries/Output_view.php</strong></p>
<pre><code class="html">set_title($title)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$title(string) - Title of entire page</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>Void</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">get_title($tag = false)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$tag(boolean) - true will output without tag &lt;title&gt;&lt;/title&gt; default false</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>String</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">get_logo()
</code></pre>

    <ul>
        <li><strong>Return type</strong>
            <ul>
                <li>Url</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">get_favicon($favicon = null)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$favicon(string) - url of favicon</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>Favicon tag</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">set_meta_tags($name, $content)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$name(string) - tag name</li>
                <li>$conent(string) - content name</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>Void</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">get_meta_tags()
</code></pre>

    <ul>
        <li><strong>Return type</strong>
            <ul>
                <li>Meta tag</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">set_schema($property, $content)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$property(string) - property schema</li>
                <li>$conent(string) - content schema</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>Void</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">get_schema()
</code></pre>

    <ul>
        <li><strong>Return type</strong>
            <ul>
                <li>schema</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">auth()
</code></pre>

    <ul>
        <li><strong>Return type</strong>
            <ul>
                <li>Redirect - if not logged in will redirect to login page</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">set_privilege($group)
</code></pre>

    <ul>
        <li><strong>Parameter</strong>
            <ul>
                <li>$group(Integer) - id groups or groups name</li>
            </ul>
        </li>
        <li><strong>Return type</strong>
            <ul>
                <li>Redirect - if groups not exists redirect to login or home page</li>
            </ul>
        </li>
    </ul>
<pre><code class="html">set_assets($path, $base = false, $type)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$path(String|Array) - url of assets js/css</li>
				<li>$base(Boolean) - true include base_url() default false</li>
				<li>$type(String) - styles for css files, scripts for js files</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Void</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">get_assets($type)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$type(String) - styles for css files, scripts for js files</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>String</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">set_wrapper($name, $view, $data = null, $wrap_script = true)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$name(String) - Name of wrapper</li>
				<li>$view(String) - String url view partial page</li>
				<li>$data(String|Array) - Data parse to view partial page</li>
				<li>$wrap_script(Boolean) - true move script in view page to bottom of body, default true</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Void</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">get_wrapper($name)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$name(String) - Name of wrapper</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>View page</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">output($template, $data = null)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$template(String) - String url of template page view</li>
				<li>$data(String|Array) - Data parse to template page view</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>View full page</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">get_menu($type = 'side menu')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$type(String) - Name of type menu default 'side menu'</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Array - list of menu</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">breadcrumb($crumb, $homecrumb = null)
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$crumb(Array) - List of crumb menu</li>
				<li>$homecrumb(Array) - First breadcrumb default null</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>String - List breadcrumb</li>
			</ul>
		</li>
	</ul>
<br>
<h3>Core</h3>
<h4>MY_Model</h4>
<p>Location : <strong>application/core/MY_Model.php</strong></p>
<pre><code class="html">save($data, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$data(Array) - Data each field</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Integer - row affected</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">search($conditions = null, $limit = 500, $offset = 0, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$conditions(String|Array) - Condition want to search</li>
				<li>$limit(Integer) - Number of limit default 500</li>
				<li>$offset(Integer) - Start offset default 0</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Array</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">single($conditions, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$conditions(String|Array) - Condition want to show</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Array</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">update($data, $conditions, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$data(String) - Field data want to change</li>
				<li>$conditions(String|Array) - Condition data want to update</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Integer - Affected rows</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">delete($conditions, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$conditions(String|Array) - Condition data want to delete</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Integer - Affected rows</li>
			</ul>
		</li>
	</ul>
<pre><code class="html">count($conditions = null, $tablename = '')
</code></pre>

	<ul>
		<li><strong>Parameter</strong>
			<ul>
				<li>$conditions(String|Array) - Condition data want to count</li>
				<li>$tablename(String) - Table name default empty</li>
			</ul>
		</li>
		<li><strong>Return type</strong>
			<ul>
				<li>Integer - Number rows</li>
			</ul>
		</li>
	</ul>
<h2>Examples</h2>
<h4>Controllers</h4>
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

    /**
     * Backend Hello World page.
     */
    public function backend()
    {
        $this->output_view->auth(); // Login required

        $this->load->model('bookModel');
        $data['book'] = $this->bookModel->search();
        $data['helloWorld'] = 'Hello World';

        $template_data['judul'] = 'Hellow World'; // Data send to template
        $template_data['crumb'] = [
            'Hellow World' => '',
        ];

        $this->output_view->set_wrapper('page', 'hello_world', $data); // Set wrapper page
        $this->output_view->output($this->admin_template, $template_data); // Output
    }

    /**
     * Backend CRUD Book Page.
     */
    public function crud()
    {
        $this->output_view->auth(); // Login required

        $crud = new grocery_CRUD(); // Load library grocery CRUD

        $crud->set_table('book');
        $crud->set_subject('book');

        $data = (array) $crud->render();

        $template_data['grocery_css'] = $data['css_files'];
        $template_data['grocery_js'] = $data['js_files'];
        $template_data['judul'] = 'CRUD';
        $template_data['crumb'] = [
            'CRUD' => '',
        ];

        $this->output_view->set_wrapper('page', 'grocery', $data, false);
        $this->output_view->output($this->admin_template, $template_data);
    }
}
</code></pre>

<h4>Model</h4>
<pre><code class="html">&lt;?php

defined('BASEPATH') or exit('No direct script access allowed');

class BookModel extends MY_Model
{
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'book'; // Table name
    }
}
</code></pre>
<script>hljs.initHighlightingOnLoad();</script>
