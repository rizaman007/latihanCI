<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    public function index() 
    { 
        $model = new ContactModel();
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $model->like('name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword);
        }
        $currentPage = $this->request->getVar('page_contact_group') ? $this->request->getVar('page_contact_group') : 1;
        $data = [
            'contacts' => $model->paginate(10, 'contact_group'),
            'pager'    => $model->pager,
            'keyword'  => $keyword,
            'currentPage' => $currentPage
        ];

        return view('contact_list', $data); 
    }

    public function delete($id = null)
    {
        $model = new ContactModel();
        $model->delete($id);

        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to(base_url('contact/list'));
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
        $contactModel = new ContactModel();
        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'message' => $this->request->getPost('message'),
        ];
        $contactModel->save($data); 
        session()->setFlashdata('success', 'Pesan Anda telah kami terima.');
        return redirect()->to('/portfolio/contact');
    }
    public function detail($id = null)
    {
        $contactModel = new ContactModel();
        $data['contact'] = $contactModel->find($id);
        return view('contact_detail', $data);
    }

    public function edit($id = null)
    {
        $contactModel = new ContactModel();
        $data['contact'] = $contactModel->find($id);
        return view('contact_edit', $data);
    }

    public function update($id = null)
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

        $contactModel = new ContactModel();
        $contactModel->update($id, $this->request->getPost());

        session()->setFlashdata('success', 'Data berhasil diperbarui!');
        return redirect()->to(base_url('contact/list'));
    }
}