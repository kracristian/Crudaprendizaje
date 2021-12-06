$(function(){
    let edit = false;
    $('#task-result').hide();
    fetchTasks();

    /**
     * Formulario creación tarea
     */
    $('#task-form').submit(function(e){
        e.preventDefault(); 
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            id: $('#taskId').val()
        };

        var pathUrl = 'http://localhost/crud/Welcome/add' // 'task-add.php'
        $.post(pathUrl, postData, function(response) {
            response2 = JSON.parse(response);
            alert(response2.message);
            if(response2.status == '200'){
                $('#task-form').trigger('reset');
                fetchTasks();
            } else {

            }
        });
    });
/**
     * Listado filtrar por tarea
     */
    $('#search').keyup(function(){
        let search = $('#search').val();
        getTasks(search);
    });
/**
     * Listado mostrar tareas
     */
    function fetchTasks(){
        getTasks('');
    }
/**
     * unión entre busquedas de tarea y tarea filtrada.
     */
    function getTasks(search){
        $.ajax({
            url: 'http://localhost/crud/Welcome/searsh',
            type: 'POST',
            data: {search},
            success: function(response){
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                    template += `
                    <tr taskId="${task.id}">
                        <td>${task.id}</td>
                        <td>${task.name}</td>
                        <td>${task.description}</td>
                        <td>
                            <button class="tasks-delete btn btn-danger">
                            eliminar
                            </button>
                            <button class="task-item btn btn-danger" data-toggle="modal" data-target="#modal_edit">
                            Modificar
                            </button>
                        </td>
                    </tr>
                    `
                });
                $('#tasks').html(template);
                $('#task-result').show();
            }
        });
    }
/**
     * Eliminar tarea
     */
    $(document).on('click', '.tasks-delete', function(){
        if(confirm("¿seguro que quieres eliminar?")){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');
            $.post('http://localhost/crud/Welcome/delete', {id}, function (response) {
                var resp = JSON.parse(response);
                alert(resp.message);
                fetchTasks();
            });
        }
    })
    /**
     * Modificar tarea
     */
    $('#taskEdit').submit(function(e){
        e.preventDefault();
        var formdata = $(this).serialize();
             
        $.post('http://localhost/crud/Welcome/modify', formdata, function(response) {
            var task = JSON.parse(response);
           
            if(task.status == '400'){
                alert(task.message); 
            }else{
                fetchTasks();//actualizar fomulario
                $('#modal_edit').modal('hide');   //actualizar página
                alert(task.message); 
        }         
        });        
    });
});