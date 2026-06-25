<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Libraries\Hash;
use CodeIgniter\HTTP\RedirectResponse;

class Messages extends BaseController
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
            $receiver = isset($ad->owner_id) ? $ad->owner_id : (isset($ad->user_id) ? $ad->user_id : 0);
        }

        // 3. Conversation Key
        $conversation_key = $ad_id . '_' . min(session()->get('id'), $receiver) . '_' . max(session()->get('id'), $receiver);

        // 4. Data Preparation
        $data = [
            'ad_id' => $ad_id,
            'sender_id' => session()->get('id'),
            'receiver_id' => $receiver,
            'message' => $this->request->getPost('message'),
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'conversation_key' => $conversation_key
        ];

        // 5. Insert Data
        $db->table('messages')->insert($data);

        // 6. AJAX Response
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Message sent successfully!'
            ]);
        }

        return redirect()->back()->with('message', 'Message sent!');
    }

    public function view_messages($ad_id = null, $user_id = null)
    {
        if (!session()->get('userlogin')) {
            return redirect()->to(base_url('login'));
        }

        $db = \Config\Database::connect();
        $my_id = session()->get('user_id');

        // --- CHAT LIST ---
        $data['chat_list'] = $db->query("
        SELECT 
            m.ad_id, 
            a.title as ad_title, 
            u.user_id as other_user_id, 
            u.name as user_name,
            m.message as last_msg, 
            m.created_at as last_time
        FROM messages m
        JOIN ads a ON a.id = m.ad_id
        JOIN users u ON u.user_id = IF(m.sender_id = $my_id, m.receiver_id, m.sender_id)
        WHERE (m.sender_id = $my_id OR m.receiver_id = $my_id)
        AND m.id IN (SELECT MAX(id) FROM messages GROUP BY ad_id, IF(sender_id = $my_id, receiver_id, sender_id))
        ORDER BY m.created_at DESC
        ")->getResult();

        // --- ACTIVE CHAT ---
        if ($ad_id !== null && $user_id !== null) {

            $data['active_chat'] = true;
            $data['active_ad'] = $ad_id;

            $data['other_user'] = $db->table('users')
                ->where('user_id', $user_id)
                ->get()
                ->getRow();

            $ad = $db->table('ads')
                ->where('id', $ad_id)
                ->get()
                ->getRow();

            $data['ad_title'] = $ad ? $ad->title : 'Item';

            // ✅ FIXED MESSAGE QUERY
            $conversation_key = $ad_id . '_' . min($my_id, $user_id) . '_' . max($my_id, $user_id);

            $data['messages'] = $db->table('messages')
                ->where('conversation_key', $conversation_key)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResult();

            // mark read 
            $db->table('messages')
                ->where([
                    'receiver_id' => $my_id,
                    'sender_id' => $user_id,
                    'ad_id' => $ad_id
                ])
                ->update(['is_read' => 1]);
        }

        return view('users/items/messages_view', $data);
    }
}