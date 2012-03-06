$(document).ready(function() {
    $('.nest_create_view').live('click', function() {
        $('body').append("<div id='create_view_modal' class='modal fade'>\
            <div class='modal-header'>\
                <a class='close' data-dismiss='modal'>-</a>\
                <h3>Create New View</h3>\
            </div>\
            <div class='modal-body'>\
                <form id='create_model'>\
                    <input type='hidden' name='package_id'>\
                    <table class='table table-bordered'>\
                      <tbody>\
                        <tr>\
                          <td>View Name:</td>\
                          <td colspan='2'><input name='view_name' type='text'></td>\
                        </tr>\
                      </tbody>\
                    </table>\
                </form>\
            </div>\
            <div class='modal-footer'>\
                <a href='#' id='generate' class='btn btn-primary'>Generate View</a>\
            </div>\
        </div>");
        $('#create_model input[name="package_id"]').val($(this).attr('package'));
        $('#create_view_modal').modal();
        $('#generate').click(function() {
            if ($('input[name="view_name"]').val() == '') {
                return alert('Enter the view name');
            }
            $.ajax({
                url: '/nest/packages/create_view',
                dataType: 'json',
                type: 'POST',
                data: $('#create_view_modal form').serialize(),
                success: function(result) {
                    if (result.response == 'success') {
                        $('#create_view_modal').modal('hide');
                        $('#create_view_modal').remove();
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