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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-lg-12 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">ยังไม่ตรวจสอบ</div>
                                        <div class="col-8">
                                            <h2 style="color: #f7dc48">
                                                <b style="float: right;">
                                                        @if($status_checking != null) {{$status_checking[0]['notCheck']}} @endif                                            </b>
                                            </h2>
                                           
                                        </div>
                                        <div class="col-12">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                        <center>
                                                            เช้า
                                                            <span style="color: #f7dc48">{{$status_checking[0]['morning']}}</span>
                                                        </center>
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                        <center>
                                                            บ่าย
                                                            <span style="color: #f7dc48">{{$status_checking[0]['afternoon']}}</span>
                                                        </center>
                                                    </div>
                                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                        <center>
                                                            ค่ำ
                                                            <span style="color: #f7dc48">{{$status_checking[0]['evening']}}</span>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">ตรวจแล้ว</div>
                                        <div class="col-6">
                                            <h2 style="color: #000000">
                                                <b style="float: right;">
                                                        @if($status_checking != null) {{$status_checking[0]['checked']}} @endif                                            </b>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">ปกติ</div>
                                        <div class="col-6">
                                            <h2 style="color: #29eb2f">
                                                <b style="float: right;">
                                                        @if($status_checking != null) {{$status_checking[0]['normal']}} @endif                                            </b>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">แก้ไขแล้ว</div>
                                        <div class="col-6">
                                            <h2 style="color: #4be9d6">
                                                <b style="float: right;">
                                                    @if($status_checking != null) {{$status_checking[0]['solve']}} @endif</b>
                                                </b>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">พบปัญหา</div>
                                        <div class="col-6">
                                            <h2 style="color: #f9453c">
                                                <b style="float: right;">
                                                    @if($status_checking != null) {{$status_checking[0]['problem']}} @endif</b>
                                                </b>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session('user_auth')[0]->user_rule_status == 0)
        <div>
            <div class="row">
                <div class="col-8">
                    <a href="{{url('insert_machine')}}" class="btn btn-success">เพิ่มข้อมูลห้องเครื่อง <i class="fa-solid fa-plus"></i></a>
                    <div class="my-3"></div>
                </div>
                <div class="col-4">
                    <a href="{{url('report_check_machine')}}" class="btn btn-light form-control" style="float: right;">ดูผลรวม <i class="fa-solid fa-chart-column"></i></a>
                    <div class="my-3"></div>
                </div>
            </div>
        </div>
        @endif
        @if($machine_rooms != null)
            @foreach($machine_rooms as $machine_room)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card ">
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-9" style="font-size: 0.8rem;">
                                        ห้อง/เครื่องจักร {{$machine_room->machine_room_number}}
                                    </div>
                                    <div class="col-3" style="font-size: 0.6rem;">
                                        <span style="float: right;"> ชั้น {{$machine_room->machine_room_level}}</span>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <?php $count_time = 0 ?>
                                    @foreach($machine_rooms_check_days as $machine_rooms_check_day)
                                        @if($count_time == 3)
                                                <?php break; ?>
                                        @else
                                            <div class="col-4">
                                                <center>
                                                    @if($machine_rooms_check_day->machine_room_id == $machine_room->machine_room_id)
                                                        @if($machine_rooms_check_day->machine_room_id == $machine_room->machine_room_id && $machine_rooms_check_day->shift_worker_time == 1)
                                                            <a class="btn btn-light" href="{{url('/checking_machine/'.$machine_rooms_check_day->machine_rooms_check_day_id.'/'.$machine_room->machine_room_number.'/'.$machine_room->machine_room_id.'/'.$machine_room->machine_room_level)}}" style="color: black; font-size: 0.7rem; border: solid 1px; border-color: rgb(219, 219, 219);">
                                                                รอบเช้า  
                                                                @if($machine_rooms_check_day->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f7dc48; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#29eb2f; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#4be9d6; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f9453c; font-size: 0.4rem;"></i> 
                                                                @endif
                                                            </a>
                                                            <?php $count_time++ ?>
                                                        @elseif($machine_rooms_check_day->machine_room_id == $machine_room->machine_room_id && $machine_rooms_check_day->shift_worker_time == 2)
                                                            <a class="btn btn-light" href="{{url('/checking_machine/'.$machine_rooms_check_day->machine_rooms_check_day_id.'/'.$machine_room->machine_room_number.'/'.$machine_room->machine_room_id.'/'.$machine_room->machine_room_level)}}" style="color: black; font-size: 0.7rem; border: solid 1px; border-color: rgb(219, 219, 219);">
                                                                รอบบ่าย
                                                                @if($machine_rooms_check_day->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f7dc48; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#29eb2f; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#4be9d6; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f9453c; font-size: 0.4rem;"></i> 
                                                                @endif
                                                            </a>
                                                            <?php $count_time++ ?>
                                                        @elseif($machine_rooms_check_day->machine_room_id == $machine_room->machine_room_id && $machine_rooms_check_day->shift_worker_time == 3)
                                                            <a class="btn btn-light" href="{{url('/checking_machine/'.$machine_rooms_check_day->machine_rooms_check_day_id.'/'.$machine_room->machine_room_number.'/'.$machine_room->machine_room_id.'/'.$machine_room->machine_room_level)}}" style="color: black; font-size: 0.7rem; border: solid 1px; border-color: rgb(219, 219, 219);">
                                                                รอบค่ำ
                                                                @if($machine_rooms_check_day->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f7dc48; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#29eb2f; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") 
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#4be9d6; font-size: 0.4rem;"></i> 
                                                                @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา")
                                                                    <i class="fa-solid fa-sm fa-circle" style="color:#f9453c; font-size: 0.4rem;"></i> 
                                                                @endif
                                                            </a>
                                                            <?php $count_time++ ?>
                                                        @endif
                                                    @endif
                                                </center>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            <center>
                                <br />
                                <a href="{{url('/detail_check_machine/'.$machine_room->machine_room_id.'/'.$machine_room->machine_room_number)}}" style="width: 80%;" class="btn btn-sm btn-info">รายละเอียด</a> 
                                @if(session('user_auth')[0]->user_rule_status == 0)
                                    <button class="btn btn-sm btn-light dropdown-toggle" id="setting_room" data-bs-toggle="dropdown"><i class="fa-solid fa-sm fa-gear"></i></button>
                                    <ul class="dropdown-menu" aria-labelledby="setting_room">
                                        <li><a class="dropdown-item" href="{{url('/modify_machine_room/'.$machine_room->machine_room_id)}}">แก้ไขข้อมูล &emsp;<i class="fa-solid fa-pen-to-square my-1" style="float: right;"></i></a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item delete_machine_room" onclick="delete_machine_room('<?php echo $machine_room->machine_room_number ?>', '<?php echo $machine_room->machine_room_id ?>')" href="#" style="color: red;">ลบข้อมูล <i class="fa-solid fa-trash-can my-1" style="float: right;"></i></a></li>
                                    </ul>
                                @endif
                            </center>
                        
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
              function delete_machine_room(pNumber, id){
                Swal.fire({
                    title: 'ลบข้อมูล?',
                    text: "คุณต้องการลบข้อมูลห้อง " + pNumber + " ใช่หรือไม่",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "/remove_machine_room/" + id;
                        }
                    });
              }
    </script>
</body>

</html>