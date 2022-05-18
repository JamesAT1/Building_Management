<?php

namespace App\Http\Controllers;

use App\Models\list_of_imgs;
use App\Models\list_of_repairs;
use DateTime;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Bangkok');

class List_repairController extends Controller
{
    public function list_repair(){
        $list_of_repairs = list_of_repairs::paginate(10);
        return view('list_repairs', compact(['list_of_repairs']));
    }

    public function form_list_repair(){
        return view('form_list_repair');
    }

    public function insert_list_repair(Request $request){
        $list_of_repairs = new list_of_repairs;
        $list_of_repairs->list_report = $request->list_report;
        $list_of_repairs->date_of_report = new DateTime();
        $list_of_repairs->status_repair = "ยังไม่แก้ไข";
        $list_of_repairs->notifier = session('user_auth')[0]->user_firstname . " (". session('user_auth')[0]->user_nickname .")";

        $list_of_repairs->save();

        if($request->file('img_name') != null && count($request->file('img_name')) > 0){
            $i = 0;
            foreach($request->file('img_name') as $img_name){
                $name_generagtion = hexdec(uniqid());
                $name_set = $name_generagtion . "." . ($img_name->getClientOriginalExtension() == "" ? "jpg" : $img_name->getClientOriginalExtension());
                ($request->file('img_name')[$i++])->move("img/report_repairs", $name_set);

                $list_of_img = new list_of_imgs;
                $list_of_img->list_repair_id = $list_of_repairs->list_repair_id;
                $list_of_img->img_name = $name_set;
                $list_of_img->save();
            }
        }
        return redirect('list_repairs');
    }
}
