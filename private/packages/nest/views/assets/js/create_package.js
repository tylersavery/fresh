$(document).ready(function() {
    $('.nest_create_package').live('click', function() {
        $('body').append("<div id='create_package_modal' class='modal fade'>\
            <div class='modal-header'>\
                <a class='close' data-dismiss='modal'>-</a>\
                <h3>Create New Package</h3>\
            </div>\
            <div class='modal-body'>\
                <form id='create_package'>\
                    <table class='table table-bordered'>\
                      <tbody>\
                        <tr>\
                          <td>Package Name:</td>\
                          <td colspan='2'><input name='package_name' type='text'></td>\
                        </tr>\
                        <tr>\
                          <td>Package Id:</td>\
                          <td colspan='2'><input name='package_id' type='text'></td>\
                        </tr>\
                        <tr>\
                          <td>Version:</td>\
                          <td colspan='2'><input name='version' type='text' value='1.0'></td>\
                        </tr>\
                        <tr>\
                          <td>Author:</td>\
                          <td colspan='2'><input name='author' type='text' value=''></td>\
                        </tr>\
                        <tr>\
                          <td>Description:</td>\
                          <td colspan='2'><textarea name='description'></textarea></td>\
                        </tr>\
                      </tbody>\
                    </table>\
                </form>\
            </div>\
            <div class='modal-footer'>\
                <a href='#' id='generate' class='btn btn-primary'>Generate Package</a>\
            </div>\
        </div>");
        $('#create_package_modal').modal();
        $('#generate').click(function() {
            if ($('input[name="package_name"]').val() == '') {
                return alert('Enter package name');
            }
            if ($('input[name="package_id"]').val() == '') {
                return alert('Enter the package ID');
            }
            if ($('input[name="version"]').val() == '') {
                return alert('Enter the package version');
            }
            if ($('input[name="author"]').val() == '') {
                return alert('Enter author of the packages name');
            }
            $.ajax({
                url: '/nest/packages/create_package',
                dataType: 'json',
                type: 'POST',
                data: $('#create_package_modal form').serialize(),
                success: function(result) {
                    if (result.response == 'success') {
                       $('#create_package_modal').modal('hide');
                        $('#create_package_modal').remove();
                        alert('Package was successfully generated.');
                    } else {
                        alert('That package already exists.');
                    }
                }
            });
        });
    });
});