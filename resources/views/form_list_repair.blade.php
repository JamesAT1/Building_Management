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
        *{
            font-size: 0.94rem;
        }
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
                    <h4>สร้างรายงาน</h4>
                </div>
                <form action="{{url('/insert_list_repair/add')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label>รายการ</label>
                                <textarea class="form-control" rows="5" name="list_report" placeholder="กรุณากรอกรายการ" required></textarea>
                                <br />
                            </div>
                            <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <label>มอบหมายให้</label>
                                    <br />
                                    <br />
                                      <div class="row">
                                        <div class="col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editor[]" value="Operation" id="Operation">
                                                <label class="form-check-label" for="Operation">
                                                    Operation
                                                </label>
                                              </div>
                                        </div>
                                        <div class="col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editor[]" value="Reception" id="Reception">
                                                <label class="form-check-label" for="Reception">
                                                    Reception
                                                </label>
                                              </div>
                                        </div>
                                        <div class="col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editor[]" value="Engineer" id="Engineer">
                                                <label class="form-check-label" for="Engineer">
                                                    Engineer
                                                </label>
                                              </div>
                                        </div>
                                        <div class="col-sm-4 col-md-2">
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="editor[]" value="Sustain" id="Sustain">
                                              <label class="form-check-label" for="Sustain">
                                                    Sustain
                                              </label>
                                            </div>
                                      </div>
                                        <div class="col-sm-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="editor[]" value="Programmer" id="Programmer">
                                                <label class="form-check-label" for="Programmer">
                                                    Programmer
                                                </label>
                                              </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                             <br />
                             <div class="other">

                             </div>
                            </div>
                            <div class="col-12">
                                <label>ภาพประกอบ (ถ้ามี, สูงสุด 2 รูป)</label>
                                <div class="row" id="layout_img">
                                    <div class="col-12">
                                    </div>
                                    <div class="col-3">
                                        <input type="file" name="img_name[]" accept="image/*" class="form-control"/>
                                    </div>
                                </div>
                                <br />
                                <input type="button" class="btn btn-sm btn-info add_img" value="เพิ่ม" />
                                <input type="button" class="btn btn-sm btn-danger remove_img" value="ลบ" />
                                <br />
                            </div>
                            <div class="col-12">
                            <br />
                                <button type="submit" id="submit" class="form-control btn btn-info">สร้างรายงาน</button>
                                <a href="{{url('/list_repairs')}}" class="form-control btn">ย้อนกลับ</a>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('.add_img').click(function() {
                if($('.img_dec').length < 1){
                    $('#layout_img').append('<div class="col-3 img_dec"><input type="file" name="img_name[]" class="form-control"/></div>');
                }
            });

            $('#submit').click(function () { 
                checked = $('input[type=checkbox]:checked').length;
                
                if(!checked){
                    Swal.fire({
                        title: 'ผิดผลาด!',
                        text: 'เช็คข้อมูลให้ครบถ้วน',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false,
                        confirmButtonText: 'ตกลง',
                    });
                    return false;
                }
            });

            $('.assignment').change(function() {
                if($('.assignment').val() == "Other"){
                    $('.other').append('<div class="text-other">' +
                    '<label>ระบุ ทีม/พนักงาน ที่ต้องการมอบหมาย</label>' +
                        '<div class="form-check">' +
                            '<input class="form-check-input" type="checkbox" value="" id="Operator">' +
                            '<label class="form-check-label" for="Operator">' +
                                'Operator' +
                            '</label>' +
                        '</div>' +
                        '<br />' +
                    '<input class="form-control" name="editor" required placeholder="กรอก"/></div>');
                }else{
                    $('.text-other').remove();
                }
            });

            $('.remove_img').click(function() {
                $('.img_dec:last').remove();
            });
        });
    </script>
</body>

</html>