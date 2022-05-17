<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,200&family=Sarabun:wght@200;400&family=Thasadith:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Builder Management Program</title>
</head>

<body>
    @extends('layouts.main_template')
    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <div class="row">
                                <div class="col-6">
                                    สมาชิก
                                </div>
                                <div class="col-6">
                                    <a href="{{url('/insert_user')}}" style="float: right" class="btn btn-info">เพิ่มสมาชิกพนักงาน</a>
                                </div>
                            </div>

                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="header-table">
                                        <th>
                                            ลำดับที่
                                        </th>
                                        <th>ชื่อ - นามสกุลพนักงาน</th>
                                        <th>
                                            <center>

                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_account as $user_accountdata)
                                    <tr>
                                        <td>{{$user_account->firstItem()+$loop->index}}</td>
                                        <td>{{$user_accountdata->user_firstname . " " . $user_accountdata->user_lastname . " (" . $user_accountdata->user_nickname . ")"}}</td>
                                        <td>
                                            <center>
                                                <a href="{{url('/modify_user/'.$user_accountdata->user_id)}}" class="btn btn-outline-warning">แก้ไข</a>
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <br />
                        <div style="float: right;">
                            {{$user_account->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

</body>

</html>