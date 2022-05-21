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
        $list_of_repairs = list_of_repairs::orderByDesc('bookmark_checked')->orderByDesc('editor')->get(); //where('status_repair', '!=', 'ดำเนินการสำเร็จ')->
        return view('list_repairs', compact(['list_of_repairs']));
    }

    public function form_list_repair(){
        return view('form_list_repair');
    }

    public function process_repair_update(Request $request){
        $list_of_repairs = list_of_repairs::find($request->list_repair_id);

        if($request->status_repair != "ยังไม่ดำเนินการ"){
            $list_of_repairs->status_repair = $request->status_repair;
            $list_of_repairs->date_for_update = new DateTime();
            $list_of_repairs->operator = $request->operator != null ? $request->operator : '';
        }
        
        $list_of_repairs->description = $request->description;
        $list_of_repairs->new_update_active = "";

        $list_of_repairs->update();

        return redirect('list_repairs');
    }

    public function set_bookmark(Request $request){
        $list_of_repairs = list_of_repairs::find($request->bm_id);

        if($list_of_repairs->bookmark_checked == true){
            $list_of_repairs->bookmark_checked = false;
        }else{
            $list_of_repairs->bookmark_checked = true;
        }

        $list_of_repairs->save();

        return redirect('list_repairs');
    }

    public function process_repair($id){

        $checked_update = list_of_repairs::find($id);
        $checked_update->new_update_active = $checked_update->new_update_active != '' ? $checked_update->new_update_active . ',' . session('user_auth')[0]->user_id : session('user_auth')[0]->user_id;
        $checked_update->update();

        $list_of_repair = list_of_repairs::leftjoin('list_of_imgs', 'list_of_imgs.list_repair_id', '=', 'list_of_repairs.list_repair_id')->where('list_of_repairs.list_repair_id', '=', $id)->get();

        return view('process_repair', compact(['list_of_repair', 'id']));
    }

    public function insert_list_repair(Request $request){
        $list_of_repairs = new list_of_repairs;
        $list_of_repairs->list_report = $request->list_report;
        $list_of_repairs->date_of_report = new DateTime();
        $list_of_repairs->status_repair = "ยังไม่ดำเนินการ";
        $list_of_repairs->editor = $request->editor;
        $list_of_repairs->notifier = session('user_auth')[0]->user_firstname . " (". session('user_auth')[0]->user_nickname .")";
        $list_of_repairs->approve_report = false;

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
