<!DOCTYPE html>
<html>
<head>
    <title>Lucky Draw</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lucky Draw</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form to add participant -->
        <div class="card mb-4">
            <div class="card-header">
                Add Participant
            </div>
            <div class="card-body">
                <form action="/lucky-draw" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Participant</button>
                </form>
            </div>
        </div>

        <!-- Form to upload Excel file -->
        <div class="card mb-4">
            <div class="card-header">
                Upload Excel File
            </div>
            <div class="card-body">
                <form action="/upload-csv" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="csv_file">Excel File:</label>
                        <input type="file" id="csv_file" name="csv_file" class="form-control-file" accept=".xlsx,.xls,.csv,.txt" required>
                    </div>
                    <button type="submit" class="btn btn-success">Upload Excel</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
