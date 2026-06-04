<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function home()
    {

        return view('home');
    }
    public function about()
    {
        $data = [
            'title' => 'About YooRental'
        ];

        return view('about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact YooRental'
        ];

        return view('contact', $data);
    }

    // Privacy Policy
    public function privacy()
    {
        $data = [
            'title' => 'Privacy Policy'
        ];

        return view('privacy', $data);
    }

    // Terms & Conditions
    public function terms()
    {
        $data = [
            'title' => 'Terms & Conditions'
        ];

        return view('terms', $data);
    }

    // Live Search Ads
    public function searchAds()
    {

        if ($this->request->isAJAX()) {

            $keyword = $this->request->getPost('keyword');

            $db = \Config\Database::connect();

            $ads = $db->table('ads')
                ->like('title', $keyword)
                ->orLike('location', $keyword)
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get()
                ->getResult();

            return view('search_results', [
                'ads' => $ads
            ]);
        }
    }

    public function subscribe()
    {
        $email = trim($this->request->getPost('email'));

        // Login user email
        $session_email = session()->get('email');

        // Check email match
        if ($email !== $session_email) {

            return redirect()->back()->with(
                'error',
                'Please enter your registered login email only!'
            );
        }

        $db = \Config\Database::connect();

        // Check already subscribed
        $check = $db->table('subscribers')
            ->where('email', $email)
            ->get()
            ->getRow();

        if ($check) {

            return redirect()->back()->with(
                'error',
                'Email already subscribed!'
            );
        }

        // Insert
        $db->table('subscribers')->insert([
            'email' => $email
        ]);

        return redirect()->back()->with(
            'success',
            'Subscription successful!'
        );
    }
}