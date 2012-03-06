$(document).ready(function() {
    $('.nest_create_model').live('click', function() {
        $('body').append("<div id='create_model_modal' class='modal fade'>\
            <div class='modal-header'>\
                <a class='close' data-dismiss='modal'>-</a>\
                <h3>Create New Model</h3>\
            </div>\
            <div class='modal-body'>\
                <form id='create_model'>\
                    <input type='hidden' name='package_id'>\
                    <table class='table table-bordered'>\
                      <tbody>\
                        <tr>\
                          <td>Model Name:</td>\
                          <td colspan='2'><input name='model_name' type='text'></td>\
                        </tr>\
                        <tr>\
                          <td>Database Table Name:</td>\
                          <td colspan='2'><input name='table_name' type='text'></td>\
                        </tr>\
                        <tr>\
                          <td>Primary Key:</td>\
                          <td colspan='2'><input name='primary_key' type='text' value='id'></td>\
                        </tr>\
                      </tbody>\
                    </table>\
                </form>\
            </div>\
            <div class='modal-footer'>\
                <a href='#' id='generate' class='btn btn-primary'>Generate Model</a>\
            </div>\
        </div>");
        $('#create_model input[name="package_id"]').val($(this).attr('package'));
        $('#create_model_modal').modal();
        $('#generate').click(function() {
            if ($('input[name="model_name"]').val() == '') {
                return alert('Enter the model name');
            }
            if ($('input[name="table_name"]').val() == '') {
                return alert('Enter the related table name');
            }
            if ($('input[name="primary_key"]').val() == '') {
                return alert('Enter the primary key');
            }
            $.ajax({
                url: '/nest/packages/create_model',
                dataType: 'json',
                type: 'POST',
                data: $('#create_model_modal form').serialize(),
                success: function(result) {
                    if (result.response == 'success') {
                       $('#create_model_modal').modal('hide');
                        $('#create_model_modal').remove();
                        if (typeof loadFile == 'function') {
                            loadFile(result.path);
                        } else {
                            alert('Model was successfully generated.');
                        }
                    } else {
                        alert('That model already exists.');
                    }
                }
            });
        });
    });
});