<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoApp</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="todoapp/css/index.css">
</head>

<body>
    <div class="form-container">
        <h2>Nouvelle todo</h2>
        <form action="">
            <input name="title" type="text" placeholder="Titre">
            <textarea name="description" placeholder="Description" id=""></textarea>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <div class="todos-container">
        <h2>Todos</h2>
        <ul>
        </ul>
</body>

<script>
    $(document).ready(function() {

        //Refresh initial des todos
        getTodos();

        //Event listener pour le submit du formulaire
        $('form').submit(function(e) {
            e.preventDefault();
            const title = $('input[name="title"]').val();
            const description = $('textarea[name="description"]').val();
            addTodo(title, description);
        });
    });

    //Fonction appelant le script php qui ajoute une todo
    async function addTodo(title, description) {
        await $.ajax({
            url: 'http://localhost:3000/todoapp/add.php',
            method: 'POST',
            data: {
                title: title,
                description: description
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
        getTodos();
    }
    //Fonction appelant le script php qui met à jour une todo
    async function updateTodo(id, status) {
        await $.ajax({
            url: 'http://localhost:3000/todoapp/update.php',
            method: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
        getTodos();
    }


    //Fonction appelant le script php qui récupère les todos et les affiches
    async function getTodos() {
        await $.ajax({
            url: 'http://localhost:3000/todoapp/get.php',
            method: 'GET',
            success: function(response) {
                let todos = JSON.parse(response);
                console.log(todos);
                $('.todos-container ul').html('');
                todos.forEach(todo => {
                    $('.todos-container ul').append(`
                <li class='${todo.status? "done": ""}'>
                    <h3>${todo.title}</h3>
                    <p>${todo.description}</p>
                    <button onclick="updateTodo(${todo.id}, ${todo.status == 0 ? 1 : 0})">${todo.status == 0 ? 'Terminer' : 'Annuler'}</button>
                    <button onclick="deleteTodo(${todo.id})">Supprimer</button>
                </li>
            `);
                });

            },
            error: function(error) {
                console.log(error);
            }
        });

    }

    //Fonction appelant le script php qui supprime une todo
    async function deleteTodo(id) {
        await $.ajax({
            url: 'http://localhost:3000/todoapp/delete.php',
            method: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                getTodos();
            },
            error: function(error) {
                console.log(error);
            }
        });
        getTodos();
    }
</script>

</html>