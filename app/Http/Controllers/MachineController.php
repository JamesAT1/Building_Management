<?php

namespace App\Http\Controllers;

use App\Models\check_process;
use App\Models\date_for_checkings;
use App\Models\machine_descriptions;
use App\Models\machine_room;
use App\Models\machine_rooms_check_days;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Phattarachai\LaravelMobileDetect\Agent;

date_default_timezone_set('Asia/Bangkok');

class MachineController extends Controller
{
    public function check_machine()
    {
        $dt = new DateTime();

        $date_for_checkings = date_for_checkings::orderByDesc('start_date')->first();
        if ($date_for_checkings != null && $date_for_checkings->start_date < $dt->format('Y-m-d H:i:s') && $date_for_checkings->end_date > $dt->format('Y-m-d H:i:s')) {

            $machine_rooms = machine_room::orderByDESC('machine_room_level')->get();
            $machine_rooms_check_days = machine_rooms_check_days::all()
                ->where('created_at', '>', $date_for_checkings->start_date)
                ->where('created_at', '<', $date_for_checkings->end_date);

            if (count($machine_rooms_check_days) == 0) {
                foreach ($machine_rooms as $machine_room) {
                    for ($i = 1; $i <= 3; $i++) {
                        $machine_rooms_check_day = new machine_rooms_check_days;
                        $machine_rooms_check_day->machine_room_id = $machine_room->machine_room_id;
                        $machine_rooms_check_day->machine_rooms_check_day_status = "ยังไม่ตรวจสอบ";
                        $machine_rooms_check_day->shift_worker_time = $i;
                        $machine_rooms_check_day->date_id = $date_for_checkings->date_id;
                        $machine_rooms_check_day->save();
                    }
                }
            }

            if (count($machine_rooms_check_days) != null) {
                $status_checking[] = $this->total_checked_status($machine_rooms_check_days);
            }

            return view('check_machine', compact(['machine_rooms', 'machine_rooms_check_days', 'status_checking']));
        } else {
            $create_date_for_checking = new date_for_checkings;
            $create_date_for_checking->start_date = ($dt)->format("Y-m-d ") . "07:00:00";
            $create_date_for_checking->end_date = ($dt->add(new DateInterval('P1D')))->format("Y-m-d ") . "06:59:59";
            $create_date_for_checking->save();

            $this->check_machine();
        }
        return view('check_machine');
    }

    public function report_check_machine()
    {
        $date_for_select = date_for_checkings::orderByDesc('start_date')->get();
        $date_for_checkings = date_for_checkings::orderByDesc('start_date')->limit(7)->get();
        $machine_rooms = machine_room::orderByDESC('machine_room_level')->get();

        foreach ($date_for_checkings as $date_for_checking) {
            $machine_rooms_check_days[] = machine_rooms_check_days::all()
                ->where('created_at', '>', $date_for_checking->start_date)
                ->where('created_at', '<', $date_for_checking->end_date);
        }
        $row_checked = "7";

        $date_checked = $date_for_checkings != null ? $date_for_checkings[0]->start_date : "00-00-0000 00:00:00";
        return view('report_check_machine', compact(['machine_rooms_check_days', 'machine_rooms', 'date_for_checkings', 'row_checked', 'date_checked', 'date_for_select']));
    }

    public function detail_report_check_machine($id, $room, $room_level, $date_check)
    {
        $machine_rooms_check_day = machine_rooms_check_days::find($id);

        return view('detail_report_check_machine', compact(['machine_rooms_check_day', 'room', 'room_level', 'date_check']));
    }

    public function row_report_check_machine(Request $request)
    {
        $date_for_select = date_for_checkings::orderByDesc('start_date')->get();
        $date_for_checkings = date_for_checkings::where('start_date', '<=', $request->date_checked)->orderByDesc('start_date')->limit($request->row_date_checked)->get();
        $machine_rooms = machine_room::orderByDESC('machine_room_level')->get();

        foreach ($date_for_checkings as $date_for_checking) {
            $machine_rooms_check_days[] = machine_rooms_check_days::all()
                ->where('created_at', '>', $date_for_checking->start_date)
                ->where('created_at', '<', $date_for_checking->end_date);
        }
        $row_checked = $request->row_date_checked;
        $date_checked = $request->date_checked;
        return view('report_check_machine', compact(['machine_rooms_check_days', 'machine_rooms', 'date_for_checkings', 'row_checked', 'date_checked', 'date_for_select']));
    }

