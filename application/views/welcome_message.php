<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Tasks App</a>
            <ul class="navar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input type="search" id="search" class="form-control mr-sm-2"
                    placeholder="Search your Task">
                    <button class="btn btn-success my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </ul>
    </nav>

    <!-- Modal creación tarea -->
    <div class="container p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-vody">
                        <form id="task-form">
                            <div class="form-group">
                                <input type="text" id="name" placeholder="task Name" class="form-control" required minlength="4" maxlength="50">
                            </div>
                            <div class="form-group">
                                <textarea id="description" cols="30" rows="10" class="form-control" placeholder="task description" required minlength="1" maxlength="500"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-center">
                                save task 
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="md-7">
                <div class="card my-4" id="task-result">
                    <div class="card-body">
                        <ul id="container"></ul>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>description</td>
                        </tr>
                    </thead>
                    <tbody id="tasks"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- formulario ediciíon -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Editar Tarea</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <form id='taskEdit'>
        <div class="modal-body">
                    <input type="hidden" id="taskId" name="id">
                    <!-- Ojo porque esto ya se lo habia explicado...
                    cual es el id del input ? 
                 -->
            <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tareas:</label>
                    <input type="text" id="editname" name="name" placeholder="task Name" class="form-control" >
            </div>
            <div class="form-group">
                    <label for="message-text" class="col-form-label">Descripción:</label>
                    <textarea class="form-control" name="descripcion_1" id="description_1" required minlength="1" maxlength="500"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning .task-item">guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
-->
    <script src="<?= base_url('resources/app.js') ?>"></script>


</body>
</html>