<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cms extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $search = $this->request->getGet('search');

        $builder = $db->table('cms');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('page_title', $search)
                ->orLike('page_key', $search)
                ->groupEnd();
        }

        $builder->orderBy('id', 'ASC');

        $data['pages'] = $builder->get()->getResult();

        return view('admin/cms/index', $data);
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $data['page'] = $db->table('cms')
            ->where('id', $id)
            ->get()
            ->getRow();

        return view('admin/cms/edit', $data);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $image = '';

        $file = $this->request->getFile('page_image');

        if ($file && $file->isValid()) {

            $image = $file->getRandomName();

            $file->move('uploads/cms', $image);

            $db->table('cms')
                ->where('id', $id)
                ->update([
                    'page_image' => $image
                ]);
        }

        $db->table('cms')
            ->where('id', $id)
            ->update([

                'page_title' => $this->request->getPost('page_title'),

                'page_content' => $this->request->getPost('page_content'),

                'status' => $this->request->getPost('status')

            ]);

        return redirect()->to(base_url('admin/cms'))
            ->with('success', 'CMS Updated Successfully');
    }
}