{{{view.base_header}}}
<div class="container-fluid">
	<h2>View {{name}}</h2>
	<table class="table table-bordered table-striped">
	{{#columns}}
	    <tr>
	    	<td>{{name}}</td>
	    	<td>{{value}}</td>
	    </tr>
	{{/columns}}
	</table>
</div>
{{{view.base_footer}}}