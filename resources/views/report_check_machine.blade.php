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
    <style>
        a{
            font-size: 0.8rem;
        }
        .header-table{
            font-size: 0.8rem;
        }
        .header-table .col-4{
            font-size: 0.6rem;
        }
        </style>
</head>

<body>
    @extends('layouts.main_template')
    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>ผลรวม</h5>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <form action="{{url('/row_report_check_machine')}}" method="POST">
                            <div class="col-12">
                                <br />
                            </div>
                                @csrf
                            <div class="col-12">
                                <label>วันที่ตรวจสอบ</label>
                                <select class="form-select" required name="date_checked">
                                    <option selected value="{{$date_checked}}">
                                        {{(new DateTime($date_checked))->format('d-m-Y')}}
                                    </option>
                                    @foreach($date_for_select as $date_for_select_data)
                                        @if($date_checked != $date_for_select_data->start_date)
                                            <option value="{{$date_for_select_data->start_date}}">{{(new DateTime($date_for_select_data->start_date))->format('d-m-Y')}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br />
                            </div>
                            <div class="col-12">
                                <label>แถวการแสดงผล (ไล่ลำดับตามวันที่ตรวจสอบ)</label>
                                <input type="number" max="7" min="1" placeholder="แถวในการแสดงผล" value="{{$row_checked != null ? $row_checked : "7"}}" class="form-control" name="row_date_checked" />
                            </div>
                            <div class="col-12">
                                <span style="float: right">
                                    <button type="submit" class="btn btn-info my-2">แสดงการค้นหา &emsp;<i class="fa-solid fa-magnifying-glass"></i></button>
                                    @if($date_for_select != null && count($date_for_select) > 1)
                                        <button type="submit" class="btn btn-danger my-2" id="btn_delete_date" form="delete_date" disabled>ลบข้อมูล &emsp;<i class="fa-solid fa-trash-can"></i></button>
                                    @else
                                        <button type="submit" class="btn btn-danger my-2" form="delete_date" disabled>ลบข้อมูล &emsp;<i class="fa-solid fa-trash-can"></i></button>
                                    @endif
                                </span>
                            </div>
                        </form>
                        <div style="overflow-x:auto;">
                                <div class="table_report">
                                    <br />
                                    <table class="table table-hover" width="100%">
                                        <thead>
                                            <tr class="header-table">
                                                <th width="8%;">
                                                    ห้อง
                                                    <br />
                                                    <br />
                                                </th>
                                                <?php $count_date_for_checking = 0 ?>
                                                <form method="post" id="delete_date" action="{{url('/dalete_date_for_checkings')}}"> 
                                                    {{-- {{url('dalete_date_for_checkings')}} --}}
                                                    @foreach($date_for_checkings as $date_for_checking)
                                                        <?php $count_date_for_checking++ ?>
                                                        <th width="300px;">
                                                            <div class="row" align="center">
                                                                <div class="col-12">
                                                                    @csrf
                                                                        @if($date_for_checking->end_date <= (new datetime())->format('Y-m-d 06:59:59'))
                                                                            <input type="checkbox" class="form-check-input value_date" name="date_delete[]" id="checkbox_date{{$count_date_for_checking}}" value="{{$date_for_checking->date_id}}"/>
                                                                        @endif
                                                                        
                                                                        <label for="checkbox_date{{$count_date_for_checking}}">{{(new DateTime($date_for_checking->start_date))->format('d/m/Y')}}</label>
                                                                </div>
                                                                <div class="col-4">เช้า</div>
                                                                <div class="col-4">บ่าย</div>
                                                                <div class="col-4">ค่ำ</div>
                                                            </div>
                                                        </th>
                                                    @endforeach
                                                </form>
                                            </tr>
                                        </thead>
                                        <tbody class="table-bordered">
                                            @foreach($machine_rooms as $machine_room)
                                            <tr>
                                                <td style="font-size: 0.6rem">{{$machine_room->machine_room_number}}</td>
                                                <?php $count_time = 0 ?>
                                                @for($count_date_for_check = 0; $count_date_for_check < count($date_for_checkings); $count_date_for_check++)
                                                    <td>
                                                        <div class="row" align="center">
                                                            @foreach($machine_rooms_check_days[$count_date_for_check] as $machine_rooms_check_day)
                                                                @if($count_time == 3)
                                                                    <?php break; ?>
                                                                @else
                                                                @if($machine_rooms_check_day->machine_room_id == $machine_room->machine_room_id)
                                                                    <div class="col-4">
                                                                        <a href="{{url('/detail_report_check_machine/'.$machine_rooms_check_day->machine_rooms_check_day_id."/".$machine_room->machine_room_number."/".$machine_room->machine_room_level."/".(new datetime($date_for_checkings[$count_date_for_check]->start_date))->format('d-m-Y'))}}">
                                                                        @if($machine_rooms_check_day->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                                                            <i class="fa-solid fa-sm fa-circle" style="color:#f7dc48; font-size: 0.9rem;"></i> 
                                                                        @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ") 
                                                                            <i class="fa-solid fa-sm fa-circle" style="color:#29eb2f; font-size: 0.9rem;"></i> 
                                                                        @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") 
                                                                            <i class="fa-solid fa-sm fa-circle" style="color:#4be9d6; font-size: 0.9rem;"></i> 
                                                                        @elseif($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา")
                                                                            <i class="fa-solid fa-sm fa-circle" style="color:#f9453c; font-size: 0.9rem;"></i> 
                                                                        @endif
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                @endfor             
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            $(document).ready(function () {
                $('.value_date').click(function () { 
                    var count = $('input:checkbox:checked').length;
                    if(count > 0){
                        $('#btn_delete_date').removeAttr('disabled', false);
                    }else if(count == 0){
                        $('#btn_delete_date').prop('disabled', true);
                    }
                });
            
                $('#btn_delete_date').click(function (e) { 
                    e.preventDefault();
                    Swal.fire({
                       title: 'ลบข้อมูล?',
                       text: "คุณต้องการลบข้อมูลห้อง ใช่หรือไม่",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'ตกลง',
                       cancelButtonText: 'ยกเลิก'
                       }).then((result) => {
                           if (result.isConfirmed) {
                               $('#delete_date').submit();
                           }
                       });
                });
            });
    </script>
</body>

</html>