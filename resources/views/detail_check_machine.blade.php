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
                    <div class="row">
                        <div class="col-6">
                            <h5>ตรวจสอบ </h5>
                        </div>
                        <div class="col-6">
                            <h5 align="right">
                                {{$room}}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
                @foreach($machine_rooms as $machine_room)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5>รอบ <?php if ($machine_room->shift_worker_time == 1){ echo "เช้า"; }elseif ($machine_room->shift_worker_time == 2){ echo "บ่าย"; }elseif($machine_room->shift_worker_time == 3) { echo "ค่ำ"; } ?></label>
                            </div>
                            <div class="col-6">
                                <h5 style="float: right;">
                                    @if($machine_room->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                        <i class="fa-solid fa-sm fa-circle" style="color:#f7dc48; font-size: 1rem;"></i> 
                                    @elseif($machine_room->machine_rooms_check_day_status == "ปกติ") 
                                        <i class="fa-solid fa-sm fa-circle" style="color:#29eb2f; font-size: 1rem;"></i> 
                                    @elseif($machine_room->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") 
                                        <i class="fa-solid fa-sm fa-circle" style="color:#4be9d6; font-size: 1rem;"></i> 
                                    @elseif($machine_room->machine_rooms_check_day_status == "พบปัญหา")
                                        <i class="fa-solid fa-sm fa-circle" style="color:#f9453c; font-size: 1rem;"></i> 
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>สถานะ: {{$machine_room->machine_rooms_check_day_status}}</p>
                                @if($machine_room->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว" || $machine_room->machine_rooms_check_day_status == "พบปัญหา")
                                    <p>ปัญหาที่พบ: {{$machine_room->machine_room_problem}}</p>
                                <hr />
                                @endif
                                <div class="row">
                                    @if(false)
                                        <div class="col-12"><p style="font-size: 0.8rem;">รูปภาพประกอบ</p></div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($machine_descriptions as $machine_description)
                                                        @if($machine_description->machine_rooms_check_day_id == $machine_room->machine_rooms_check_day_id)
                                                            <div class="col-2">
                                                                <img onclick="show_img('{{'img/errormachine/'.$machine_description->machine_description_image}}')" width="100%" src="{{asset('img/errormachine/'. $machine_description->machine_description_image)}}"/>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($machine_room->img_for_checked != null && $machine_room->img_for_checked != '')
                            <div class="col-12">
                            <p>รายละเอียด: @if ($machine_room->machine_rooms_check_day_description != null && $machine_room->machine_rooms_check_day_description != '') {{$machine_room->machine_rooms_check_day_description}} @else ไม่มี @endif</p>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-10">
                                <p style="font-size: 0.8rem;">รูปภาพยืนยันการเช็ค </p>
                            </div>
                                <div class="col-2">
                                    <img onclick="show_img('{{'img/img_for_checked/ตรวจห้องเครื่องวันที่ '.(new datetime($date_for_checkings->start_date))->format('d-m-Y').'/'.$machine_room->img_for_checked}}')" width="100%" src="{{asset('img/img_for_checked/ตรวจห้องเครื่องวันที่ '.(new datetime($date_for_checkings->start_date))->format('d-m-Y').'/'.$machine_room->img_for_checked)}}"/>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <a href="{{url('check_machine')}}" class="btn btn-light form-control">ย้อนกลับ</a>
                <br />
            </div>
        <div class="col-1">
        </div>
    </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function show_img(pString){
            Swal.fire({
            imageUrl: '../../../'+pString,
            showCloseButton: true,
            showConfirmButton: false,
            imageWidth: 300,
        })
        }
    </script>
</body>

</html>