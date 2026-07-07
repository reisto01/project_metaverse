<?php

namespace App\Http\Controllers;

use App\Mail\contactUs_Mail;
use App\Mail\SendEmail;
use App\Models\tb_mail;
use App\Models\user_reg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;

class contactUs_controller extends Controller
{
    // public function index(){

    //     $details = [
    //     'title' => 'Mail from websitepercobaan.com',
    //     'body' => 'Ya Gitu'
    //     ];
       
    //     Mail::to('adityayatma@gmail.com')->send(new contactUs_Mail($details));
       
    //     dd("Email sudah terkirim.");
    
        
    //     }
        
        public function index()
        {
            if (session()->get('username') == "") {
                return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
            }
            return view('userpage.contact_us');
        }

        public function faq()
        {
            return view('userpage.faq');
        }

        public function profile()
        {
            if (session()->get('username') == "") {
                return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
            }
            $data['user'] = user_reg::where([['is_deleted',1],['username',session()->get('username')]])->first();
           return view('userpage.profile',$data);
        }

        public function profile_post()
        {
            $data['user'] = user_reg::where([['is_deleted',1],['role_id',2]])->first();
           return view('userpage.profile',$data);
        }

        public function admin_side(Request $request)
        {
            $search = $request->search_me;
            if ($search != null) {
                $cond = [['is_deleted', 1], ['username', 'LIKE', '%' . $search . '%']];
            } else {
                $cond = [['is_deleted', 1]];
            }
            $page = 4;
            $data['Page'] = "Kelola Email";
            $data['mail'] = tb_mail::where($cond)->paginate($page);
            $data['get_total'] = tb_mail::where($cond)->count();
            $data['page_now'] = $request->page;
            $data['search'] = $request->page;
            $round = ceil($data['get_total'] / $page);
            $data['pagin'] = $round;
            if (Session()->get('username')) {
                return view("adminpage.contactUs",$data);
            } else {
                return redirect("/login");
            }
            
        }

        public function contactUs_post(Request $request)
        {
            if (session()->get('username') == "") {
                return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
            }
            
            $name = $request->name;
            $email = $request->email;
            $message = $request->message;
            $get_data = [
                'username' => $name,
                'email' => $email,
                'message' => $message
            ];
            tb_mail::create($get_data); if (session()->get('username') == "") {
                return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
            };
            return redirect('/contactUs');
        }

        public function delete_contact_us(Request $request)
        {
            $id = $request->id_data;
            // echo($id);
            tb_mail::where('id', $id)->update(['is_deleted' => 0]);
            return redirect('contactUs_admin');
        }

        public function answereMail(Request $request)
        {
            if (session()->get('username') == "") {
                return redirect('/login')->with('alert-notif', 'Anda Harus Login Terlebih Dahulu');
            }
            $id =  $request->id;
            $email = $request->name;
            $reply = $request->reply;
            $get_data = [
                'status' =>  2,
                'answere' =>  $reply,
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            $data = [
                "title" => 'Balasan LandMetaverse.com',
                'body' => $reply
            ];
            // echo $email;
            Mail::to($email)->send(new contactUs_Mail($data));
            tb_mail::where('id', $id)->update($get_data);

            return redirect('contactUs_admin');
        }

        public function getData($id)
        {
            $data['data'] = tb_mail::where([['id', $id], ['is_deleted', 1]])->first();
            return Response()->json($data);
        }

        public function contactUs_print(Request $request)
        {
                   // $this->laporan_transaksi($request);
        // mengambil data dari session untuk diprint dalam bentuk dokumen

        // $data['gambar'] = $request->input('cavas_here');
        // $data['jumlah_pengunjung'] = 0;
        // foreach ($data['transaksi'] as $value) {
        //     $data['jumlah_pengunjung'] += $value->jumlah_tiket_dewasa + $value->jumlah_tiket_anak;
        // }
        $data['mail'] = tb_mail::where('id', $request->id_data1)->get();
    // print_r($data['jenislaporan']);
        $view = view("adminpage.laporan.downloadLaporan",$data);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Laporan Balas Contact Us");
        return view("adminpage.laporan.downloadLaporan",$data);
        // return redirect('/');
        }
}
