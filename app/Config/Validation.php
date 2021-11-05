<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules

    // Bagian Register
	public $register = [
		'username' => [
			'rules' => 'required|min_length[5]',
		],
		'nama_lengkap' => [
			'rules' => 'required',
		],
		'alamat' => [
			'rules' => 'required',
		],
		'password' => [
			'rules' => 'required',
		],
		'password_confirm' => [
			'rules' => 'required|matches[password]',
		]
	];

	public $register_errors = [
		'username' => [
			'required' => '{field} Harus diisi',
			'min_length' => '{field} Minimal 5 karakter,'
		],
		'nama_lengkap' => [
			'required' => '{field} Harus diisi',
		],
		'alamat' => [
			'required' => '{field} Harus diisi',
		],
		'password' => [
			'required' => '{field} Harus diisi',
		],
		'password_confirm' => [
			'required' => '{field} Harus diisi',
			'matches' => '{field} Tidak sama dengan Password',
		]
	];

    // Bagian Login
	public $login = [
		'username' => [
			'rules' => 'required|min_length[5]',
		],
		'password' => [
			'rules' => 'required',
		],
	];

	public $login_errors = [
		'username' => [
			'required' => '{field} Harus diisi',
			'min_length' => '{field} Minimal 5 karakter,'
		],
		'password' => [
			'required' => '{field} Harus diisi',
		],
	];
	
	// Bagian Pesanan
	public $pesanan = [
		'nama_pemesan' => [
			'rules' => 'required',
		],
	];

	public $pesanan_errors = [
		'nama_pemesan' => [
			'required' => '{field} Harus diisi',
		],
	];
	
	// Bagian Update Pesanan
	public $pesanan_update = [
		'nama_pemesan' => [
			'rules' => 'required',
		],
	];

	public $pesanan_update_errors = [
		'nama_pemesan' => [
			'required' => '{field} Harus diisi',
		],
	];
	
	// Bagian Produk
	public $produk = [
		'nama_pupuk' => [
			'rules' => 'required',
		],
		'harga_pupuk' => [
			'rules' => 'required',
		],
	];

	public $produk_errors = [
		'nama_pupuk' => [
			'required' => '{field} Harus diisi',
		],
		'harga_pupuk' => [
			'required' => '{field} Harus diisi',
		],
	];
	
	// Bagian Update Pesanan
	public $produk_update = [
		'nama_pupuk' => [
			'rules' => 'required',
		],
		'harga_pupuk' => [
			'rules' => 'required',
		],
	];

	public $produk_update_errors = [
		'nama_pupuk' => [
			'required' => '{field} Harus diisi',
		],
		'harga_pupuk' => [
			'required' => '{field} Harus diisi',
		],
	];
	
    //--------------------------------------------------------------------
}
