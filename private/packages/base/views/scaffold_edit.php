{{{view.base_header}}}
<div class="container-fluid">
	<h2>Edit {{name}}</h2>
	{{#edit_success}}
	<div class="alert alert-success">Record was successfully edited.</div>
	{{/edit_success}}
	<form method="POST">
		<table class="table table-bordered table-striped">
		{{#columns}}
		    <tr>
		    	<td>{{name}}</td>
		    	<td><input type="text" name="fields[{{real_name}}]" value="{{value}}"></td>
		    </tr>
		{{/columns}}
		</table>
		<input type="submit" name="edit" value="Edit" class="btn">
	</form>
</div>
{{{view.base_footer}}}