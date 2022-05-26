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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Builder Management Program</title>
</head>
<style>
    table{
        font-size: 0.83rem;
    }
    table .badge{
        font-size: 0.80rem;
    }
    .star {
        visibility:hidden;
        font-size:15px;
        cursor:pointer;
    }
    .star:before {
        font-family: "Font Awesome 5 Free";
        content: "\f005";
        visibility:visible;
        color: #17adc4;

    }
    .star:checked:before {
        font-family: "Font Awesome 5 Free";
        content: "\f005";
        font-weight: 900;
        color: #17adc4;

    }
</style>
<body>
    @extends('layouts.main_template')
    @section('content')
            <div class="card">
                <div class="card-header">
                    <h4>
                        งานที่มอบหมาย/แจ้งซ่อม
                        <a href="{{url('/insert_list_repair')}}" class="btn btn-info" style="float: right;">สร้างรายงาน</a>
                    </h4>
                </div>
                <div>
                    <br />
                    <a href="{{url('/history_list_of_repair')}}" class="btn btn-light" style="margin-left: 10px;"><i class="fa-solid fa-clock-rotate-left"></i> ดูประวัติที่เสร็จสิ้นแล้ว</a>
                    <span style="float: right; margin-right: 15px;">
                        <form method="POST" action="{{url('/list_repairs/select')}}">
                            @csrf
                            <select class="form-select" name="editor" onchange="this.form.submit()">
                                <option value="">{{$editor != null ? $editor : ทั้งหมด}}</option>
                                @if($editor != null && $editor != "ทั้งหมด")
                                    <option value="ทั้งหมด">ทั้งหมด</option>
                                @endif
                                @if($editor != null && $editor != "Bookmark")
                                <option value="Bookmark">Bookmark</option>
                                @endif
                                @if($editor != "Reception")
                                    <option value="Reception">Reception</option>
                                @endif
                                @if($editor != "Operation")
                                    <option value="Operation">Operation</option>
                                @endif
                                @if($editor != "Programmer")
                                    <option value="Programmer">Programmer</option>
                                @endif
                                @if($editor != "Engineer")
                                    <option value="Engineer">Engineer</option>
                                @endif
                                @if($editor != "Sustain")
                                    <option value="Sustain">Sustain</option>
                                @endif
                            </select>
                        </form>
                    </span>
                </div>
                <div class="card-body">
                   
                    <div style="overflow: auto; overflow-x:auto;">
                    <table class="table table-hover" width="100%">
                        <thead class="header-table">
                            <tr>
                                <th width="3%">แท็ก</th>
                                <th width="2%">ที่</th>
                                <th width="10%">วันที่แจ้ง</th>
                                <th width="21%">รายการ</th>
                                <th width="3%">Delay</th>
                                <th width="13%"><center>ผู้ดำเนินการแจ้ง</center></th>
                                <th width="13%"><center>มอบหมาย</center></th>
                                <th width="10%"><center>สถานะ</center></th>
                                <th width="20%">หมายเหตุ/รายละเอียด</th>
                                <th width="1%"><center>แก้ไข</center></th>
                                <th width="1%"><center>ลบ</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count_repair = 1 ?>
                            @foreach($list_of_repairs as $list_of_repair)
                                <tr>
                                    <td>
                                        <form action="{{url('set_bookmark')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="bm_id" value="{{$list_of_repair->list_repair_id}}" />
                                            @if($list_of_repair->bookmark_checked == true)
                                                <input class="star" name="bm_status" value="1" checked type="checkbox" onclick="this.form.submit()">
                                            @else
                                                <input class="star" name="bm_status" value="0" type="checkbox" onclick="this.form.submit()">
                                            @endif
                                        </form>
                                    </td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">{{$count_repair++}}</td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">
                                        {{(new Datetime($list_of_repair->date_of_report))->format('d-m-Y')}}
                                    </td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">
                                        <?php echo strlen($list_of_repair->list_report) > 60 ? mb_substr($list_of_repair->list_report, 0, 60, 'utf-8')."...." : $list_of_repair->list_report; ?>
                                    </td>
                                    @if($list_of_repair->date_for_update != "0000-00-00 00:00:00" && $list_of_repair->status_repair == "ดำเนินการสำเร็จ")
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{((new Datetime($list_of_repair->date_of_report))->diff(new Datetime($list_of_repair->date_for_update), true))->format('%a')}}</center></td>
                                    @else
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{((new Datetime($list_of_repair->date_of_report))->diff(new Datetime, true))->format('%a')}}</center></td>
                                    @endif
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{$list_of_repair->notifier}}</center></td>
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{$list_of_repair->editor}}</center></td>
                                    @if($list_of_repair->status_repair == "ยังไม่ดำเนินการ")
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: red;"><center>ยังไม่ดำเนินการ</center></td>
                                    @elseif($list_of_repair->status_repair == "กำลังดำเนินการ")
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: #f1c02b;"><center>กำลังดำเนินการ</center></td>
                                    @elseif($list_of_repair->status_repair == "ดำเนินการสำเร็จ")
                                        @if($list_of_repair->approve_report != true)
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: rgb(0, 182, 9);"><center>รออนุมัติ</center></td>
                                        @else
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: rgb(0, 182, 9);"><center>ดำเนินการสำเร็จ</center></td>
                                        @endif
                                    @endif
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="position: relative;">
                                            @if($list_of_repair->description != null && $list_of_repair->description != '')
                                                <?php echo strlen($list_of_repair->description) > 30 ? mb_substr($list_of_repair->description, 0, 30, 'utf-8') . "..." : $list_of_repair->description ; ?>
                                            @else
                                                <center>-</center>
                                            @endif
                                                <?php $count_update = 0 ?>
                                                @foreach(explode(',', $list_of_repair->new_update_active) as $acount_id)
                                                    @if($acount_id != "0")
                                                        <?php $count_update++ ?>
                                                        @if($acount_id == session('user_auth')[0]->user_id)
                                                            <?php break; ?>
                                                        @elseif(count(explode(',', $list_of_repair->new_update_active)) == $count_update && $acount_id != session('user_auth')[0]->user_id)
                                                            <span style="position: absolute; right:5%; top:30%;" class="badge bg-danger"><span style="color:white;">update</span></span>
                                                        @endif
                                                    @else
                                                        <span style="position: absolute; right:5%; top:30%;" class="badge bg-success"><span style="color:white;">new</span></span>
                                                    @endif
                                                @endforeach
                                        </td>
                                        <td><a href="{{url('/form_modify_repair/'.$list_of_repair->list_repair_id)}}" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen"></i></a></td>
                                        <td><a href="#" onclick="delete_repair('{{$list_of_repair->list_repair_id}}')" class="btn btn-sm btn-outline-danger delete_list"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function delete_repair(id){
            Swal.fire({
                title: 'ลบข้อมูล?',
                text: "คุณต้องการลบข้อมูลรายงาน ใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "/remove_repair/" + id;
                }
            });
        }
    </script>
   
</body>

</html>