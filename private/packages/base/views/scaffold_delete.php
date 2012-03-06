{{{view.base_header}}}
<div class="container-fluid">
	<h2>Delete {{name}}</h2>
	{{#delete_success}}
	<div class="alert alert-success">Your record was successfully deleted.</div>
	{{/delete_success}}
</div>
{{{view.base_footer}}}