<?php
namespace App\Controllers\Users;
use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Wps extends BaseController
{
    public $authmodel;

    public function __construct()
    {
        $this->authmodel = new AuthModel();
    }
    public function send_message()
    {
        // 1. Check Login
        if (!session()->get('userlogin')) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Please login first']);
            }
            return redirect()->to('login');
        }

        $db = \Config\Database::connect();

        // 2. Receiver ID Logic
        $receiver = $this->request->getPost('receiver_id');
        $ad_id = $this->request->getPost('ad_id');

        if (empty($receiver) || $receiver == 0) {
            $ad = $db->table('ads')->where('id', $ad_id)->get()->getRow();
            // Check karein ki ads table mein column ka naam 'owner_id' hai ya 'user_id'
            $receiver = isset($ad->owner_id) ? $ad->owner_id : (isset($ad->user_id) ? $ad->user_id : 0);
        }

        // 3. Data Preparation
        $data = [
            'ad_id' => $ad_id,
            'sender_id' => session()->get('id'),
            'receiver_id' => $receiver,
            'message' => $this->request->getPost('message'),
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s') // Timing ke liye best hai
        ];

        // 4. Insert Data
        $db->table('messages')->insert($data);

        // 5. AJAX Response Support
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Message sent successfully!'
            ]);
        }

        // 6. Normal Form Fallback
        return redirect()->back()->with('message', 'Message sent!');
    }

    public function view_messages($ad_id = null, $user_id = null)
    {
        if (!session()->get('userlogin'))
            return redirect()->to(base_url('login'));

        $db = \Config\Database::connect();
        $my_id = session()->get('id');

        // --- STEP 1: Chat List (Owner ke liye saare Customers ki list) ---
        // Hum query ko simple kar rahe hain taaki data 100% aaye
        $data['chat_list'] = $db->query("
        SELECT 
            m.ad_id, 
            a.title as ad_title, 
            u.id as other_user_id, 
            u.name as user_name,
            m.message as last_msg, 
            m.created_at as last_time
        FROM messages m
        JOIN ads a ON a.id = m.ad_id
        JOIN users u ON u.id = IF(m.sender_id = $my_id, m.receiver_id, m.sender_id)
        WHERE m.sender_id = $my_id OR m.receiver_id = $my_id
        AND m.id IN (SELECT MAX(id) FROM messages GROUP BY ad_id, IF(sender_id = $my_id, receiver_id, sender_id))
        ORDER BY m.created_at DESC
    ")->getResult();

        // --- STEP 2: Active Chat Logic ---
        if ($ad_id !== null && $user_id !== null) {
            $data['active_chat'] = true;
            $data['active_ad'] = $ad_id;

            // Samne wale user ka data
            $data['other_user'] = $db->table('users')->where('id', $user_id)->get()->getRow();

            // Ad ka title
            $ad = $db->table('ads')->where('id', $ad_id)->get()->getRow();
            $data['ad_title'] = $ad ? $ad->title : 'Item';

            // Saare messages load karein (Conversation)
            $data['messages'] = $db->table('messages')
                ->groupStart()
                ->where(['sender_id' => $my_id, 'receiver_id' => $user_id, 'ad_id' => $ad_id])
                ->orWhere(['sender_id' => $user_id, 'receiver_id' => $my_id, 'ad_id' => $ad_id])
                ->groupEnd()
                ->orderBy('id', 'ASC')
                ->get()->getResult();

            // Messages ko READ mark karein
            $db->table('messages')
                ->where(['receiver_id' => $my_id, 'sender_id' => $user_id, 'ad_id' => $ad_id])
                ->update(['is_read' => 1]);
        }

        return view('users/items/messages_view', $data);
    }
}