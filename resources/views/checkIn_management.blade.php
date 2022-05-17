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
                            ตารางการเข้าทำงาน
                        </h3>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="header-table">
                                        <th>
                                            ลำดับที่
                                        </th>
                                        <th>ชื่อ - นามสกุลพนักงาน</th>
                                        <th>
                                            <center>
                                                เวลาเข้างาน
                                            </center>
                                        </th>
                                        <th>
                                            <center>
                                                เวลาเลิกงาน
                                            </center>
                                        </th>
                                        <th>
                                            <center>
                                                สถานะการทำงาน
                                            </center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($count_user = 1)
                                    @foreach($user_account as $user_accountdata)
                                        @foreach($dateofworks as $dateofwork)
                                            @if($user_accountdata->user_id == $dateofwork->user_id)
                                                <tr>
                                                    <td>{{$count_user++}}</td>
                                                    <td>{{$user_accountdata->user_firstname . " " . $user_accountdata->user_lastname}}</td>
                                                    <td>
                                                        <center>
                                                            @if($dateofwork->date_start_work == "0000-00-00 00:00:00" || $dateofwork->date_start_work == '')
                                                            -
                                                            @else
                                                            <?php
                                                            echo $dt = (new Datetime($dateofwork->date_start_work))->format('H:i:s น. d-m-Y');
                                                            ?>
                                                            @endif
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            @if($dateofwork->date_off_work == "0000-00-00 00:00:00" || $dateofwork->date_off_work == '')
                                                            -
                                                            @else
                                                            <?php
                                                            echo $dt = (new Datetime($dateofwork->date_off_work))->format('H:i:s น. d-m-Y');
                                                            ?>
                                                            @endif
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            @if($dateofwork->datework_check == 1)
                                                            <i style="color: #29eb2f" class="fa-solid fa-lg fa-briefcase"></i>
                                                            @else
                                                            <i style="color: #f9453c" class="fa-solid fa-lg fa-briefcase"></i>
                                                            @endif
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php break ?>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

</body>

</html>