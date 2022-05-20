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
                    <h4>สร้างรายงาน</h4>
                </div>
                <form action="{{url('/insert_list_repair/add')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <label>รายการ</label>
                                <textarea class="form-control" name="list_report" placeholder="กรุณากรอกรายการ" required></textarea>
                                <br />
                            </div>
                            <div class="col-12">
                              <label>มอบหมายให้</label>
                             <select class="form-select" required name="editor">
                                 <option value="">ระบุ</option>
                                 <option value="Operator">Operator</option>
                                 <option value="Reception">Reception</option>
                                 <option value="Engineer">Engineer</option>
                                 <option value="Programmer">Programmer</option>
                                 <option value="Other">Other</option>

                             </select>
                             <br />
                            </div>
                            <div class="col-12">
                                รูปภาพประกอบ (ถ้ามี, สูงสุด 2 รูป)
                                <div class="row" id="layout_img">
                                    <div class="col-12">
                                        <br />
                                    </div>
                                    <div class="col-3">
                                        <input type="file" name="img_name[]" accept="image/*" class="form-control"/>
                                    </div>
                                </div>
                                <br />
                                <input type="button" class="btn btn-sm btn-success add_img" value="เพิ่มรูปภาพ" />
                                <input type="button" class="btn btn-sm btn-danger remove_img" value="ลบ" />
                            </div>
                            <div class="col-12">
                            <br />
                                <button type="submit" class="form-control btn btn-info">สร้างรายงานการแจ้งซ่อม</button>
                                <a href="{{url('/list_repairs')}}" class="form-control btn">ย้อนกลับ</a>
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
    <script>
        $(document).ready(function () {
            $('.add_img').click(function() {
                if($('.img_dec').length < 1){
                    $('#layout_img').append('<div class="col-3 img_dec"><input type="file" name="img_name[]" class="form-control"/></div>');
                }
            });

            $('.remove_img').click(function() {
                $('.img_dec:last').remove();
            });
        });
    </script>
</body>

</html>