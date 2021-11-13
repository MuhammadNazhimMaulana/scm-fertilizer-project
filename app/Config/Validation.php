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

	// Bagian Update Produk
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

	// Bagian Material
	public $material = [
		'nama_material' => [
			'rules' => 'required',
		],
	];

	public $material_errors = [
		'nama_material' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Update Material
	public $material_update = [
		'nama_material' => [
			'rules' => 'required',
		],
	];

	public $material_update_errors = [
		'nama_material' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Pembelian
	public $pembelian = [
		'status' => [
			'rules' => 'required',
		],
	];

	public $pembelian_errors = [
		'status' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Update Pembelian
	public $pembelian_update = [
		'status' => [
			'rules' => 'required',
		],
	];

	public $pembelian_update_errors = [
		'status' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Vendor
	public $vendor = [
		'nama_vendor' => [
			'rules' => 'required',
		],
	];

	public $vendor_errors = [
		'nama_vendor' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Update Vendor
	public $vendor_update = [
		'nama_vendor' => [
			'rules' => 'required',
		],
	];

	public $vendor_update_errors = [
		'nama_vendor' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Insrt Orderan
	public $order_item = [
		'nama_produk' => [
			'rules' => 'required',
		],
		'jumlah_pesan' => [
			'rules' => 'required',
		],
	];

	public $order_item_errors = [
		'nama_produk' => [
			'required' => '{field} Harus diisi',
		],
		'jumlah_pesan' => [
			'required' => '{field} Harus diisi',
		],
	];

	// Bagian Insrt Orderan
	public $buy_item = [
		'id_material' => [
			'rules' => 'required',
		],
		'item_beli' => [
			'rules' => 'required',
		],
	];

	public $buy_item_errors = [
		'id_material' => [
			'required' => '{field} Harus diisi',
		],
		'item_beli' => [
			'required' => '{field} Harus diisi',
		],
	];
	//--------------------------------------------------------------------
}
