<?php date_default_timezone_set('Asia/Bangkok') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,500;1,200&family=Sarabun:wght@200;400&family=Thasadith:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Builder Management Program</title>

    <style>
        .error-message{
            font-size: 0.8rem;
            color: red;
            float: right;
        }
    </style>
</head>

<body>
    @extends('layouts.main_template')
    @section('content')
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h4>สร้างข้อมูลพนักงาน</h4>
                </div>
                <form action="{{url('insert_user/add')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>รหัสพนักงาน</label>
                                @error('user_name')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control" name="user_name" required/>
                               
                                <br />
                            </div>
                            <div class="col-6">
                                <label>รหัสผ่าน</label>
                                @error('user_pass')
                                    <span class="error-message">{{$message}}</span>
                                @enderror
                                <input type="password" class="form-control" name="user_pass" required/>
                                <br />

                            </div>
                            <div class="col-6">
                                <label>ชื่อ</label>
                                <input type="text" class="form-control" name="user_firstname" required/>
                                <br />

                            </div>
                            <div class="col-6">
                                <label>นามสกุล</label>
                                <input type="text" class="form-control" name="user_lastname" required/>
                                <br />

                            </div>
                            <div class="col-6">
                                <label>ชื่อเล่น</label>
                                <input type="text" class="form-control" name="user_nickname" required/>
                                <br />

                            </div>
                            <div class="col-6">
                                <label>วันเกิด</label>
                                <input type="date" class="form-control" name="user_birth" required/>
                                <br />

                            </div>
                            <div class="col-6">
                                <label>วันที่เริ่มงาน</label>
                                <input type="date" class="form-control" name="user_begindatetowork" required/>
                                <br />

                            </div>
                            <div class="col-12">
                            <br />
                                <button type="submit" class="form-control btn btn-info">สร้างข้อมูลพนักงาน</button>
                                <a href="{{url('/show_user')}}" class="form-control btn">ย้อนกลับ</a>
                                <br />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1">
        </div>
    </div>
    @endsection

</body>

</html>