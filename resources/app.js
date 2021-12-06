$(function(){
    let edit = false;
   
    console.log('jquery esta funcionando');
    $('#task-result').hide();

    fetchTasks();

 //---------------------------->Agregar<------------------------------------------------------------- 
    $('#task-form').submit(function(e){
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
            }
        });
        e.preventDefault(); 
    });


//------------------------------->search, no list<-------------------------------------------------------------
    $('#search').keyup(function(){
       if($('#search').val()){
        let search = $('#search').val();
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
              //  $('#task').html(template);
                $('#task-result').show();
            }
        });
       }
       else  if($('#search').val(null)){
        fetchTasks();
       }
    });

//----------------------------------->listar<-------------------------------------------------------------

    function fetchTasks(){
        $.ajax({
            url: 'http://localhost/crud/Welcome/list',
            //url: baseUrl.concat('listUsers'),
            type: 'GET',
            success: function (response) {
              //  console.log(response);
                let tasks = JSON.parse(response);
                let template= '';
                tasks.forEach(tasks =>{
                    template += `
                    <tr taskId="${tasks.id}">
                        <td>${tasks.id}</td>
                        <td>${tasks.name}</td>
                        <td>${tasks.description}</td>
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
            }
        }) 
    }

//------------------------------->Eliminar<-------------------------------------------------------------    
    $(document).on('click', '.tasks-delete', function(){
        if(confirm("¿seguro que quieres eliminar?")){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');
            $.post('http://localhost/crud/Welcome/delete', {id}, function (response) {
                fetchTasks();
            });
        }
    })

    
 //------------------------------->buscador Id - Modificar<-------------------------------------------------------------   
    $(document).on('click', '.task-item', function(){
        $('#modal_edit').modal('show');
        let element = $(this)[0].parentElement.parentElement;
        //console.log(element);
        var taskId = $(element).attr('taskId');
        
        $.post('http://localhost/crud/Welcome/modifyId', { id: taskId }, function(response){
            var task = JSON.parse(response);
            $('#taskId').val(task.id);
            $('#editname').val(task.name);
            $('#description_1').val(task.description);
           
            edit = true;
        })       
    });

//------------------------------->Modificar<-------------------------------------------------------------   
    $('#taskEdit').submit(function(e){
        e.preventDefault();
        var formdata = $(this).serialize();
       
        $.post('http://localhost/crud/Welcome/modify', formdata, function(response) {
            var task = JSON.parse(response);
            console.log(task);
            console.log(task.status);
            console.log(task.message);

            if(task.status == '400'){
                alert(task.message); 
                console.log('aquí 400');
            }else{
                //actualizar fomulario
                $('#modal_edit').modal('hide');   //actualizar página/cierra modal.
                alert(task.message); 
                console.log('aquí 200');
        }         
        });        
    });
});