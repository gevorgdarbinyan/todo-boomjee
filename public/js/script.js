$(document).ready(function(){
    $(document).on('click','.save-task', function(){
        var formData = $('#task-form').serializeArray();
        var id = Number($('#hidden-id').val());
        var adminLogged;
        if($('.admin-logged-flag-class').length > 0) {
            adminLogged = $('.admin-logged-flag-class').val();
        }else{
            adminLogged = 0;
        }
        if($('#task').val() == ''){
            alert('Please fill the task');
            return false;
        }
        var email = $('#email').val();
        if(!validateEmail(email)){
            alert("Please fill valid email");
            return false;
        }
        $.ajax({
            type: "POST",
            url: 'index.php?home/save-task',
            data:{
                form_data: formData
            },
            success: function(result){
                var data = JSON.parse(result);
                if(data){
                    if(id > 0){
                        $('#tr-'+id).find('td:nth-child(2)').html(data['username']);
                        $('#tr-'+id).find('td:nth-child(3)').html(data['email']);
                        $('#tr-'+id).find('td:nth-child(4)').html(data['task']);
                    }else{
                        str = '<tr id="tr-'+data['id']+'">';
                            str += '<td>'+data['id']+'</td>';
                            str += '<td>'+data['username']+'</td>';
                            str += '<td>'+data['email']+'</td>';
                            str += '<td>'+data['task']+'</td>';
                            if( adminLogged == 1){
                                str += '<td>'+data['status']+'</td>';
                                str += '<td>';
                                    str += '<span class="fa fa-remove remove-task" title="Remove task" style="cursor:pointer;"></span>';
                                    str += '<span class="fa fa-edit edit-task" title="Edit task" style="cursor:pointer;"></span>';
                                str += '</td>';
                            }else{
                                str += '<td><span class="badge badge-info">New</span></td>';
                            }
                        str += '</tr>';
                        $('#task-table tr:nth-child(1)').after(str);
                    }
                    $('#tr-'+id).addClass('table-success');
                    $('#task-form')[0].reset();
                }
            }
        });
        return false;
    });

    $(document).on('click','.edit-task', function(){
        var me = $(this);
        var id = Number(me.closest('tr').find('td:nth-child(1)').html());
        var username = me.closest('tr').find('td:nth-child(2)').html();
        var email = me.closest('tr').find('td:nth-child(3)').html();
        var task = me.closest('tr').find('td:nth-child(4)').html();
        $('#username').val(username);
        $('#email').val(email);
        $('#task').val(task);
        $('#hidden-id').val(id);
    });
    
    $(document).on('click','.status-checkbox', function(){
        var me = $(this);
        var id = Number(me.closest('tr').find('td:nth-child(1)').html());
        var status = (me.is(':checked')) ? 'completed' : 'new';
        if(confirm('Are you sure?')) {
            $.ajax({
                type: "POST",
                url: 'index.php?home/complete-task',
                data:{
                    id: id,
                    status: status
                },
                success: function(data){
                    if(data){
                    alert('Status changed!');
                    }
                }
            });
        }
    });

    $(document).on('click','.remove-task', function(){
        var me = $(this);
        var id = Number(me.closest('tr').find('td:nth-child(1)').html());
        if(confirm('Are you sure to remove the task?')) {
            $.ajax({
                type: "POST",
                url: 'index.php?home/remove-task',
                data:{
                    id: id
                },
                success: function(data){
                    console.log(data);
                    if(data){
                        me.closest('tr').remove();
                    }
                }
            });
        }
    });

    var table = $('#task-table');
    
    $('#user-header, #email-header, #status-header')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            th.click(function(){
                table.find('td').filter(function(){
                    return $(this).index() === thIndex;
                }).sortElements(function(a, b){
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                }, function(){
                    // parentNode is the element we want to move
                    return this.parentNode; 
                });
                inverse = !inverse;
            });
    });
});

function validateEmail(email) {
  var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
  return re.test(email);
}