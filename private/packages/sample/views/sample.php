{{{view.base_header}}}
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Keys</th>
				<th>Value</th>
			</tr>
		</thead>
    {{#all_samples}}
        <tr>
	        <td>{{field}}</td>
	        <td>{{value}}</td>
        </tr>
    {{/all_samples}}
    </table>
{{{view.base_footer}}}