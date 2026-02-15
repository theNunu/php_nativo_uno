<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2>Crear Usuario</h2>

    <form action="/users/store" method="POST">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="/users" class="btn btn-secondary">Volver</a>

    </form>

</body>
</html>
