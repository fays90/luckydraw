<!DOCTYPE html>
<html>
<head>
    <title>Participants List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pagination {
            justify-content: center;
        }

        .page-item .page-link {
            font-size: 14px; /* Set font size to ensure it is not oversized */
            padding: 0.375rem 0.75rem; /* Adjust padding to a reasonable size */
        }

        .pagination .page-item .page-link svg {
            width: 1em; /* Ensure SVG icons are properly sized */
            height: 1em;
        }

        /* Hide pagination arrows */
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            display: none;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 position-relative">
        <h1 class="text-center mb-4">Participants List</h1>

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

        <div class="top-right">
            <a href="/pick-winner" class="btn btn-warning">Pick a Winner</a>
        </div>

        <div class="mb-3">
            <form action="{{ url('/participants') }}" method="GET" class="form-inline">
                <label for="per_page" class="mr-2">Show</label>
                <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="40" {{ request('per_page') == 40 ? 'selected' : '' }}>40</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <label for="per_page">entries</label>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paginatedParticipants as $participant)
                    <tr>
                        <td>{{ $participant['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $paginatedParticipants->appends(['per_page' => request('per_page')])->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
