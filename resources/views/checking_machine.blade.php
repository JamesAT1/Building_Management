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

        .img-warp{
            position: relative;
            display: inline-block;
        }

        #file_submit{
            display: none;
        }

        .img-warp .close{
            position: absolute;
            top: 2px;
            right: 2px;
            z-index: 100;
            padding: 5px 2px 2px;
            font-weight: bold;
            cursor: pointer;
            opacity: .2;
            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
        }

        .close .fa-circle-xmark{
            color: red;
        }

        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
                            <h5>ตรวจสอบ {{$room}}</h5>
                        </div>
                        <div class="col-6">
                            <h5 align="right">
                            @if($machine_rooms_check_days->shift_worker_time == 1)
                                รอบเช้า
                            @elseif($machine_rooms_check_days->shift_worker_time == 2)
                                รอบบ่าย
                            @elseif($machine_rooms_check_days->shift_worker_time == 3)
                                รอบค่ำ
                            @endif
                            </h5>
                        </div>
                    </div>
                </div>
                <form action="{{$isMobile == true || $isPlateform == "Mobile" || $isPlateform == "OS X" ? url('checking_machine/update') : "#"}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room" value="{{$room}}">
                    <input type="hidden" name="level" value="{{$room_level}}">
                    <input type="hidden" name="url_proplem" value="/detail_check_machine/{{$room_id}}/{{$room}}">
                    <input type="hidden" name="machine_rooms_check_day_id" value="{{$machine_rooms_check_days->machine_rooms_check_day_id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label>สถานะ</label>
                                @if($machine_rooms_check_days->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ")
                                    <select name="machine_rooms_check_day_status" id="status_machine" class="form-select" required>
                                        <option value="">ระบุ</option>
                                        <option value="ปกติ">ปกติ</option>
                                        <option value="พบปัญหา">พบปัญหา</option>
                                    </select>
                                    <br />
                                    <div id="error_status">

                                    </div>
                                @else
                                    <select name="machine_rooms_check_day_status" id="status_machine" class="form-select" required>
                                        <option value="{{$machine_rooms_check_days->machine_rooms_check_day_status}}">{{$machine_rooms_check_days->machine_rooms_check_day_status}}</option>
                                        @if($machine_rooms_check_days->machine_rooms_check_day_status != "ปกติ")
                                        <option value="ปกติ">ปกติ</option>
                                        @endif
                                        @if($machine_rooms_check_days->machine_rooms_check_day_status != "พบปัญหา")
                                        <option value="พบปัญหา">พบปัญหา</option>
                                        @endif
                                    </select>
                                    <br />
                                    <div id="error_status">
                                    </div>
                                @endif
                            </div>
                            @if($machine_descriptions != null && count($machine_descriptions) != 0)
                                <div class="col-12">
                                    <div class="row">
                                        @foreach($machine_descriptions as $machine_description)
                                            <div class="col-3">
                                                <div class="img-warp">
                                                    <div class="close"><a href="{{url('/checking_machine/delete/'.$machine_description->machine_description_id)}}"><i class="fa-solid fa-sm fa-circle-xmark"></i></a></div>
                                                    <img src="{{url('/img/errormachine/'.$machine_description->machine_description_image)}}" width="100%"/>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br />
                                </div>
                            @endif
                            <div class="col-12">
                                <label>รายละเอียด</label>
                                <textarea class="form-control" name="machine_rooms_check_day_description" placeholder="ถ้ามี">{{$machine_rooms_check_days->machine_rooms_check_day_description != "" ? $machine_rooms_check_days->machine_rooms_check_day_description : ""}}</textarea>
                                <br />
                            </div>
                            <div class="col-12">
                                <input type="file" class="form-control" id="file_submit" name="img_for_checked" onchange="checked_machine()" capture accept="image/*" required {{$isMobile == true || $isPlateform == "Mobile" || $isPlateform == "OS X" ? "" : "disabled"}} />  <!--disabled-->
                            </div>
                            <div class="col-12">
                                    <div id="form_submit">
                                        <p style="color: red;">{{$isMobile == true || $isPlateform == "Mobile" || $isPlateform == "OS X" ? "" : "*แจ้ง: ให้ใช้โทรศัพท์ในการอัพเดทข้อมูล"}}</p>
                                        <label for="file_submit" class="file_button btn btn-info form-control" id="checked_submit" >อัพเดทข้อมูลห้องเครื่อง</label>
                                        {{-- <button type="submit" class="form-control btn btn-info" {{$isMobile == true || $isPlateform == "Mobile" || $isPlateform == "OS X" ? "" : "disabled"}} >อัพเดทข้อมูลห้องเครื่อง</button> --}}
                                        <a href="{{url('/check_machine')}}" class="form-control btn btn-back">ย้อนกลับ</a>
                                        <br />
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1">
        </div>
        <div class="col-12">
            
        </div>
    </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script> 
        function checked_machine(){
            var $form = $('form')[0];
            
            if($form.checkValidity()){
                $form.submit();
                $('#form_submit').append('<center><img src="{{asset("/img/loading.gif")}}" width="60%"/></center>');
                $('#checked_submit').remove();
                $('.btn-back').remove();
            }else{
                Swal.fire(
                    'ข้อมูลไม่ครบ',
                    'กรุณากรอกข้อมูลให้ครบถ้วน',
                    'warning'
                )
            }
        }
        
        $(document).ready(function () {
            if($('#status_machine').val() === "พบปัญหา" || $('#status_machine').val() === "พบปัญหาและแก้ไขแล้ว"){
                var status = $('#status_machine').val();
                $('#error_status').append('<div class="error">' +
                        '<p>ปัญหาที่พบ</p>' +
                            '<div class="row">' +
                                '<div class="col-6">' +
                                    '<textarea class="form-control" name="machine_room_problem" required rows="3">{{$machine_rooms_check_days->machine_room_problem	!= "" ? $machine_rooms_check_days->machine_room_problem : ""}}</textarea>' +
                                '</div>' +
                                '<div class="col-1"></div>' +
                                '<div class="col-5">' +
                                    '<input type="radio" name="machine_rooms_check_day_status" id="form_check_1" class="form-check-input" required value="พบปัญหาและแก้ไขแล้ว" {{$machine_rooms_check_days->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว" ? "checked" : ""}} name="status_machine" />' +
                                    '<label for="form_check_1" class="form-check-label">แก้ไขแล้ว</label>' +
                                        '<br />' +
                                        '<br />' +
                                    '<input type="radio" name="machine_rooms_check_day_status" id="form_check_2" class="form-check-input" required value="พบปัญหา" {{$machine_rooms_check_days->machine_rooms_check_day_status == "พบปัญหา" ? "checked" : ""}} name="status_machine" />' +
                                    '<label for="form_check_2" class="form-check-label">แก้ไขไม่ได้</label>' +
                                '</div>' +
                                // '<div class="col-12">' +
                                //         '<div class="row" id="add_rowpic">' +
                                //             '<div class="col-6 row_pic">' +
                                //                 '<br />' +
                                //                 '<input type="file" name="machine_description_image[]" accept="image/*" {{$machine_descriptions != null && count($machine_descriptions) != 0 ? "" : "required"}} class="form-control"/>' +
                                //             '</div>' +
                                //         '</div>' +
                                //         '<br />' +
                                //         '<input type="button" onclick="add_pic()" class="add_pic btn btn-sm btn-info" value="เพิ่มรูปภาพ" /> &nbsp;' +
                                //         '<input type="button" onclick="remove_pic()" class="remove_pic btn btn-sm btn-danger" value="ลบ" />' +
                                //     '<br />' +
                                //     '<br />' +
                                // '</div>' +
                            '</div>' +
                        '</div>'
                        );
            }else if($('#status_machine').val() === "ปกติ"){
                // $('#error_status').append('<div class="error">' +
                //             '<div class="row">' +
                //                 '<div class="col-12">' +
                //                         '<div class="row" id="add_rowpic">' +
                //                             '<div class="col-6 row_pic">' +
                //                                 '<br />' +
                //                                 '<input type="file" name="machine_description_image[]" {{$machine_descriptions != null && count($machine_descriptions) != 0 ? "" : "required"}} class="form-control" capture accept="image/*" />' +
                //                             '</div>' +
                //                         '</div>' +
                //                         '<br />' +
                //                         '<input type="button" onclick="add_pic()" class="add_pic btn btn-sm btn-info" value="เพิ่มรูปภาพ" /> &nbsp;' +
                //                         '<input type="button" onclick="remove_pic()" class="remove_pic btn btn-sm btn-danger" value="ลบ" />' +
                //                     '<br />' +
                //                     '<br />' +
                //                 '</div>' +
                //             '</div>' +
                //         '</div>'
                //         );
            }

            $('#status_machine').on('change', function(){
                var status = $(this).val();
                $('.error').remove();
                if(status === "พบปัญหา"){
                    $('#error_status').append('<div class="error">' +
                        '<p>ปัญหาที่พบ</p>' +
                            '<div class="row">' +
                                '<div class="col-6">' +
                                    '<textarea class="form-control" name="machine_room_problem" required rows="3">{{$machine_rooms_check_days->machine_room_problem	!= "" ? $machine_rooms_check_days->machine_room_problem : ""}}</textarea>' +
                                '</div>' +
                                '<div class="col-1"></div>' +
                                '<div class="col-5">' +
                                    '<input type="radio" {{$machine_rooms_check_days->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว" ? "checked" : ""}} name="machine_rooms_check_day_status" id="form_check_1" class="form-check-input" required value="พบปัญหาและแก้ไขแล้ว" name="status_machine" />' +
                                    '<label for="form_check_1" class="form-check-label">แก้ไขแล้ว</label>' +
                                        '<br />' +
                                        '<br />' +
                                    '<input type="radio" {{$machine_rooms_check_days->machine_rooms_check_day_status == "พบปัญหา" ? "checked" : ""}} name="machine_rooms_check_day_status" id="form_check_2" class="form-check-input" required value="พบปัญหา" name="status_machine" />' +
                                    '<label for="form_check_2" class="form-check-label">แก้ไขไม่ได้</label>' +
                                '</div>' +
                                // '<div class="col-12">' +
                                //         '<div class="row" id="add_rowpic">' +
                                //             '<div class="col-6 row_pic">' +
                                //                 '<br />' +
                                //                 '<input type="file" name="machine_description_image[]" {{$machine_descriptions != null && count($machine_descriptions) != 0 ? "" : "required"}} class="form-control" accept="image/*" />' +
                                //             '</div>' +
                                //         '</div>' +
                                //         '<br />' +
                                //         '<input type="button" onclick="add_pic()" class="add_pic btn btn-sm btn-info" value="เพิ่มรูปภาพ" /> &nbsp;' +
                                //         '<input type="button" onclick="remove_pic()" class="remove_pic btn btn-sm btn-danger" value="ลบ" />' +
                                //     '<br />' +
                                //     '<br />' +
                                // '</div>' +
                            '</div>' +
                        '</div>'
                        );
                }else if(status === "ปกติ"){
                    // $('#error_status').append('<div class="error">' +
                    //         '<div class="row">' +
                    //             '<div class="col-12">' +
                    //                     '<div class="row" id="add_rowpic">' +
                    //                         '<div class="col-6 row_pic">' +
                    //                             '<br />' +
                    //                             '<input type="file" name="machine_description_image[]" {{$machine_descriptions != null && count($machine_descriptions) != 0 ? "" : "required"}} class="form-control" capture accept="image/*" />' +
                    //                         '</div>' +
                    //                     '</div>' +
                    //                     '<br />' +
                    //                     '<input type="button" onclick="add_pic()" class="add_pic btn btn-sm btn-info" value="เพิ่มรูปภาพ" /> &nbsp;' +
                    //                     '<input type="button" onclick="remove_pic()" class="remove_pic btn btn-sm btn-danger" value="ลบ" />' +
                    //                 '<br />' +
                    //                 '<br />' +
                    //             '</div>' +
                    //         '</div>' +
                    //     '</div>'
                    //     );
                }else{
                    $('.error').remove();
                }
            });
        });

        function add_pic(){
            $('#add_rowpic').append('<div class="col-6 row_pic">' +
                                        '<br />' +
                                        '<input type="file" name="machine_description_image[]" accept="image/*" required class="form-control"/>' +
                                    '</div>');
        }

        function remove_pic(){
            if($('.row_pic').length > 1){
                $('.row_pic:last').remove();
            }
        }
        
      
    </script>
</body>

</html>