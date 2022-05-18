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
                    <h3>
                        รายงานการแจ้งซ่อม 
                        <a href="{{url('/insert_list_repair')}}" class="btn btn-info" style="float: right;">สร้างรายงานการแจ้งซ่อม</a>
                    </h3>
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
                                <th width="13%"><center>ผู้แก้ไข</center></th>
                                <th width="7%"><center>สถานะ</center></th>
                                <th width="15%"><center>ผู้ทำการแก้ไข</center></th>
                                <th width="20%">หมายเหตุ/รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>08/05/2022</td>
                                <td>ชั้น 7 เครื่องจ่ายไฟมีปัญหา ไหลไม่หยุด</td>
                                <td>62</td>
                                <td>โชค ภาสวุฒิ</td>
                                <td>จูน อนุชิต</td>
                                <td style="color: green;"><b>แก้ไขสำเร็จ</b></td>
                                <td>
                                    <span class="badge rounded-pill bg-success" style="margin: 1.8px">จูน อนุชิต</span>
                                    <span class="badge rounded-pill bg-success" style="margin: 1.8px">เจน ณัฐกมล</span>
                                    <span class="badge rounded-pill bg-success" style="margin: 1.8px">โชค ภาสวุฒิ</span>
                                </td>
                                <td>มาเวลพึ่งนำไปเคลมวันที่ 15 มี.ค.</td>
                            </tr> --}}

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
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">{{$list_of_repairs->firstItem() + $loop->index}}</td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">
                                        {{(new Datetime($list_of_repair->date_of_report))->format('d-m-Y')}}
                                    </td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">{{$list_of_repair->list_report}}</td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{((new Datetime($list_of_repair->date_of_report))->diff(new Datetime))->format('%d')}}</center></td>
                                    <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>{{$list_of_repair->notifier}}</center></td>

                                    @if($list_of_repair->status_repair != "ยังไม่แก้ไข")
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>จูน อนุชิต</center></td>
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: red;"><center><b>ยังไม่แก้ไข</b></center></td>
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">
                                            <center>
                                                <span class="badge rounded-pill bg-success" style="margin: 1.8px">จูน อนุชิต</span>
                                                <span class="badge rounded-pill bg-success" style="margin: 1.8px">เจน ณัฐกมล</span>
                                                <span class="badge rounded-pill bg-success" style="margin: 1.8px">โชค ภาสวุฒิ</span>
                                            </center>
                                        </td>
                                        <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'">มาเวลพึ่งนำไปเคลมวันที่ 15 มี.ค.</td>
                                    @else
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>-</center></td>
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'" style="color: red;"><b>ยังไม่แก้ไข</b></td>
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>-</center></td>
                                            <td onclick="location.href = '/process_repair/{{$list_of_repair->list_repair_id}}'"><center>-</center></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$list_of_repairs->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    @endsection

   
</body>

</html>