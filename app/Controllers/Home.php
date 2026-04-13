<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    // Jab user base_url() (khali domain) par aayega
    public function index(): string
    {
        $db = \Config\Database::connect();

        // Dono parameters pakadna
        $keyword = $this->request->getGet('q');
        $category = $this->request->getGet('category');

        $builder = $db->table('ads');

        // 1. Agar search keyword hai
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('title', $keyword)
                ->orLike('location', $keyword)
                ->orLike('category', $keyword)
                ->groupEnd();
        }

        // 2. Agar category filter click hua hai
        if (!empty($category) && $category !== 'all') {
            $builder->where('category', $category);
        }

        $data['ads'] = $builder->orderBy('id', 'DESC')->get()->getResult();

        return view('home', $data);
    }

    public function search_ads()
    {
        $db = \Config\Database::connect();
        $keyword = $this->request->getPost('keyword');

        $builder = $db->table('ads');
        $builder->like('title', $keyword);
        $builder->orLike('category', $keyword);
        $builder->orLike('location', $keyword);
        $ads = $builder->get()->getResult();

        if (!empty($ads)) {
            foreach ($ads as $ad) {
                $imgs = explode(',', $ad->images);
                $img_url = !empty($imgs[0]) ? base_url('uploads/ads/' . $imgs[0]) : 'https://placehold.co/500x350';

                echo '
            <div class="item-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden group">
                <a href="' . base_url('items/details/' . $ad->id) . '" class="relative block h-48 overflow-hidden">
                    <img src="' . $img_url . '" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2 py-0.5 rounded text-[10px] font-bold text-blue-600 shadow-sm uppercase">Verified</div>
                    <div class="absolute bottom-3 left-3 bg-gray-900/80 backdrop-blur text-white px-3 py-1 rounded-lg font-bold text-sm">₹' . number_format($ad->price) . '</div>
                </a>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 text-sm mb-1 truncate">' . $ad->title . '</h3>
                    <div class="flex items-center gap-1 text-gray-400 text-xs mb-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2"/></svg>
                        ' . $ad->location . '
                    </div>
                    <a href="' . base_url('items/details/' . $ad->id) . '" class="block text-center w-full py-2 bg-blue-50 text-blue-600 text-xs font-bold rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                        View Details
                    </a>
                </div>
            </div>';
            }
        } else {
            echo '<div class="col-span-full py-20 text-center text-gray-400 font-bold">No results found for "' . esc($keyword) . '"</div>';
        }
    }

    // Agar kisi ne /home likha toh bhi wahi index wala kaam hoga
    public function home()
    {
        return $this->index();
    }
}