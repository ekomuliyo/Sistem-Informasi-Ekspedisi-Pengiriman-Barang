<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        date_default_timezone_set('Asia/Jakarta'); // mengatur timezone waktu indonesia

        $schedule->call(function(){
            $pengiriman = DB::select('SELECT 
                pengiriman.nama_pengirim, pengiriman.no_hp_pengirim,
                COUNT(pengiriman.id_user) as total_pengiriman, 
                SUM(pengiriman.jumlah_biaya) as total_bayar 
                FROM `pengiriman` INNER JOIN users ON pengiriman.id_user = users.id 
                WHERE pengiriman.metode_pembayaran = 4 
                AND pengiriman.status_bayar = 0
                GROUP BY pengiriman.id_user, pengiriman.status_bayar');



            foreach ($pengiriman as $data) {
                // DB::table('logs')->insert([
                //     'nama' => $data->nama_pengirim,
                //     'no_wa' => $data->no_hp_pengirim,
                //     'keterangan' => $keterangan,
                //     'created_at' => date("Y-m-d h:i:s") 
                // ]);
                
                // membuat format pesan
                $keterangan = "Hai $data->nama_pengirim, selamat pagi, silahkan lakukan pembayaran " .
                "seluruh pengiriman kamu di cabang terdekat kami, sebelum jatuh tempo, " . 
                "total pengiriman kamu adalah $data->total_pengiriman kali, dan jumlah yang " . 
                "harus dibayar sebesar Rp. " . number_format($data->total_bayar,0,'.','.');
                
                // format nomor hp di ubah dari awal 08 menjadi 628, sesuai dengan format nomor seluler di indonesia
                $no = $data->no_hp_pengirim;
                $prefix = '0';
                $str = $no;
                if (substr($str, 0, strlen($prefix)) == $prefix) {$str = substr($str, strlen($prefix));}
                $no_wa = "62".$str;

                // mengirim pesan ke wa
                $my_apikey = config('api_key'); 
                $destination = $no_wa; 
                $message = $keterangan; 
                $api_url = "http://panel.apiwha.com/send_message.php"; 
                $api_url .= "?apikey=". urlencode ($my_apikey); 
                $api_url .= "&number=". urlencode ($destination); 
                $api_url .= "&text=". urlencode ($message); 
                $my_result_object = json_decode(file_get_contents($api_url, false));
            }


        })->everyMinute();
        // ->monthlyOn(date('d')-1, '9:00');
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
