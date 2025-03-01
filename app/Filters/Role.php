<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Pastikan pengguna sudah login
        $role = session()->get('role');
        if (!$role) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah role cocok dengan yang diizinkan
        if (!in_array($role, $arguments)) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa di sini
    }
}