    private function total_checked_status($machine_rooms_check_days)
    {
        $checked = 0;
        $normal = 0;
        $notCheck = 0;
        $problem = 0;
        $solve = 0;
        $morning = 0;
        $afternoon = 0;
        $evening = 0;

        foreach ($machine_rooms_check_days as $machine_rooms_check_day) {
            if ($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ" || $machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว" || $machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา") {
                $checked++;
            }
            if ($machine_rooms_check_day->machine_rooms_check_day_status == "ปกติ") {
                $normal++;
            }
            if ($machine_rooms_check_day->machine_rooms_check_day_status == "ยังไม่ตรวจสอบ") {
                $notCheck++;
                if ($machine_rooms_check_day->shift_worker_time == 1) {
                    $morning++;
                } else if ($machine_rooms_check_day->shift_worker_time == 2) {
                    $afternoon++;
                } else if ($machine_rooms_check_day->shift_worker_time == 3) {
                    $evening++;
                }
            }
            if ($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหาและแก้ไขแล้ว") {
                $solve++;
            }
            if ($machine_rooms_check_day->machine_rooms_check_day_status == "พบปัญหา") {
                $problem++;
            }
        }

        return compact(['checked', 'normal', 'notCheck', 'problem', 'solve', 'morning', 'afternoon', 'evening']);
    }

    public function insert_machine()
    {
        return view('insert_machine_room');
    }

    public function modify_machine_room($id)
    {
        $machine_room = machine_room::find($id);

        return view('modify_machine_room', compact(['machine_room']));
    }

    public function machine_update(Request $request)
    {
        $machine_room = machine_room::find($request->machine_room_id);

        $machine_room->machine_room_number = $request->machine_room_number;
        $machine_room->machine_room_level = $request->machine_room_level;
        $machine_room->machine_room_detail = $request->machine_room_detail == null ? $request->machine_room_detail = '' : $request->machine_room_detail;

        $machine_room->update();

        return redirect('check_machine');
    }

    public function checking_machine_update(Request $request)
    {
        $machine_rooms_check_days = machine_rooms_check_days::find($request->machine_rooms_check_day_id);

        $machine_rooms_check_days->machine_rooms_check_day_status = $request->machine_rooms_check_day_status;
        $machine_rooms_check_days->machine_rooms_check_day_description = $request->machine_rooms_check_day_description != null ? $request->machine_rooms_check_day_description : "";
        $machine_rooms_check_days->machine_room_problem = $request->machine_room_problem != null ? $request->machine_room_problem : "";

        if ($request->file('img_for_checked') != null) {

            $dt = new DateTime();
            $date_for_checkings = date_for_checkings::orderByDesc('start_date')->first();


            $resized = $this->resize_image($request->file('img_for_checked'), "/img/img_for_checked/" . (new datetime($date_for_checkings->start_date))->format('ตรวจห้องเครื่องวันที่ d-m-Y') . "/", 700);
            $machine_rooms_check_days->img_for_checked = $resized;
        } else {
            return redirect('check_machine');
        }

        $machine_rooms_check_days->update();

        if ($request->file('machine_description_image') != null) {
            $i = 0;
            foreach ($request->file('machine_description_image') as $save_data_problem) {
                $resized = $this->resize_image($save_data_problem, "/img/errormachine/", 700);

                $machine_description = new machine_descriptions;
                $machine_description->machine_rooms_check_day_id = $request->machine_rooms_check_day_id;
                $machine_description->machine_description_image = $resized;
                $machine_description->save();
            }
        }

        if ($request->machine_rooms_check_day_status == "พบปัญหา") {
            $this->setting_lineapi($request->room, "พบปัญหา", $request->machine_room_problem, $machine_rooms_check_days->shift_worker_time);
        }

        if ($machine_rooms_check_days->shift_worker_time == 1) {
            $machine_rooms_check_days->shift_worker_time = "เช้า";
        } else if ($machine_rooms_check_days->shift_worker_time == 2) {
            $machine_rooms_check_days->shift_worker_time = "บ่าย";
        } else if ($machine_rooms_check_days->shift_worker_time == 3) {
            $machine_rooms_check_days->shift_worker_time = "ค่ำ";
        }

        $this->log_process(session('user_auth')[0]->user_firstname . " " . session('user_auth')[0]->user_lastname . " (" . session('user_auth')[0]->user_nickname . ")", "ตรวจเช็คห้อง: $request->room ชั้น: $request->level รอบ: '$machine_rooms_check_days->shift_worker_time' สถานะ: $machine_rooms_check_days->machine_rooms_check_day_status");

        return redirect('check_machine');
    }

    public function checking_machine($id, $room, $room_id, $room_level)
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();
        $isPlateform = $agent->platform();

