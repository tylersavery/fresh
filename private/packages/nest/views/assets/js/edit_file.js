$(document).ready(function() {
	$('.edit').click(function() {
		loadFile($(this).attr('path'));
	});
	$('.save').click(function() {
		saveFile($(this).attr('path'), editor.getSession().getDocument().getAllLines(), '.save');
	});
	$('.delete').click(function() {
		deleteFile($(this).attr('path'));
	});

    var ctrlDown = false;

    $(document).keydown(function(e) {
        if (e.keyCode == 17) console.log('down'); ctrlDown = true;
    }).keyup(function(e) {
        if (e.keyCode == 17) console.log('up'); ctrlDown = false;
    });

    $('body').keydown(function(e) {
        if (ctrlDown && (e.keyCode == 83)) {
        	$('.save').trigger('click');
        	return false;
        }
    });
});

function loadFile(path) {

	window.location.hash = path;
	
	$('#path_crumb li').remove()
	$('#path_crumb').append('<li><b>Editing File:</b> ' + path.replace(/\\/g, ' / ') + ' <span class="divider">');
	$('#ide_area .save').attr('path', path);
	$('#ide_area .delete').attr('path', path);

	$('#editor').width($('#ide_area').width());
	$('#editor').height($(window).height() - 140);
	$('.mvc_data').height($(window).height() - 130);

	$.ajax({
		url: '/nest/packages/get/file',
		dataType: 'html',
		type: 'GET',
		data: 'path=' + path,
		success: function(html) {
			editor.getSession().setValue(html);
			var PHPMode = require("ace/mode/php").Mode;
		    editor.getSession().setMode(new PHPMode());
		}
	});
}

function saveFile(path, data, button) {
	$.ajax({
		url: '/nest/packages/save/file',
		dataType: 'json',
		type: 'POST',
		data: { 'path' : path, 'data' : data },
		success: function(response) {
			if (response.result == 'success') {
				$(button).addClass('btn-success');
				$(button).html('Saved...');
				setTimeout('$("' + button + '").removeClass("btn-success"); $("' + button + '").html("Save");', 500);
			}
		}
	});
}

function deleteFile(path) {
	var answer = confirm("Are you sure you want to delete this file? It looks important.")
	if (answer) {
		$.ajax({
			url: '/nest/packages/delete/file',
			dataType: 'json',
			type: 'GET',
			data: { 'path' : path },
			success: function(response) {
				if (response.result == 'success') {
					alert("Alrighty then...it's deleted.");
					reloadPage();
				} else {
					alert("There was an error deleting!");
				}
			}
		});
	} else {
		alert('I didn\'t delete the file. Phew.');
	}
}

function reloadPage() {
	window.location.hash = '#';
	window.location.reload(true);
}