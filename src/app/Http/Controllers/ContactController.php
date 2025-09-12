<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class ContactController extends Controller
{
    public function showForm()
    {
        return view("contact");
    }

    public function submitForm(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ];

        Inquiry::create($request->validate($rules));

        return redirect()->route('top.contact')->with('success', 'お問い合わせありがとうございます。2~3営業日以内にご入力いただいたメールアドレスへご連絡いたします。');
    }

    public function showInquiry(Inquiry $inquiry)
    {
        // 問い合わせを既読にする
        $inquiry->is_read = true;
        $inquiry->save();

        // 問い合わせ詳細ビューにデータを渡す
        return view('admin.detail', compact('inquiry'));
    }
}