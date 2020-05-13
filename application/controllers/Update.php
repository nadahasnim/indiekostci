<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {

    // constructor untuk class auth
    function __construct()
    {
        parent::__construct();        

        // mengecek apakah ada session
        $level = $this->session->userdata('id_akses');

        if (!$level) {
            redirect(base_url());
        }                 
    }










    // fungsi untuk update data penghuni
    public function updatePenghuni(){
        $this->_verifyAccess('admin');

        $id_pengguna = $this->input->post('id_pengguna');
        $fotoProfil = $this->_uploadImage();

        // apabila foto profil tidak terpilih maka digunakan foto lama
        if($fotoProfil == ""){
            $fotoProfil = $this->input->post('foto_lama');
        }

        $data = array(
            'nama_pengguna' => $this->input->post('nama'),
            'alamat_pengguna' => $this->input->post('alamat'),
            'provinsi_pengguna' => $this->input->post('provinsi'),
            'kota_pengguna' => $this->input->post('kota'),
            'telepon_pengguna' => $this->input->post('telepon'),
            'email_pengguna' => $this->input->post('email'),
            'kelamin_pengguna' => $this->input->post('jKelamin'),
            'tanggal_lahir_pengguna' => $this->input->post('tgl'),
            'no_ktp_pengguna' => $this->input->post('nik'),
            'foto_pengguna' => $fotoProfil
        );

        // update user di database
        $this->load->model('User_model');
        $this->User_model->updateUser($id_pengguna, $data);       
        
        //flash data jika berhasil
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Update Data Penghuni<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect(base_url('admin/penghuni'));
    }






    public function updateDataLayanan(){
        $this->_verifyAccess('admin');

        $id_layanan = $this->input->post('id');

        $data = array(
            'nama_layanan' => $this->input->post('namaLayanan'),
            'harga_bulanan' => $this->input->post('hargaLayanan')
        );

        $this->load->model('Masterdata_model');

        if($this->Masterdata_model->updateDataLayanan($id_layanan, $data)){
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Update Data Layanan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('admin/datalayanan');
        } else {
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Update Data Layanan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/datalayanan');
        }
    }



    public function updateDataJenisPengeluaran(){
        $this->_verifyAccess('admin');

        $id_jenis_pengeluaran = $this->input->post('id');

        $data = array(
            'kode_pengeluaran' => $this->input->post('kodePengeluaran', true),
            'kategori_pengeluaran' => $this->input->post('kategori', true),
            'nama_pengeluaran' => $this->input->post('namaPengeluaran', true)
        );

        $this->load->model('Masterdata_model');

        if($this->Masterdata_model->updateDataJenisPengeluaran($id_jenis_pengeluaran, $data)){
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Update Data Jenis Pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('admin/datajenispengeluaran');
        } else {
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Update Data Jenis Pengeluaran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            redirect('admin/datajenispengeluaran');
        }
    }






    // fungsi untukupload image
    private function _uploadImage(){
        // konfigurasi
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = TRUE; //Enkripsi nama yang terupload
        $config['overwrite']			= TRUE;
        $config['max_size']             = 2048; // 1MB
        $config['file_ext_tolower']     = TRUE;
        
        $this->load->library('upload', $config);        
        
        // bila berhasil
        if ($this->upload->do_upload('foto_baru')) {            
            // ambil nama file foto
            return $this->upload->data("file_name");
        }else{
            return "";
        }
    }






    // fungsi validasi hak akses
    private function _verifyAccess($hak_akses){
        $level = $this->session->userdata('id_akses');

        if (!$level) {
            redirect(base_url());
        }

        // bila hak akses admin
        if($hak_akses == 'admin'){
            if($level != 1){
                if($level == 2){
                    redirect('user');
                    return false;
                } else if ($level == 3){
                    redirect('candidate');
                    return false;
                }
            }
        }
    }

    // fungsi untuk update data profil
    public function updateProfil(){
        $this->_verifyAccess('admin');

        $id_pengguna = $this->input->post('id_pengguna');
        $fotoProfil = $this->_uploadImage('foto_baru');

        // apabila foto profil tidak terpilih maka digunakan foto lama
        if($fotoProfil == ""){
            $fotoProfil = $this->input->post('foto_lama');
        }

        $data = array(
            'nama_pengguna' => $this->input->post('nama'),
            'alamat_pengguna' => $this->input->post('alamat'),
            'provinsi_pengguna' => $this->input->post('provinsi'),
            'kota_pengguna' => $this->input->post('kota'),
            'telepon_pengguna' => $this->input->post('telepon'),
            'email_pengguna' => $this->input->post('email'),
            'kelamin_pengguna' => $this->input->post('jKelamin'),
            'tanggal_lahir_pengguna' => $this->input->post('tgl'),
            'no_ktp_pengguna' => $this->input->post('nik'),
            'foto_pengguna' => $fotoProfil
        );

        // update user di database
        $this->load->model('User_model');
        $this->User_model->updateUser($id_pengguna, $data);       
        
        //flash data jika berhasil
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Memperbarui Data Profil<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

        redirect(base_url('admin/settingsprofil'));
    }





    // fungsi untuk update infokost
    public function updateInfoKost()
    {
        $this->_verifyAccess('admin');

        $id_kost = $this->input->post('id');

        $fotoKost = $this->_uploadImage('foto_baru');
        // apabila foto tidak terpilih maka digunakan foto lama
        if($fotoKost == ""){
            $fotoKost = $this->input->post('foto_lama');
        }

        $data = array(
            'jenis_kost'        => $this->input->post('jKost'),
            'nama_kost'         => $this->input->post('nama'),
            'alamat_kost'       => $this->input->post('alamat'),
            'provinsi_kost'     => $this->input->post('provinsi'),
            'kota_kost'         => $this->input->post('kota'),
            'no_kost'           => $this->input->post('telepon'),
            'email_kost'        => $this->input->post('email'),
            'foto_kost'         => $fotoKost,
            'deskripsi_kost'    => $this->input->post('desc')
        );

        // update infokost
        $this->load->model('Settings_model');
        if($this->Settings_model->updateInfoKost($id_kost, $data)){
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Memperbarui Data Informasi Kost<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('admin/settingsinfokost');
        } else {
            //flash data jika berhasil
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Memperbarui Data Informasi Kost<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('admin/settingsinfokost');
        }
        
    }



}