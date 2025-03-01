<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Sesuaikan dengan nama tabel
    protected $primaryKey = 'username'; // Karena primary key adalah username
    protected $allowedFields = ['username', 'password_hash', 'role']; // Kolom yang diizinkan untuk diisi
    protected $useAutoIncrement = false; // Nonaktifkan auto increment karena primary key adalah string
}