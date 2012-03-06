{{{view.nest_header}}}
	<div class="row-fluid">
	    <div class="span1"></div>
	    <div class="span3">
			<h2>Welcome to Nest!</h2>
			<p>Nest is used to modify your Pigeon instance. Happy coding from your friends at the Pigeon team.</p>
			<br>
			<h4>Pigeon Configuration</h4>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Configuration</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					{{#configurations}}
					<tr>
						<td>{{name}}</td>
						<td>{{value}}</td>
					</tr>
					{{/configurations}}
				</tbody>
			</table>
	    </div>
		<div class="span8">
			<h2>Current Packages</h2>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Package Name</th>
						<th>Version</th>
						<th>Author</th>
						<th>Route Rules</th>
						<th>Dependencies</th>
					</tr>
				</thead>
				{{#get_packages}}
					<tr>
						<td>
							<a href="/nest/packages/edit/{{package_name}}">{{name}}</a>
							<br>
							{{description}}
						</td>
						<td>{{version}}</td>
						<td>{{author}}</td>
						<td>{{route_count}} routes</td>
						<td>{{dependencies}}</td>
					</tr>
					<tr>
						<td colspan="5" class="btn-group">
							<a href="/nest/packages/edit/{{package_name}}" class="btn">Edit</a>
							<button class="btn nest_create_controller" package="{{package_name}}">New Controller</button>
							<button class="btn nest_create_model" package="{{package_name}}">New Model</button>
							<button class="btn nest_create_view" package="{{package_name}}">New View</button>
						</td>
					</tr>
				{{/get_packages}}
			</table>
			<a href="#labels" class="btn nest_create_package">Create New Package</a>
		</div>
		<div class="span1"></div>
	</div>
{{{view.nest_footer}}}