<?php class Laporan extends CI_Controller {
 
    public function index()
    {
        $data = array(
            "dataku" => array(
                "nama" => "Basecamp Coding",
                "url" => "http://basecampcoding.blogspot.com/"
            )
        );
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-PDF.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    }
} 
