<?php

namespace App\Http\Controllers;

use App\Models\check_process;
use App\Models\list_of_imgs;
use App\Models\list_of_repairs;
use DateTime;
use Illuminate\Http\Request;
use Phattarachai\LaravelMobileDetect\Agent;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

date_default_timezone_set('Asia/Bangkok');

class List_repairController extends Controller
{

    public function list_repairs_select(Request $request){
        $editor = $request->editor;
        $list_of_repairs = list_of_repairs::where('approve_report', '!=', '1')->where('editor', '=', $request->editor)->orderByDesc('bookmark_checked')->orderByDesc('editor')->get(); //where('status_repair', '!=', 'ดำเนินการสำเร็จ')->
        return view('list_repairs', compact(['list_of_repairs', 'editor']));
    }

    public function list_repair(){
        $editor = "ทั้งหมด";
        $list_of_repairs = list_of_repairs::where('approve_report', '!=', '1')->orderByDesc('bookmark_checked')->orderByDesc('editor')->get(); //where('status_repair', '!=', 'ดำเนินการสำเร็จ')->
        return view('list_repairs', compact(['list_of_repairs', 'editor']));
    }

    public function history_list_of_repair(){
        $list_of_repairs = list_of_repairs::where('status_repair', '=', 'ดำเนินการสำเร็จ')->where('approve_report', '=', '1')->orderByDesc('bookmark_checked')->orderByDesc('editor')->get(); //where('status_repair', '!=', 'ดำเนินการสำเร็จ')->
        return view('history_list_of_repair', compact(['list_of_repairs']));
    }

    public function form_list_repair(){
        return view('form_list_repair');
    }

    public function process_repair_update(Request $request){
        $list_of_repairs = list_of_repairs::find($request->list_repair_id);
        if($request->status_repair == "ดำเนินการสำเร็จ"){
            $list_of_repairs->date_for_update = new DateTime();
        }
        if($request->approved != null && $request->approved  == "true"){
            $list_of_repairs->approve_report = true;
        }
        $list_of_repairs->status_repair = $request->status_repair;
        $list_of_repairs->operator = $request->operator != null ? $request->operator : '';
        $list_of_repairs->description = $request->description;
        $list_of_repairs->new_update_active = "";

        $list_of_repairs->update();

        $this->log_process(session('user_auth')[0]->user_firstname . " " . session('user_auth')[0]->user_lastname . " (" . session('user_auth')[0]->user_nickname . ")", "มอบหมายให้: " . $list_of_repairs->editor . "\nอัพเดทข้อมูลรายการ: " . $list_of_repairs->list_report . "\nโดยเปลี่ยนแปลงข้อมูลเป็น: " . $list_of_repairs->description);

        return redirect('list_repairs');
    }

    public function process_repair_modify(Request $request){
        $repair = list_of_repairs::find($request->list_repair_id);
        $repair->list_report = $request->list_report;
        $repair->editor = count($request->editor) > 1 ? "(". count($request->editor) .")" . implode('/', $request->editor) : implode('/', $request->editor);
        if($request->img_name != null && count($request->img_name) > 0){
            foreach($request->img_name as $img_name){
                $resized = $this->resize_image($img_name, "/img/report_repairs/", 900);

                $list_of_img = new list_of_imgs;
                $list_of_img->list_repair_id = $request->list_repair_id;
                $list_of_img->img_name = $resized;
                $list_of_img->save();
            }
        }
        $repair->update();
        return redirect('list_repairs');
    }

    public function remove_repair($id){
        $list_of_repairs = list_of_repairs::find($id)->delete();
        return redirect()->back();
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
        $has_key_update = false;
        $checked_update = list_of_repairs::find($id);
        
        if($checked_update->new_update_active == "0"){
            $checked_update->new_update_active = "";
        }
        
        foreach(explode(',', $checked_update->new_update_active) as $new_update){
            if($new_update == session('user_auth')[0]->user_id){
                $has_key_update = true;
                break;
            }
        }

        if(!$has_key_update){
            $checked_update->new_update_active = $checked_update->new_update_active != '' ? $checked_update->new_update_active . ',' . session('user_auth')[0]->user_id : session('user_auth')[0]->user_id;
        }
        
        $checked_update->update();

        $list_of_repair = list_of_repairs::leftjoin('list_of_imgs', 'list_of_imgs.list_repair_id', '=', 'list_of_repairs.list_repair_id')->where('list_of_repairs.list_repair_id', '=', $id)->get();
        return view('process_repair', compact(['list_of_repair', 'id']));
    }

    public function form_modify_repair($id){
        $repair = list_of_repairs::where('list_repair_id', '=', $id)->get();
        $list_of_imgs = list_of_imgs::where('list_repair_id', '=', $id)->get();
        $secondstring = strpos($repair[0]->editor, ')');
        if($secondstring != false){
            $repair[0]->editor = substr($repair[0]->editor, $secondstring + 1);
        }

        return view('modify_repair', compact(['repair', 'list_of_imgs', 'id']));
    }

    public function remove_img_repair($id){
        list_of_imgs::find($id)->delete();
        return redirect()->back();
    }

    public function insert_list_repair(Request $request){
        $list_of_repairs = new list_of_repairs;
        $list_of_repairs->list_report = $request->list_report;
        $list_of_repairs->date_of_report = new DateTime();
        $list_of_repairs->status_repair = "ยังไม่ดำเนินการ";
        $list_of_repairs->new_update_active = "0";

        $list_of_repairs->editor = count($request->editor) > 1 ? "(". count($request->editor) .")" . implode('/', $request->editor) : implode('/', $request->editor);
        $list_of_repairs->notifier = session('user_auth')[0]->user_firstname . " (". session('user_auth')[0]->user_nickname .")";
        $list_of_repairs->approve_report = false;

        $list_of_repairs->save();

        if($request->file('img_name') != null && count($request->file('img_name')) > 0){
            $i = 0;
            foreach($request->file('img_name') as $img_name){
                // $name_generagtion = hexdec(uniqid());
                // $name_set = $name_generagtion . "." . ($img_name->getClientOriginalExtension() == "" ? "jpg" : $img_name->getClientOriginalExtension());
                // ($request->file('img_name')[$i++])->move("img/report_repairs", $name_set);

                $resized = $this->resize_image($img_name, "/img/report_repairs/", 900);

                $list_of_img = new list_of_imgs;
                $list_of_img->list_repair_id = $list_of_repairs->list_repair_id;
                $list_of_img->img_name = $resized;
                $list_of_img->save();
            }
        }

        $this->log_process(session('user_auth')[0]->user_firstname . " " . session('user_auth')[0]->user_lastname . " (" . session('user_auth')[0]->user_nickname . ")", "มอบหมายให้: " . $list_of_repairs->editor . "\nเพิ่มมูลรายการ: " . $list_of_repairs->list_report);

        return redirect('list_repairs');
    }

    private function log_process($pLog_user, $pProcessing)
    {
        $agent = new Agent();

        $check_processes = new check_process();
        $check_processes->log_user = $pLog_user;
        $check_processes->log_prosessing = $pProcessing;
        $check_processes->log_agent = $agent->platform();

        $check_processes->save();
    }

    private function resize_image($image_file, $Image_path, $width_resize)
    {
        $Image = Image::make($image_file);
        $Image_path = public_path($Image_path);

        if (!File::exists($Image_path)) {
            File::makeDirectory($Image_path);
        }

        $image_name = hexdec(uniqid()) . (new DateTime())->format('d-m-Y-H-i-s') . '.jpg';

        $Image->resize($width_resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $Image->save($Image_path . $image_name);

        return $image_name;
    }
}
