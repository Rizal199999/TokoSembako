<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function showRegister()
    {
        if (session()->get('username')) {
            return redirect()->to('/products');
        }
        return view('register'); // Tampilkan view register
    }

    // Memproses data registrasi
    public function processRegister()
    {
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role') ?? 'user'; // Default role adalah 'user'
        $userModel = new UserModel();

            // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Simpan ke database
        try {
            $userModel->insert([
                'username' => $username,
                'password_hash' => $hashedPassword,
                'role' => $role,
            ]);
            return redirect()->to('/login')->with('success', 'Akun berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Username sudah digunakan.');
        }
        

        return redirect()->to('/register')->with('error', 'Invalid request.');
    }
    public function loginProcess()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $userModel = new UserModel();

        // Cari user berdasarkan username
        $user = $userModel->where('username', $username)->first();

        // Jika user ditemukan dan password cocok
        if ($user && password_verify($password, $user['password_hash'])) {
            session()->set([
                'username' => $user['username'],
                'role' => $user['role'], // Simpan role pengguna
                'logged_in' => true, // Tandai user sebagai login
            ]);
            return redirect()->to('/products')->with('success', 'Login berhasil!');
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Username atau password salah.');
        }
    }

    
    public function loginView() {
        if (session()->get('username')) {
            return redirect()->to('/products');
        }
        return view('login');
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil!');
    }
    public function dashboard()
    {
        if (!session()->get('username')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return redirect()->to('/products')->with('success', 'Selamat datang.');
    }

}