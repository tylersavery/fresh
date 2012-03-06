{{{view.nest_header}}}
<div class="row-fluid">
	<div class="span1">&nbsp;</div>
	<div class="span3">
		<h2>Modify Field</h2>
		<br>
		<form id="field_editor" onsubmit="return false">
			<input type="hidden" id="model_name" name="model_name" value="{{model_name}}">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th colspan="2">Database Settings</th>
					</tr>
					<tr>
						<td>Field Name</td>
						<td><input type="text" name="field_name"></td>
					</tr>
					<tr>
						<td>Type</td>
						<td>
							<select name="field_type">
								<option value="VARCHAR">VARCHAR</option>
								<option value="TINYINT">TINYINT</option>
								<option value="TEXT">TEXT</option>
								<option value="DATE">DATE</option>
								<option value="SMALLINT">SMALLINT</option>
								<option value="MEDIUMINT">MEDIUMINT</option>
								<option value="INT">INT</option>
								<option value="BIGINT">BIGINT</option>
								<option value="FLOAT">FLOAT</option>
								<option value="DOUBLE">DOUBLE</option>
								<option value="DECIMAL">DECIMAL</option>
								<option value="DATETIME">DATETIME</option>
								<option value="TIMESTAMP">TIMESTAMP</option>
								<option value="TIME">TIME</option>
								<option value="YEAR">YEAR</option>
								<option value="CHAR">CHAR</option>
								<option value="TINYBLOB">TINYBLOB</option>
								<option value="TINYTEXT">TINYTEXT</option>
								<option value="BLOB">BLOB</option>
								<option value="MEDIUMBLOB">MEDIUMBLOB</option>
								<option value="MEDIUMTEXT">MEDIUMTEXT</option>
								<option value="LONGBLOB">LONGBLOB</option>
								<option value="LONGTEXT">LONGTEXT</option>
								<option value="ENUM">ENUM</option>
								<option value="SET">SET</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Length</td>
						<td><input type="text" name="length"></td>
					</tr>
					<tr>
						<td>Default Value</td>
						<td>
							<input type="text" name="default_value">
							<span id="warning"></span>
						</td>
					</tr>
					<tr>
						<td>Primary Key</td>
						<td>
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn primary_key" value="yes">Yes</button>
								<button class="btn primary_key active" value="no">No</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>Increment</td>
						<td>
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn field_increment" value="yes">Yes</button>
								<button class="btn field_increment active" value="no">No</button>
							</div>
						</td>
					</tr>
					<tr>
						<td>Null Values</td>
						<td>
							<div class="btn-group" data-toggle="buttons-radio">
								<button class="btn allow_null" value="allow">Allow</button>
								<button class="btn allow_null active" value="disallow">Disallow</button>
							</div>
						</td>
					</tr>
					<tr>
						<th colspan="2">Field Settings</th>
					</tr>
					<tr>
						<td>Display Name</td>
						<td><input type="text" name="display_name"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><button class="btn nest_edit_field">Modify Field</button></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<div class="span7">
		<h2>{{model_real_name}} Model Editor</h2>
		<br>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Field Name</th>
					<th>Type</th>
					<th>Null</th>
					<th>Default</th>
					<th>Primary Key</th>
					<th>Increment</th>
					<th style="width: 110px">Options</th>
				</tr>
			</thead>
			<tbody>
				{{#columns}}
				<tr>
					<td>{{name}}</td>
					<td>{{type}} ({{length}})</td>
					<td>{{#null}}Allowed{{/null}}</td>
					<td>{{default}}</td>
					<td>{{#primary}}Primary{{/primary}}</td>
					<td>{{#increment}}Yes{{/increment}}</td>
					<td>
						<div class="btn-group">
							<button class="btn edit" value="{{name}}">Edit</button>
							<button class="btn delete" value="{{name}}">Delete</button>
						</div>
					</td>
				</tr>
				{{/columns}}
			</tbody>
		</table>
	</div>
	<div class="span1">&nbsp;</div>
</div>
{{{view.nest_footer}}}