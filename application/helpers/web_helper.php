<?php 


    function cek_login(){

        $CI =& get_instance();
        if($CI->session->userdata('login') != TRUE){
            redirect('login');
        }else{
            return TRUE;
        }
    }
 function is_dupak(){
       // cek_login();
        $CI =& get_instance();
        if($CI->session->userdata('is_dupak') == 1){
            return TRUE;
        }else{
            redirect('login');
        }

    }


    function is_admin(){
       // cek_login();
        $CI =& get_instance();
        if($CI->session->userdata('is_admin') == 1){
            return TRUE;
        }else{
            redirect('backend/login');
        }

    }


    function is_penguji(){
        // cek_login();
         $CI =& get_instance();
         if($CI->session->userdata('is_penguji') == 1){
             return TRUE;
         }else{
             redirect('login');
         }
 
     }
 

    function alert($text,$type){
        $CI =& get_instance();
        switch($type){
            case "danger": 
                return $CI->session->set_flashdata('item','<div class="alert alert-danger">'.$text.'</div>');
            break;
            case "info":
             return $CI->session->set_flashdata('item','<div class="alert alert-info">'.$text.'</div>');
            break;
            case "success":
            return $CI->session->set_flashdata('item','<div class="alert alert-success">'.$text.'</div>');
           break;
            
            
        }


    }


    function debug($dt){
        echo "<pre>";
        print_r($dt);
        exit;
    }

 
    if ( ! function_exists('tgl_indo'))
    {
        function tgl_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
    }
      
    if ( ! function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
    }
 
    //Format Shortdate
    if ( ! function_exists('shortdate_indo'))
    {
        function shortdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
    }
      
    if ( ! function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
    }
 
    //Format Medium date
    if ( ! function_exists('mediumdate_indo'))
    {
        function mediumdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }
      
    if ( ! function_exists('medium_bulan'))
    {
        function medium_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Ags";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
    }

    function cek_libur($tgl){
        $CI =& get_instance();
        $cek = $CI->db->query("SELECT count(*),keterangan FROM tbl_holiday WHERE DATE(tgl_holiday) = '$tgl'")->row_array();
        return $cek;
    }
     
    //Long date indo Format
    if ( ! function_exists('longdate_indo'))
    {
        function longdate_indo($tanggal)
        {
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $nama_hari.','.$tgl.' '.$bulan.' '.$thn;
        }
    }


    function namahari($tanggal){
        //fungsi mencari namahari
        //format $tgl YYYY-MM-DD
        //harviacode.com
        $tgl=substr($tanggal,8,2);
        $bln=substr($tanggal,5,2);
        $thn=substr($tanggal,0,4);
        $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
        switch($info){
            case '0': return "Minggu"; break;
            case '1': return "Senin"; break;
            case '2': return "Selasa"; break;
            case '3': return "Rabu"; break;
            case '4': return "Kamis"; break;
            case '5': return "Jumat"; break;
            case '6': return "Sabtu"; break;
        }
    }

    function  totalhari($begin,$end){
        $begin = new DateTime($begin);
$end = new DateTime($end);

$daterange     = new DatePeriod($begin, new DateInterval('P1D'), $end);
//mendapatkan range antara dua tanggal dan di looping
$i=0;
$x     =    0;
$end     =    1;

foreach($daterange as $date){
    $daterange     = $date->format("Y-m-d");
    $datetime     = DateTime::createFromFormat('Y-m-d', $daterange);

    //Convert tanggal untuk mendapatkan nama hari
    $day         = $datetime->format('D');

    //Check untuk menghitung yang bukan hari sabtu dan minggu
    if($day!="Sun" && $day!="Sat") {
        //echo $i;
        $x    +=    $end-$i;
        
    }
    $end++;
    $i++;
}

return $x;
    }

    function getselisihbulan($total){
        if($total <= 30){
            $data = "1 Bulan";
        }else if($total > 30 AND $total <= 60){
            $data = "2 Bulan";
        }else if($total > 60 AND $total <= 90){
            $data = "3 Bulan";
        }else if($total > 90 AND $total <= 120){
            $data = "4 Bulan";
        }else if($total > 120 AND $total <= 150){
            $data = "5 Bulan";
        }else if($total > 150 AND $total <= 180){
            $data = "6 Bulan";
        }else if($total > 180 AND $total <= 210){
            $data = "7 Bulan";
        }else if($total > 210 AND $total <= 240){
            $data = "8 Bulan";
        }else if($total > 240 AND $total <= 270){
            $data = "9 Bulan";
        }else if($total > 270 AND $total <= 300){
            $data = "10 Bulan";
        }else if($total > 300 AND $total <= 330){
            $data = "11 Bulan";
        }else if($total > 330){
            $data = "12 Bulan";
        }

        return $data;
    }


    function notifmenu($table,$arr){
        $CI =& get_instance();
        $total = $CI->db->get_where($table,$arr)->result();
        return count($total);
    }


    function sendmail($data){
    $form = $data['from'];
    $view = $data['view'];
    $title = $data['title'];
    $to = $data['to'];
    $dt = $data['data'];
		$CI =& get_instance();
           $config = array(
             'protocol' => 'smtp',
             'smtp_host' => 'mail.payunganakbangsa.com',
             'smtp_port' => 587,
             'smtp_user' => 'developer@payunganakbangsa.com',
             'smtp_pass' => 'S1komputer',
             'crlf' => "\r\n",
             'newline' => "\r\n",
             'charset'=>'utf-8',
             'wordwrap'=> TRUE,
             'mailtype' => 'html'
             );
        
//            $config = Array(
//                'protocol' => 'smtp',
//                'smtp_host' => 'smtp.mailtrap.io',
//                'smtp_port' => 2525,
//                'smtp_user' => 'c26bae2ac7f0ad',
//                'smtp_pass' => '94fd58bb9907f8',
//                'crlf' => "\r\n",
//                'newline' => "\r\n",
//                'charset'=>'utf-8',
//                'wordwrap'=> TRUE,
//                'mailtype' => 'html'
//              );


		  $CI->load->library('email', $config);

		//   $CI->email->from('eprop@enesis.com', 'PROPOSAL NEED YOUR APPROVAL');
		  $CI->email->from("developer@payunganakbangsa.com", 'Admin SIOPAK BPSDM Kementerian Dalam Negeri');
		  $CI->email->to($to);
		  $CI->email->subject($title);

		  $mesg =         $CI->load->view($view,$dt,TRUE);

		  $CI->email->message($mesg);
  
		  if($CI->email->send()){
//              print_r($CI->email->print_debugger());
			//  echo 'sukses';
             // echo $to;
			return TRUE;
		  }else{
              return $CI->email->print_debugger();
              exit;
            }
	  //      $this->load->view('pages/email',$data);


    }
    
    function trimed($txt){
        $txt = trim($txt);
        while( strpos($txt, '  ') ){
        $txt = str_replace('  ', ' ', $txt);
        }
        return $txt;
        }
    
    function get_pejabat(){
        
        $CI =& get_instance();
        $data = $CI->db->get_where('pejabat',array('aktif' => 1))->row();
        return $data;
        
    }
    
    
    function jk($a){
        if($a == 'P'){
            return "Perempuan";
        }else{
            return "Laki-Laki";
        }
    }
    
    function back_button(){
        return '<div class="col-md-12"><a class="btn btn-warning pull-right" href="javascript:history.back()"> <i class="fa fa-arrow-left"></i><span> Kembali </span></a></div>';
    }
