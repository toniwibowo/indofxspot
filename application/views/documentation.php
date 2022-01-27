<div class="box box-solid">
	<div class="box-header with-border">
		<i class="fa fa-book"></i>
		<h3 class="box-title">myIgniter - Documentation</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<div class="page-header">
		  <h3>What is myIgniter?</h3>
		</div>
		<p>
		myIgniter is a custom PHP framework for web developer. Combined between Codeigniter 3 with AdminLTE, and Bootstrap, include auto PHP GroceryCRUD for create table with Create-Read-Update-Delete and Ion authentication system.
		</p>

		<div class="page-header">
		  <h3>Feature</h3>
		</div>
		<ul>
			<li>GroceryCRUD with Bootstrap 3 Theme.</li>
			<li>GroceryCRUD with new DataTables Plugins.</li>
			<li>Improve performance of GroceryCRUD.</li>
			<li>No template engine make it simple.</li>
			<li>RESTful server.</li>
			<li>Integerate Codeigniter with AdminLTE.</li>
			<li>Integerate IonAuth with GroceryCRUD.</li>
			<li>Additional Snippets for Sublime Text 2/3.</li>
			<li>Datatables option in Controller.</li>
			<li>Load css/javascript in Controller.</li>
		</ul>

		<div class="page-header">
		  <h3>Installation</h3>
		</div>
		<ul>
			<li>Extract myIgniter.zip in your server.</li>
			<li>Setting database.php with your databse server.</li>
			<li>Import base.sql.</li>
			<li>Import examples.sql (<i>optional</i>).</li>
		</ul>

		<div class="page-header">
		  <h3>Documentation</h3>
		</div>
		<ul>
			<li>Codeigniter : <a href="http://www.codeigniter.com/userguide3">CI : User Guide 3/</a></li>
			<li>GroceryCRUD : <a href="http://www.grocerycrud.com/documentation/options_functions/">GroceryCRUD: API and Functions list</a></li>
			<li>IonAuth     : <a href="http://benedmunds.com/ion_auth/">IonAuth documentation/</a></li>
			<li>AdminLTE    : <a href="https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html">AdminLTE documentation</a></li>
			<li>RESTful Server    : <a href="http://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter-2--net-8814">NetTuts: Working with RESTful Services in CodeIgniter</a></li>			
		</ul>
		<br>
		<h4>myIgniter</h4>
		<pre>$this->load->library('output_view');</pre>
		<p>load library template</p>
		
		<pre>$this->output_view->auth();
		$this->output_view->output($template)</pre>		
		<p>view template admin command snippets "o-admin" for front template snippets "o-front"</p>
		<p>
			<code>$view</code> - load view in wrapper template, view template called <code>$page</code><br>
			<code>$template</code> - load template in folder view/template <br>
			<code>$data</code> - for data parsing <br>
			<code>$output</code> - grocery CRUD output (optional) <br>
		</p>

		<pre>$data['script_datatables'] = 'paging: false, bInfo: false';</pre>
		<p>Option datatables see documention <a href="https://datatables.net/reference/option/">https://datatables.net/reference/option/</a></p>

		<pre>$data['script_grocery'] = "$('table').append('<tfoot></tfoot>')";</pre> 
		<p>javascript after render datatables</p>

		<pre>$data['script'] = "alert('hello')"; </pre>
		<p>javascript in controller</p>

		<pre>$data['css_plugins'] = array(
		'assets/plugins/iCheck/skins/square/blue.css',
		'assets/plugins/chosen/chosen.css'
		);</pre>
		<p>Load CSS in controller</p>

		<pre>$data['js_plugins']  = array(
		'assets/plugins/jquery.inputmask/dist/inputmask/jquery.inputmask.js',
		'assets/plugins/jquery.inputmask/dist/inputmask/jquery.inputmask.date.extensions.js',
		'assets/plugins/jquery.inputmask/dist/inputmask/jquery.inputmask.extensions.js',
		'assets/plugins/iCheck/icheck.min.js',
		'assets/plugins/chosen/chosen.jquery.min.js'
		);</pre>
		<p>Load javacsript in controller</p>

		<h4>GroceryCRUD Snippets for Sublime text 2/3</h4>
		<p>Installation</p>
		<ol>
			<li><a href="https://sublime.wbond.net/installation" title="Install Package Control">Install Package Control</a></li>
			<li>Install Grocery Crud Snippets my​Igniter <br>
				<b>Platform	Install Command</b><br>
				Mac	cmd+shift+p   → Package Control: Install Package → Grocery Crud Snippets my​Igniter<br>
				Linux	ctrl+shift+p → Package Control: Install Package → Grocery Crud Snippets my​Igniter<br>
				Windows	ctrl+shift+p → Package Control: Install Package → Grocery Crud Snippets my​Igniter<br>
			</li>
		</ol>	
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Command</th>
					<th>Desc</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>o-admin</td>
					<td>Output view for output admin page</td>
				</tr>
				<tr>
					<td>o-front</td>
					<td>Output view for output front page</td>
				</tr>
				<tr>
					<td>g-{function name in groceryCRUD}</td>
					<td>GroceryCRUD <a href="http://www.grocerycrud.com/documentation/options_functions/">API and Functions list</a></td>
				</tr>
			</tbody>
		</table>
		<div class="page-header">
		  <h3>Examples</h3>
		</div>
		<p>groceryCRUD examples controller : <code>Examples.php</code></p>
		<p>RESTful server examples controller : <code>Api.php</code></p>
	</div><!-- /.box-body -->
</div>
<!-- /.End Documentation -->