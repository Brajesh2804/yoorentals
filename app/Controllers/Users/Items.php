<?php
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Items extends BaseController
{
    public $authmodel;

    public function __construct()
    {
        $this->authmodel = new AuthModel();
    }

    // Jab user base_url() (khali domain) par aayega
    public function index(): string
    {
        $db = \Config\Database::connect();

        // Dono parameters pakadna
        $keyword = $this->request->getGet('q');
        $category = $this->request->getGet('category');

        $builder = $db->table('ads');

        $builder->select('ads.*');
        $builder->join('users', 'users.user_id = ads.owner_id');
        $builder->where('users.is_blocked', 0);
        $builder->where('ads.status', 1);

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


    public function item_details($id)
    {
        $db = \Config\Database::connect();

        // Query with JOIN to get owner details
        $ad = $db->table('ads')
            ->select('ads.*, users.name as owner_name, users.image as owner_photo')
            ->join('users', 'users.user_id = ads.owner_id', 'left') // ads.owner_id check karlein
            ->where('ads.id', $id)
            ->get()
            ->getRow();

        if (!$ad) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Ad not found!");
        }

        $data = [
            'ad' => $ad,
            'title' => $ad->title
        ];

        return view('users/items/item_details', $data);
    }

    public function category()
    {
        // Sirf login user hi dekh sake
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        return view('properties/category');
    }

    public function save_ad()
    {
        // 1. Check karein ki user login hai ya nahi
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        // 2. Files upload logic
        $imgFiles = $this->request->getFileMultiple('images');
        $imgNames = [];

        if ($imgFiles) {
            foreach ($imgFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/ads', $newName);
                    $imgNames[] = $newName;
                }
            }
        }

        // 3. Data Prepare karein (owner_id aur phone ke sath)
        $data = [
            'owner_id' => session()->get('user_id'), // Login user ki ID yahan save hogi
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'price' => $this->request->getPost('price'),
            'location' => $this->request->getPost('location'),
            'phone' => $this->request->getPost('phone'), // Phone number field
            'description' => $this->request->getPost('description'),
            'images' => implode(',', $imgNames),
        ];

        // 4. Database mein insert karein
        $db = \Config\Database::connect();
        $db->table('ads')->insert($data);

        session()->setFlashdata('message', 'Ad Posted Successfully!');

        // Direct home par bhej rahe hain
        return redirect()->to(base_url('/'));
    }
    public function post_ad($category = null)
    {
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'category' => $category,
            'title' => 'Post Ad for ' . ucfirst($category)
        ];

        // ✅ Aapne kaha file yahan hai, isliye path ye rahega:
        return view('users/items/post_ad_form', $data);
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
    public function delete_ad($id)
    {
        $db = \Config\Database::connect();
        $my_id = session()->get('user_id');

        // Security check: Sirf wahi banda delete kar sake jiski ad hai
        $db->table('ads')
            ->where('id', $id)
            ->where('owner_id', $my_id) // owner_id ya user_id jo bhi aap use kar rahe hain
            ->update(['status' => 0]); // Delete nahi, status update

        return redirect()->back()->with('msg', 'Ad removed successfully');
    }

}
