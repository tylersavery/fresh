$(document).ready(function() {

    // Perform edit actions for the model
	$('.edit').live('click', function() {
        $.ajax({
            url: '/nest/get_field?field_name=' + $(this).attr('value') + '&model_name=' + $('#model_name').val(),
            type: 'POST',
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('input[name="field_name"]').val(response.name);
                $('select[name="field_type"]').val(response.type);
                $('input[name="length"]').val(response.length);
                $('input[name="default_value"]').val(response.default);

                $('.field_increment').removeClass('active');
                if (response.increment) {
                    $('.field_increment[value="yes"]').addClass('active');
                } else {
                    $('.field_increment[value="no"]').addClass('active');
                }

                $('.primary_key').removeClass('active');
                if (response.primary) {
                    $('.primary_key[value="yes"]').addClass('active');
                } else {
                    $('.primary_key[value="no"]').addClass('active');
                }


            }
        });
    });

    // Delete fields from the model
    $('.delete').live('click', function() {
        var answer = confirm('Are you absolutely sure you want to delete this field?')
        if (answer) {
            $.ajax({
                url: '/nest/delete_field?field_name=' + $(this).attr('value') + '&model_name=' + $('#model_name').val(),
                dataType: 'json',
                processData: false,
                success: function(response) {
                    if (response.result == 'success') {
                        window.location.reload();
                    } else {
                        alert('Couldn\'t delete the column, sorry.');
                    }
                }
            });
        } else {
            alert("Ok, I didn't delete anything! Phew.")
        }
    });

    // On changing of the field type, display certain messages
    $('select[name="field_type"]').change(function() {
		if ($(this).val() == 'ENUM') {
			$('#warning').html('List enumerated values with commas.');
		} else if ($(this).val() == 'DATETIME') {
		    if ($('input[name="defaut_value"]').val() == '') {
		    	$('input[name="defaut_value"]').val('CURRENT_TIMESTAMP()');
		    }
			$('#warning').html('');
		} else {
			$('#warning').html('');
		}
	});

    // Edit field details
    $('.nest_edit_field').live('click', function() {
    	
    	var data = $('#field_editor').serialize()
    	           + '&field_increment=' + $('.field_increment.active').val()
    	           + '&allow_null=' + $('.allow_null.active').val()
                   + '&primary_key=' + $('.primary_key.active').val()
    	           + '&attributes=' + $('.attributes.active').val();

    	if ($('input[name="field_name"]').val() == '') {
    		alert('You must enter a field name.');
    		return false;
    	}
    	if ($('input[name="display_name"]').val() == '') {
    		alert('You must enter a display name.');
    		return false;
    	}

    	$.ajax({
    		url: '/nest/edit_field',
    		data: data,
    		type: 'POST',
            processData: false,
    		dataType: 'json',
    		success: function(response) {
    			if (response.result == 'success') {
                    alert('Column was successfully updated.')
                    window.location.reload();
                } else {
                    alert(response.error);
                }
    		},
            error: function(error) {
                alert('There was an error creating that field.');
            }
    	});
    });
    
});