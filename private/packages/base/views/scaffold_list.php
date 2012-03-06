{{{view.base_header}}}
<div class="container-fluid">
	<h2>List {{name}}</h2>
	<div class="btn-toolbar">
		<div class="btn-group">
			{{{pages}}}
		</div>
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				{{#columns}}
					<th>{{name}}</th>
				{{/columns}}
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		{{#rows}}
		    <tr>
		    	{{#columns}}
		    		<td>
		    			{{#is.id}}#{{/is.id}}
		    			{{value}}
		    		</td>
		    	{{/columns}}
	    		<td style="width:150px; text-align: center;" class="btn-group">
	    		    <a class="btn" href="edit/?{{primary_key}}={{id}}">Edit</a>&nbsp;<a class="btn btn-danger" href="delete/?{{primary_key}}={{id}}">Delete</a>
	    		</td>
		    </tr>
		{{/rows}}
		{{#empty}}
			<tr>
				<td colspan="999" style="text-align: center; padding: 50px">There is no data available at this time.</td>
			</tr>
		{{/empty}}
		</tbody>
	</table>
	<div class="btn-toolbar">
		<div class="btn-group">
			{{{pages}}}
		</div>
	</div>
</div>
{{{view.base_footer}}}