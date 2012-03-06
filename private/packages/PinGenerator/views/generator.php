{{{view.base_header}}}
	<br>
	<h1>Pin Generator</h1>
	<br>
	<form action="/generate" method="POST">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Options</th>
					<th>Values</th>
				</tr>
			</thead>
			<tbody>
		        <tr>
			        <td>Group Name</td>
			        <td><input type="text" name="group_name" value="{{fields.group_name}}"></td>
		        </tr>
		        <tr>
			        <td>Head Tag</td>
			        <td><input type="text" name="head_tag" value="{{fields.head_tag}}"></td>
		        </tr>
		        <tr>
			        <td>Digits</td>
			        <td><input type="text" name="digits" value="{{fields.digits}}"></td>
		        </tr>
		        <tr>
			        <td>Type</td>
			        <td>
			        	<select name="type">
			        		<option value="basic">Basic</option>
			        		<option value="alpha">Alphanumeric</option>
			        		<option value="numeric" selected="selected">Numeric</option>
			        		<option value="nonzero">Non Zero</option>
			        		<option value="md5">MD5</option>
			        		<option value="sha1">SHA1</option>
			        	</select>
			        </td>
		        </tr>
		        <tr>
			        <td>Number of Pins</td>
			        <td><input type="text" name="number_pins" value="{{fields.number_pins}}"></td>
		        </tr>
		        <tr>
			        <td>&nbsp;</td>
			        <td><button class="btn" name="submit">Generate</button></td>
		        </tr>
	    	</tbody>
	    </table>
	</form>
{{{view.base_footer}}}