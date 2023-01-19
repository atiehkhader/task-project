<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Employees</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>employee email</th>
                    <th>employee phone</th>
                    <th width="30%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($employees) && $employees->count())
                    @foreach ($employees as $key => $employee)
                        <tr>
                            <td>{{ $loop->key + 1 }}</td>
                            <td>{{ $employee->employee_first_name }} {{ $employee->employee_last_name }}</td>
                            <td>{{ $employee->employee_email }}</td>
                            <td>{{ $employee->employee_phone }}</td>
                            <td>
                                <form action="/dashboard/employees/{{ $employee->id }}" method="POST">@csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" data-toggle="tooltip"
                                        type="submit">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {!! $employees->links() !!}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this item?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
</body>

</html>
