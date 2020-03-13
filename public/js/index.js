function addTask(text, notes, colomn, id, userAdd, userDo) {
    var colomn = document.getElementById(colomn);
    var li = document.createElement('li');

    var task = document.createElement('div');
    var notesDiv = document.createElement('div');
    var userAddDiv = document.createElement('div');
    var userDoDiv = document.createElement('div');
    var del = document.createElement('BUTTON');
    li.setAttribute("id", id);
    li.setAttribute('class', 'task');
    del.setAttribute('class', 'del');
    del.innerHTML = 'x';
    task.innerHTML = text;
    notesDiv.innerHTML = notes;
    userAddDiv.innerHTML = userAdd;
    userDoDiv.innerHTML = userDo;
    li.appendChild(task);
    li.appendChild(notesDiv);
    li.appendChild(userAddDiv);
    li.appendChild(userDoDiv);
    li.appendChild(del);
    colomn.appendChild(li);
}

function showTasks(tasks) {
    tasks.forEach(function(task) {
        if (task.status == 1) {
            var colomn = 'colomn1';
        } else if (task.status == 2) {
            var colomn = 'colomn2';
        } else {
            var colomn = 'colomn3';
        }
        var id = 'task-' + task.id;
        addTask(task.task, task.notes, colomn, id, task.userAdd, task.userDo);
    });
}

function addOption(value, id) {
    var element = document.getElementById("select-user");
    var option = document.createElement('option');
    option.setAttribute("value", id);
    option.setAttribute("id", "option-"+id);
    option.innerHTML = value;
    element.appendChild(option);
}

function listUsers(users) {
    users.forEach(function(user) {
        addOption(user.name, user.id);      
    });
 
}

function loadUser(){
    $.ajax({
        url: 'user/show',
        success: function(data) {
            listUsers(JSON.parse(data))
        }
    });
}

function loadState() {
    $.ajax({
        url: 'task/show',
        success: function(data) {
            showTasks(JSON.parse(data))
        }
    }); 
}

function sort(data) {
    $.ajax({
        type: 'POST',
        url: 'task/changePriority',
        data: data
    });
}

$(function() {
    
    $(".js-form").on('submit', function(event) {
        event.preventDefault();

        var msg = $(event.target).serialize();

        $.ajax({
            type: 'POST',
            url: 'task/add',
            data: msg,
            success: function(data) {
                data = JSON.parse(data);
                var value = document.getElementById('new-task').value;
                addTask(value, data.note, 'colomn1', 'task-'+data.id, data.userAdd, data.userDo);
                event.target.reset();
            }
        });
    });

    $(".list").on('click','.del', function(event) {
        event.preventDefault();

        var id = $(this).closest('li').attr('id');
        var idDb = id.substring(5);
        $.ajax({
            type: 'POST',
            url: 'task/del',
            data: { id: idDb},
            success: function(data) {
                document.getElementById(id).remove();

            }
        });
    });

    $("#colomn1,#colomn2,#colomn3").sortable({
        connectWith:'#colomn1,#colomn2, #colomn3',
        update:function(event,ui) {
            var data = [colomn1 => $("#colomn1").sortable('serialize'),
                        colomn2 => $("#colomn2").sortable('serialize'),
                        colomn3 => $("#colomn3").sortable('serialise'), 
            ];
            // sort(data);
        }
    });

    loadState();

    loadUser();
});