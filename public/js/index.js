function addTask(value, colomn, id='') {
    var colomn = document.getElementById(colomn);
    var li = document.createElement('LI');
    li.setAttribute("id", id);
    li.innerHTML = value;
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
        var value = task.task;
        var id = 'task-' + task.id;
        addTask(value, colomn, id);
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

$(function() {
    
    $(".js-form").on('submit', function(event) {
        event.preventDefault();

        var msg = $(event.target).serialize();

        $.ajax({
            type: 'POST',
            url: 'task/add',
            data: msg,
            success: function(data) {
                var value = document.getElementById('new-task').value;
                addTask(value, 'colomn1', 'task-'+data.id);
                event.target.reset();
            }
        });
    });

    loadState();
});