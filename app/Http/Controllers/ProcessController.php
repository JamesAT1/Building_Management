<?php

namespace App\Http\Controllers;

use App\Models\dateofworks;
use App\Models\user_accounts;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

date_default_timezone_set('Asia/Bangkok');

class ProcessController extends Controller
{
    public function __construct(){
    }

    public function login(){
        return view('login');
    }

    public function logout(Request $request){
        $request->session()->forget('user_auth');
        session()->flush();
        session()->save();
        return redirect('/');
    }

    public function check_login(Request $request){
        if (isset($request)) {
            $user_auth = DB::table('user_accounts')->where('user_name', '=', $request->user_name, 'and', 'user_pass', '=', $request->user_pass)->get();

            if (isset($user_auth) && isset($user_auth[0]) && $user_auth[0]->user_name && $user_auth[0]->user_pass) {
                $request->session()->put('user_auth', $user_auth);
                return redirect('/check_in');
            }
        }
        return view('login');
    }

    function index(){
        return view('index');
    }

    public function checkIn_management(){
        $dt = new DateTime();
        
        // $user_account = user_account::all();
        // $user_account = DB::select('select * from user_account');

        // $user_account = DB::table('user_accounts')
        //     ->select('*')
        //     ->distinct()
        //     ->leftJoin('dateofworks', 'user_accounts.user_id', '=', 'dateofworks.user_id')
        //     ->orderByDesc('dateofworks.date_start_work')
        //     ->groupBy('user_accounts.user_name')
        //     ->get();

        $user_account = DB::table('user_accounts')->get();
        $dateofworks = DB::table('dateofworks')->where('date_start_work', '>', ($dt->diff(new DateTime("0000-01-00 00:00:00")))->format('%y-%m-%d 00:00:00'))->orderByDesc('date_start_work')->get();

        return view('checkIn_management', compact(['user_account', 'dateofworks']));
    }

    public function show_user(){
        // Paginator::useBootstrap();

        // query builder plan
        // $user_account = DB::table('user_accounts')->get();
        // $user_account = DB::select('select * from user_account');
        //$user_account = DB::table('user_account')->paginate(10);

        // get eloquent plan
        // $user_account = user_account::all();
        $user_account = user_accounts::paginate(10);

        return view('show_user', compact('user_account'));
    }

    public function check_working(){
        if (session()->has('user_auth')) {

            $dateofworks = DB::table('dateofworks')
                ->where('user_id', '=', session('user_auth')[0]->user_id)
                ->orderByDesc('date_start_work')->paginate(6);

            $check_in_status = DB::table('user_accounts')
                ->select('*')
                ->distinct()
                ->leftJoin('dateofworks', 'user_accounts.user_id', '=', 'dateofworks.user_id')
                ->where('dateofworks.user_id', '=', session('user_auth')[0]->user_id)
                ->orderByDesc('dateofworks.date_start_work')
                ->limit(1)
                ->get();
                
                if(count($check_in_status) == 0){
                    $check_in_status = null;
                }
        }

        return view('/check_in', ['dateofworks' => $dateofworks, 'check_in_status' => $check_in_status]);
    }

    public function modify_user($id){
        $user_account = user_accounts::find($id);
        
        return view('modify_user', compact(['user_account']));
    }

    public function user_update(Request $request){

        $user_account = user_accounts::find($request->user_id);
        $user_account->user_name = $request->user_name;
        $user_account->user_pass = $request->user_pass;
        $user_account->user_firstname = $request->user_firstname;
        $user_account->user_lastname = $request->user_lastname;
        $user_account->user_img = $request->user_img;
        $user_account->user_nickname = $request->user_nickname;
        $user_account->user_begindatetowork = $request->user_begindatetowork;
        $user_account->user_birth = $request->user_birth;
        $user_account->user_contrack = "";
        $user_account->user_rule_status = 0;
        $user_account->user_sick_leave = 0;
        $user_account->user_personal_leave = 0;
        $user_account->user_vacation_leave = 0;

        // insert eloquent
        $user_account->update();

        return redirect('show_user');
    }

    public function check_in(Request $request){
        $dt = new DateTime();
        if (session()->has('user_auth') || $request->user_id != null) {
            $date_start_work = $dt;
            $user_id = $request->user_id;

            if ($request->datework_check == 0) {
                $data = array('user_id' => $user_id, 'date_start_work' => $date_start_work, 'date_off_work' => '0000-00-00 00:00:00', 'datework_check' => 1);
                DB::table('dateofworks')->insert($data);
            } else {
                $dateofworks = new dateofworks();
                // $dateofworks = DB::table('dateofworks')->where('datework_id', '=', $request->datework_check)->limit(1);
                $dateofworks = dateofworks::find($request->datework_id);
                $dateofworks->user_id = $user_id;
                $dateofworks->datework_check = 0;
                $dateofworks->date_off_work = $dt;

                $dateofworks->update();
            }

            return $this->setting_lineapi($request->emp_name, $request->datework_check);
            // return redirect('/check_in');
        }
    }

    public function insert_user(){
        return view('insert_user');
    }

    public function add_user(Request $request){
        $request->validate(
            [
                'user_name' => 'required|unique:user_accounts|max:15'
            ],
            [
                'user_name.required' => 'กรุณากรอกข้อมูล',
                'user_name.max' => 'กรอกข้อมูลไม่เกิน 15ตัวอักษร',
                'user_pass' => ['required']
            ]
        );

        $user_account = new user_accounts;
        $user_account->user_name = $request->user_name;
        $user_account->user_pass = $request->user_pass;
        $user_account->user_firstname = $request->user_firstname;
        $user_account->user_lastname = $request->user_lastname;
        $user_account->user_img = $request->user_img;
        $user_account->user_nickname = $request->user_nickname;
        $user_account->user_begindatetowork = $request->user_begindatetowork;
        $user_account->user_birth = $request->user_birth;
        $user_account->user_contrack = "";
        $user_account->user_rule_status = 0;
        $user_account->user_sick_leave = 0;
        $user_account->user_personal_leave = 0;
        $user_account->user_vacation_leave = 0;

        // insert eloquent
        $user_account->save();

        return view('alert.alert_menu');
    }

    function setting_lineapi($userAccount, $keyword){
        $dt_check = new DateTime();
        $dt_check = $dt_check->format('H:i:s d-m-Y');
        $accessToken = "MUAbBSceAhfWQAwUeoEM0w2ugTYL3oJseYhpyzrZF7CxWA8j00AXMIDn7TR+SH8Rm7T1p+0M6/QSBknNiQPEy/tRRphUm81+rjqF+MI3PEpaKYROycjntA1W0ZPxIIRBkX3/lqeI5VOgpVNl8IdjWgdB04t89/1O/w1cDnyilFU=";
        $content = file_get_contents('php://input');
        $arrayJson = json_decode($content, true);
        $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer {$accessToken}";

        $arrayPostData['to'] = "C41cb3ee37813edfd30de7fcf4d2f70d6";
        $arrayPostData['messages'][0]['type'] = "text";
        if($keyword == 0){
            $arrayPostData['messages'][0]['text'] = "'CHECK IN' \n " . $userAccount . " \n เมื่อ เวลา-วันที่ " . $dt_check;
        }else{
            $arrayPostData['messages'][0]['text'] = "'CHECK OUT' \n " . $userAccount . " \n เมื่อ เวลา-วันที่ " . $dt_check;
        }

        return $this->pushMsg($arrayHeader, $arrayPostData);
    }

    function pushMsg($arrayHeader, $arrayPostData){
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

        return redirect('/check_in');
    }
}