        $machine_rooms_check_days = machine_rooms_check_days::find($id);
        $machine_descriptions = machine_descriptions::where("machine_rooms_check_day_id", "=", $id)
            ->orderBy("created_at")
            ->get();
        return view('checking_machine', compact(['machine_rooms_check_days', 'machine_descriptions', 'room', 'isMobile', 'isPlateform', 'room_id', 'room_level']));
    }

    public function detail_check_machine($id, $room)
    {
        $dt = new DateTime();

        $date_for_checkings = date_for_checkings::orderByDesc('start_date')->first();

        if ($date_for_checkings->start_date < $dt->format('Y-m-d H:i:s') && $date_for_checkings->end_date > $dt->format('Y-m-d H:i:s')) {

            $machine_rooms = machine_room::join('machine_rooms_check_days', 'machine_rooms_check_days.machine_room_id', '=', 'machine_rooms.machine_room_id')
                ->where('machine_rooms_check_days.machine_room_id', '=', $id)
                ->where('machine_rooms_check_days.created_at', '>', $date_for_checkings->start_date)
                ->where('machine_rooms_check_days.created_at', '<', $date_for_checkings->end_date)
                ->orderBy('shift_worker_time')
                ->get();

            $machine_descriptions = machine_descriptions::where('machine_descriptions.created_at', '>', $date_for_checkings->start_date)
                ->where('machine_descriptions.created_at', '<', $date_for_checkings->end_date)
                ->get();
        }

        return view('detail_check_machine', compact(['machine_rooms', 'machine_descriptions', 'room', 'date_for_checkings']));
    }

    public function dalete_date_for_checkings(Request $request)
    {
        if (isset($request->date_delete)) {
            foreach ($request->date_delete as $date_delete) {

                $machine_rooms_check_days = machine_rooms_check_days::where('date_id', "=", $date_delete)->get();
                if($machine_rooms_check_days != null){
                    foreach ($machine_rooms_check_days as $machine_rooms_check_day) {
                        $machine_rooms_check_day->delete();
                    }
                }

                $date_for_checking = date_for_checkings::find($date_delete);

                if ($date_for_checking != null) {
                    $date_for_checking->delete();
                }
            }
        };

        return redirect()->back();
    }

    public function add_machine(Request $request)
    {
        $machine_room = new machine_room;
        $machine_room->machine_room_number = $request->machine_room_number;
        $machine_room->machine_room_level = $request->machine_room_level;
        $machine_room->machine_room_detail = $request->machine_room_detail == null ? $request->machine_room_detail = '' : $request->machine_room_detail;
        $date_for_checkings = date_for_checkings::orderByDesc('start_date')->first();

        $machine_room->save();

        for ($i = 1; $i <= 3; $i++) {
            $machine_rooms_check_days = new machine_rooms_check_days;
            $machine_rooms_check_days->machine_room_id = $machine_room->machine_room_id;
            $machine_rooms_check_days->machine_rooms_check_day_status = "ยังไม่ตรวจสอบ";
            $machine_rooms_check_days->date_id = $date_for_checkings->date_id;
            $machine_rooms_check_days->shift_worker_time = $i;
            $machine_rooms_check_days->save();
        }

        $this->log_process(session('user_auth')[0]->user_firstname . " " . session('user_auth')[0]->user_lastname . " (" . session('user_auth')[0]->user_nickname . ")", "สร้างข้อมูลห้อง: $request->machine_room_number ชั้น: $machine_room->machine_room_level");

        return redirect('check_machine');
    }

    public function remove_machine_room($id)
    {
        machine_room::destroy($id);
        return redirect()->back();
    }

    public function delete_descriptions_machine($id)
    {
        machine_descriptions::destroy($id);
        return redirect()->back();
    }

    private function setting_lineapi($room, $keyWord, $machine_room_problem, $shift)
    {
        if ($shift == 1) {
            $shift = "เช้า";
        } else if ($shift == 2) {
            $shift = "บ่าย";
        } else if ($shift == 3) {
            $shift = "ค่ำ";
        }

        $dt_check = new DateTime();
        $dt_check = $dt_check->format('H:i:s d/m/Y');
        $accessToken = "MUAbBSceAhfWQAwUeoEM0w2ugTYL3oJseYhpyzrZF7CxWA8j00AXMIDn7TR+SH8Rm7T1p+0M6/QSBknNiQPEy/tRRphUm81+rjqF+MI3PEpaKYROycjntA1W0ZPxIIRBkX3/lqeI5VOgpVNl8IdjWgdB04t89/1O/w1cDnyilFU=";
        $content = file_get_contents('php://input');
        $arrayJson = json_decode($content, true);
        $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";

        $arrayPostData['to'] = "C41cb3ee37813edfd30de7fcf4d2f70d6";
        $arrayPostData['messages'][0]['type'] = "text";

        if ($keyWord == "พบปัญหา") {
            $arrayPostData['messages'][0]['text'] = "---แจ้งตรวจพบปัญหา--- \nห้อง: " . $room . " ในรอบ: " . $shift . " \nเกิดพบการผิดปกติของระบบ \nเมื่อ เวลา-วันที่ " . $dt_check . "\nปัญหาที่พบ: $machine_room_problem";
        }

        return $this->pushMsg($arrayHeader, $arrayPostData);
    }

    private function pushMsg($arrayHeader, $arrayPostData)
    {
        $strUrl = "https://api.line.me/v2/bot/message/push";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return redirect()->back();
    }

    private function log_process($pLog_user, $pProcessing)
    {

        $agent = new Agent();

        $check_processes = new check_process;
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
