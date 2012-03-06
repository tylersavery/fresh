{{{view.nest_header}}}
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span3">
			<h2>Editing {{package}} Package</h2>
			<div class="mvc_data">
				<h4>Models</h4>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th width="135">Option</th>
						</tr>
					</thead>
					<tbody>
					    {{#models}}
						<tr>
							<td>{{name}}</td>
							<td class="btn-group">
								<button class="btn delete" path="{{path}}">Delete</button>
								<a class="btn edit" path="{{path}}">Edit</a>
								<a class="btn btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a class="edit" path="{{path}}">Edit File</a></li>
									<li><a href="/nest/model_editor?path={{path}}">Model Editor</a></li>
								</ul>
							</td>
						</tr>
						{{/models}}
						<tr>
							<td colspan="3">
							    <button class="btn nest_create_model" package="{{uri.package}}">Create New Model</button>
							</td>
						</tr>
					</tbody>
				</table>
				<h4>Controllers</h4>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Controller Name</th>
							<th width="110">Option</th>
						</tr>
					</thead>
					<tbody>
						{{#controllers}}
						<tr>
							<td>{{name}}</td>
							<td class="btn-group">
								<button class="btn delete" path="{{path}}">Delete</button>
								<button class="btn edit" path="{{path}}">Edit</button>
							</td>
						</tr>
						{{/controllers}}
						<tr>
							<td colspan="3">
								<button class="btn nest_create_controller" package="{{uri.package}}">Create New Controller</button>
							</td>
						</tr>
					</tbody>
				</table>
				<h4>Views</h4>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>View Name</th>
							<th width="110">Option</th>
						</tr>
					</thead>
					<tbody>
						{{#views}}
						<tr>
							<td>{{name}}</td>
							<td class="btn-group">
								<button class="btn delete" path="{{path}}">Delete</button>
								<button class="btn edit" path="{{path}}">Edit</button>
							</td>
						</tr>
						{{/views}}
						<tr>
							<td colspan="3">
								<button class="btn nest_create_view" path="{{path}}" package="{{uri.package}}">Create New View</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="span8" id="ide_area">
			<div class="row-fluid ide_header">
				<span class="span10">
					<ul id="path_crumb" class="breadcrumb">
						<li>
							<span class="divider">/</span>
						</li>
					</ul>
				</span>
				<span class="span2 btn-group">
					<button class="btn save">Save</button>
					<button class="btn delete">Delete</button>
				</span>
			</div>
			<div id="editor">Loading Nest development environment...</div>
			<script type="text/javascript">
				var editor = null;
				$(document).ready(function() {
					editor = ace.edit("editor");
					if (window.location.hash && window.location.hash != '#') {
						loadFile(window.location.hash.replace('#', ''));
					} else {
						loadFile('{{package_path}}');
					}
				});

			</script>
		</div>
		<div class="span1"></div>
	</div>
{{{view.nest_footer}}}