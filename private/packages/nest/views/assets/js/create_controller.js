$(document).ready(function() {
    $('.nest_create_controller').live('click', function() {
        $('body').append("<div id='create_controller_modal' class='modal fade'>\
            <div class='modal-header'>\
                <a class='close' data-dismiss='modal'>-</a>\
                <h3>Create New Controller</h3>\
            </div>\
            <div class='modal-body'>\
                <form id='create_controller'>\
                    <input type='hidden' name='package_id'>\
                    <table class='table table-bordered'>\
                      <tbody>\
                        <tr>\
                          <td>Controller Name:</td>\
                          <td colspan='2'><input name='controller_name' type='text'></td>\
                        </tr>\
                        <tr>\
                          <td>Controller Type:</td>\
                          <td colspan='2'>\
                            <select name='type'>\
                              <option value='Base'>Controller</option>\
                              <option value='Ajax'>Ajax Controller</option>\
                              <option value='Scaffold'>Scaffold Controller</option>\
                            </select>\
                          </td>\
                        </tr>\
                      </tbody>\
                    </table>\
                </form>\
            </div>\
            <div class='modal-footer'>\
                <a href='#' id='generate' class='btn btn-primary'>Generate Controller</a>\
            </div>\
        </div>");
        $('#create_controller input[name="package_id"]').val($(this).attr('package'));
        $('#create_controller_modal').modal();
        $('#generate').click(function() {
            if ($('input[name="controller_name"]').val() == '') {
                return alert('Enter controller name');
            }
            $.ajax({
                url: '/nest/packages/create_controller',
                dataType: 'json',
                type: 'POST',
                data: $('#create_controller_modal form').serialize(),
                success: function(result) {
                    if (result.response == 'success') {
                       $('#create_controller_modal').modal('hide');
                        $('#create_controller_modal').remove();
                        if (typeof loadFile == 'function') {
                            loadFile(result.path);
                        } else {
                            alert('Controller was successfully generated.');
                        }
                    } else {
                        alert('That controller already exists.');
                    }
                }
            });
        });
    });
});