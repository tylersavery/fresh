{{{view.base_header}}}
<div class="container-fluid">
	<h2>Create {{name}}</h2>
	{{#create_success}}
	<div class="alert alert-success">Your {{name}} was successfully created.</div>
	{{/create_success}}
	<form method="POST">
		<table class="table table-bordered table-striped">
		{{#columns}}
		    <tr>
		    	<td>{{name}}</td>
		    	<td><input type="text" name="fields[{{real_name}}]"></td>
		    </tr>
		{{/columns}}
		</table>
		<input class="btn" type="submit" name="create" value="Create">
	</form>
</div>
{{{view.base_footer}}}