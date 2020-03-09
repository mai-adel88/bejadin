<!DOCTYPE html>
<html>
<head>
    <title>Driver Report</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<style>
    body {
        font-family: 'dejavu sans', sans-serif;
        direction:rtl;
        text-alignment:right;
    }
</style>
<body>

<div class="row" style="text-align: center;">
    <div class="col-md-12">
        <strong>{{trans('admin.full_name')}}</strong>
        : {{session_lang($driver->name_en,$driver->name_ar)}}
    </div>
</div>
<div class="row">
    <table class="table">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Salary</th>
            <th>Address</th>
            <th>Phone</th>
            <th>State Date</th>
            <th>Work Date</th>
            <th>License Num</th>
            <th>Date Issuance</th>
            <th>Expired Date</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th>{{ $driver->id }}</th>
                <td>{{ $driver->salary }}</td>
                <td>{{ $driver->addriss }}</td>
                <td>{{ $driver->phone }}</td>
                <td>{{ $driver->state_date }}</td>
                <td>{{ $driver->work_date }}</td>
                <td>{{ $driver->license_num }}</td>
                <td>{{ date('Y-m-d', strtotime($driver->date_issuance)) }}</td>
                <td>{{ date('Y-m-d', strtotime($driver->expired_date)) }}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>