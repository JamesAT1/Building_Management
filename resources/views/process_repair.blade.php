<?php
    date_default_timezone_set('Asia/Bangkok') 
?>
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
            <form action="{{url('process_repair_update')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="card">
                <div class="card-header">
                    <h5>สร้างรายงานการแจ้งซ่อม/งานที่มอบหมาย
                        @if(session('user_auth')[0]->user_rule_status == 0 && $list_of_repair[0]->status_repair == "ดำเนินการสำเร็จ")
                            @if($list_of_repair[0]->approve_report == false)
                            <span id="approved_status"></span>
                                <button type="submit" style="float: right;" class="btn btn-success approved">ยืนยันการเสร็จสิ้น</button>
                            @else
                                <button disabled style="float: right;" class="btn btn-outline-success">เสร็จสิ้นแล้ว</button>
                            @endif
                        @endif
                    </h5>
                </div>
                    <input type="hidden" name="list_repair_id" value="{{$id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-body">
                                        <label>ผู้แจ้ง</label>
                                        <br />
                                        <span>{{$list_of_repair[0]->notifier}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="card">
                                    <div class="card-body">
                                        <label>ผู้รับมอบหมาย</label>
                                        <br />
                                        <span>{{$list_of_repair[0]->editor != null ? $list_of_repair[0]->editor : "ไม่มี"}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                @if(count($list_of_repair) > 0)
                                    <div class="row" id="layout_img">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <label>
                                                        ภาพประกอบ
                                                    </label>
                                                    <div class="row">
                                                        @for($i = 0; $i < count($list_of_repair); $i++)
                                                            <div class="col-2">
                                                                @if($list_of_repair[$i]->img_name != null)
                                                                    <img src="{{asset('img/report_repairs/'.$list_of_repair[$i]->img_name)}}" width="80%" onclick="show_img('{{'img/report_repairs/'.$list_of_repair[$i]->img_name}}')" />
                                                                @else
                                                                    <p>ไม่มี</p>
                                                                @endif
                                                            </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label>รายการ</label>
                                        <p>{{$list_of_repair[0]->list_report}}</p>
                                        <br />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <label>
                                            สถานะ
                                        </label>
                                        <select required class="form-select select_status" name="status_repair" {{$list_of_repair[0]->approve_report == false ? "" : "disabled"}}>
                                            @if($list_of_repair[0]->status_repair != "ยังไม่ดำเนินการ")
                                                    <option value="{{$list_of_repair[0]->status_repair}}">{{$list_of_repair[0]->status_repair}}</option>
                                                @if($list_of_repair[0]->status_repair == "กำลังดำเนินการ")
                                                    <option value="ดำเนินการสำเร็จ">ดำเนินการสำเร็จ</option>
                                                @elseif($list_of_repair[0]->status_repair == "ดำเนินการสำเร็จ")
                                                    <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                                @endif
                                            @else
                                                <option value="">ระบุ</option>
                                                <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
                                                <option value="ดำเนินการสำเร็จ">ดำเนินการสำเร็จ</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="description">
                                @if($list_of_repair[0]->status_repair == "กำลังดำเนินการ" || $list_of_repair[0]->status_repair == "ดำเนินการสำเร็จ" )
                                <div class="card text_description">
                                    <div class="card-body">
                                        <label>
                                            หมายเหตุ/รายละเอียด
                                        </label>
                                        <br />
                                            <textarea rows="4" {{$list_of_repair[0]->approve_report == false ? "" : "disabled"}} class="form-control" name="description">{{$list_of_repair[0]->description}}</textarea>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-12 operator">
                                @if($list_of_repair[0]->operator != null && $list_of_repair[0]->status_repair == "ดำเนินการสำเร็จ" && $list_of_repair[0]->operator != '')
                                    <div class="card select-operator">
                                        <div class="card-body">
                                            <label>เสร็จสิ้นโดย</label>
                                            <select class="form-select select-operator" id="operator" onchange="other_seelect(this.value)" {{$list_of_repair[0]->approve_report == false ? "" : "disabled"}} required name="operator">
                                                <option value="{{$list_of_repair[0]->operator}}">{{$list_of_repair[0]->operator}}</option>
                                                @if($list_of_repair[0]->operator != 'Operator')
                                                    <option value="Operator">Operation</option>
                                                @endif
                                                @if($list_of_repair[0]->operator != 'Reception')
                                                    <option value="Reception">Reception</option>
                                                @endif
                                                @if($list_of_repair[0]->operator != 'Engineer')
                                                    <option value="Engineer">Engineer</option>
                                                @endif
                                                @if($list_of_repair[0]->operator != 'Sustain')
                                                    <option value="Sustain">Sustain</option>
                                                @endif
                                                @if($list_of_repair[0]->operator != 'Programmer')
                                                    <option value="Programmer">Programmer</option>
                                                @endif
                                                @if($list_of_repair[0]->operator != 'Other')
                                                    <option value="Other">Other</option>
                                                @endif
                                            </select>
                                         </div>
                                    </div>
                                @endif
                            </div>
                            <div id="other">
                              
                            </div>
                            <div class="col-12">
                                @if($list_of_repair[0]->approve_report == false)
                                    <br />
                                    <br />
                                    <button type="submit" class="form-control btn btn-info">อัพเดทรายงาน</button>
                                @endif
                                <a href="{{url($list_of_repair[0]->approve_report == false ? "/list_repairs" : "/history_list_of_repair")}}" class="form-control btn">ย้อนกลับ</a>
                                <br />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <div class="col-1">
        </div>
    </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

            $('.select_status').change(function () {
                if($('.select_status').val() === "ดำเนินการสำเร็จ" && $('.select-operator').length < 1){
                    $('.operator').append('<div class="card select-operator">' +
                    '<div class="card-body">' +
                        '<label>ปฎิบัติงานโดย/แก้ไขโดย</label>' +
                            '<select class="form-select select-operator" id="operator" onchange="other_seelect(this.value)" required name="operator">' +
                                '<option value="">ระบุ</option>' +
                                '<option value="Operation">Operation</option>' +
                                '<option value="Reception">Reception</option>' +
                                '<option value="Engineer">Engineer</option>' +
                                '<option value="Sustain">Sustain</option>' +
                                '<option value="Programmer">Programmer</option>' +
                                '<option value="Other">Other</option>' +
                            '</select>' +
                        ' </div>' +
                    '</div>');
                }else{
                    $('.select-operator').remove();
                }
            });
            
            $('.approved').click(function (e) { 
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: 'ยืนยัน?',
                    text: 'ยืนยันการอนุมัติว่าได้เสร็จสิ้นเรียบร้อยแล้ว',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    showCancelButton: true,
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                    if(result.isConfirmed){
                        $('#approved_status').append('<input type="hidden" name="approved" value="true">');
                        form.submit();
                    }
                });
            });

            $('.select_status').change(function () { 
                if($('.text_description').length < 1){
                    $('#description').append('<div class="card text_description">' +
                        '<div class="card-body">' +
                            '<label>'+
                                ' หมายเหตุ/รายละเอียด'+
                                '</label>'+
                                '<br />'+
                                '<textarea rows="4" class="form-control" placeholder="อัพเดทงาน เช่น &#10; 1.กำลังดำเนินการ &#10; 2.เสร็จสิ้น" name="description"></textarea>'+
                        '</div>'+
                    '</div>');
                }
            });
        });

        function other_seelect(e){
            if(e === "Other"){
                $('#other').append('<div class="card text-other">' +
                    '<div class="card-body">' +
                '<div><label>ระบุ ทีม/พนักงาน ที่ต้องการมอบหมาย</label><input class="form-control" name="operator" required placeholder="เช่น Operator/Reception"/></div>' +
                '</div>' +
            '</div>');
            }else{
                $('.text-other').remove();
            }
        }
        
        function show_img(pString){
                Swal.fire({
                imageUrl: '../'+pString,
                showCloseButton: true,
                showConfirmButton: false,
                imageWidth: 300,
            })
        }
    </script>
</body>

</html>