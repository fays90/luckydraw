<!DOCTYPE html>
<html>
<head>
    <title>Winner</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Winner</h1>

        <div class="alert alert-success text-center">
            <h2>Congratulations!</h2>
            <p>The lucky winner is: <strong>{{ $winner }}</strong></p>
        </div>

        <div class="text-center">
            <a href="/lucky-draw" class="btn btn-primary">Draw Again</a>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
