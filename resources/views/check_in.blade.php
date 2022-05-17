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
                                <div class="col-6" style="color: #1384ae;">
                                    ลงบันทึกการเข้างาน
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </h3>
                    </div>
                    <class class="card-body">
                        <form action="{{url('/check_in')}}" method="post">
                            @csrf
                            <input type="hidden" name="emp_name" value="{{session('user_auth')[0]->user_firstname . ' ' . session('user_auth')[0]->user_lastname . ' (' . session('user_auth')[0]->user_nickname . ')'}}" />

                            @if($check_in_status != null && $check_in_status[0]->datework_check == 1)
                            <center>
                                <input type="hidden" name="datework_check" value="{{$check_in_status[0]->datework_check}}" />
                                <input type="hidden" name="datework_id" value="{{$check_in_status[0]->datework_id }}" />
                                <button type="submit" name="user_id" class="btn btn-danger" value="{{session('user_auth')[0]->user_id}}" style="width: 200px; height: 100px;">CHECK OUT</button>
                            </center>
                            @elseif($check_in_status == null || $check_in_status[0]->datework_check == 0)
                            <center>
                                <input type="hidden" name="datework_check" value="0" />
                                <button type="submit" name="user_id" class="btn btn-info" value="{{session('user_auth')[0]->user_id}}" style="width: 200px; height: 100px;">CHECK IN</button>
                            </center>
                            @endif
                        </form>
                    </class>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table id="" class="table table-bordered table-hover">
                                <thead>
                                    <tr style="background-color: #f9d057; color: #1384ae; ">
                                        <th>
                                        </th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dateofworks as $dateofwork)
                                    <tr>
                                        <td>
                                            <center>
                                                {{$dateofworks->firstItem()+$loop->index}}
                                            </center>
                                        </td>
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
                                                @if($dateofwork->date_off_work == "0000-00-00 00:00:00" || $dateofwork->date_start_work == '')
                                                -
                                                @else
                                                <?php
                                                echo $dt = (new Datetime($dateofwork->date_off_work))->format('H:i:s น. d-m-Y');
                                                ?>
                                                @endif
                                            </center>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="float: right;">
                                {{$dateofworks->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                        <br />
                        <div style="float: right;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

</body>

</html>