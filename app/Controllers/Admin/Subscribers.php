<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Subscribers extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $search = $this->request->getGet('search');

        $builder = $db->table('subscribers');

        if (!empty($search)) {

            $builder->like('email', $search);
        }

        $builder->orderBy('id','ASC');

        $data['subscribers'] = $builder->get()->getResult();

        return view('admin/subscribers/index',$data);
    }

    public function view($id)
    {
        $db = \Config\Database::connect();

        $data['subscriber'] = $db->table('subscribers')
            ->where('id',$id)
            ->get()
            ->getRow();

        return view('admin/subscribers/view',$data);
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('subscribers')
            ->where('id',$id)
            ->delete();

        return redirect()->back()->with('success','Subscriber Deleted Successfully');
    }
}