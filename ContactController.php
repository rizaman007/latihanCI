<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
     public function index() 
    { 
        return view('contact'); 
    } 
    public function save() 
    { 
        $rules = [
            'name' => [
                'label'  => 'Nama Lengkap',
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                ]
            ],
            'email' => [
                'label'  => 'Alamat Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'valid_email' => 'Format {field} tidak valid.'
                ]
            ],
            'phone' => [
                'label'  => 'Nomor Telepon',
                'rules'  => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'numeric'    => '{field} harus berupa angka.',
                    'min_length' => '{field} terlalu pendek.',
                    'max_length' => '{field} terlalu panjang.'
                ]
            ],
            'message' => [
                'label'  => 'Pesan',
                'rules'  => 'required|min_length[10]',
                'errors' => [
                    'required'   => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal berisi 10 karakter agar lebih jelas.'
                ]
            ]
        ];

        if (!$this->validate($rules)) { 
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors()); 
        } 
        $data = $this->request->getPost(); 
        session()->setFlashdata('success', 'Pesan Anda telah kami terima.');
        return redirect()->to('/portfolio/contact');
    }
}