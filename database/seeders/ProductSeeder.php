<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Product::create([
            'kode_barang' => 'KFI-01',
            'nama_barang' => 'SWISS TEBAL 1 CM PREMIUM',
            'stok_awal' => '154',
            'masuk' => '0',
            'keluar' => '56',
            'stok_akhir' => '98',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-02',
            'nama_barang' => 'SWISS TEBAL 1CM STANDARD',
            'stok_awal' => '0',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '0',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-03',
            'nama_barang' => 'SWISS TEBAL 2CM STANDAR IMPORT',
            'stok_awal' => '56',
            'masuk' => '200',
            'keluar' => '75',
            'stok_akhir' => '181',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-05',
            'nama_barang' => 'SWISS TEBAL 3CM STANDAR IMPORT',
            'stok_awal' => '14',
            'masuk' => '300',
            'keluar' => '74',
            'stok_akhir' => '240',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-06',
            'nama_barang' => 'JEPANG TEBAL 3CM PREMIUM',
            'stok_awal' => '325',
            'masuk' => '0',
            'keluar' => '75',
            'stok_akhir' => '250',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-07',
            'nama_barang' => 'RUMPUT GOLF 1.5CM',
            'stok_awal' => '22.5',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '22.5',
            'satuan' => 'M2'
        ]);

        Product::create([
            'kode_barang' => 'KFI-08',
            'nama_barang' => 'DRAINASE CELL 25X25',
            'stok_awal' => '1164',
            'masuk' => '0',
            'keluar' => '1058',
            'stok_akhir' => '106',
            'satuan' => 'KEPING'
        ]);
        
        Product::create([
            'kode_barang' => 'KFI-09',
            'nama_barang' => 'DAUN DOLAR (35K)',
            'stok_awal' => '2',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '2',
            'satuan' => 'LEMBAR'
        ]);

        Product::create([
            'kode_barang' => 'KFI-10',
            'nama_barang' => 'DAUN ANGGUR BESAR',
            'stok_awal' => '2',
            'masuk' => '0',
            'keluar' => '1',
            'stok_akhir' => '1',
            'satuan' => 'SULUR'
        ]);

        Product::create([
            'kode_barang' => 'KFI-11',
            'nama_barang' => 'DAUN ANGGUR KECIL',
            'stok_awal' => '0',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '0',
            'satuan' => 'SULUR'
        ]);

        Product::create([
            'kode_barang' => 'KFI-12',
            'nama_barang' => 'PAGAR TANAMAN BESAR',
            'stok_awal' => '1',
            'masuk' => '0',
            'keluar' => '1',
            'stok_akhir' => '0',
            'satuan' => 'PCS'
        ]);

        Product::create([
            'kode_barang' => 'KFI-13',
            'nama_barang' => 'PAGAR TANAMAN KECIL',
            'stok_awal' => '1',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '1',
            'satuan' => 'PCS'
        ]);

        Product::create([
            'kode_barang' => 'KFI-14',
            'nama_barang' => 'BATU AQUARIUM',
            'stok_awal' => '5',
            'masuk' => '64',
            'keluar' => '42',
            'stok_akhir' => '27',
            'satuan' => 'KG'
        ]);

        Product::create([
            'kode_barang' => 'KFI-15',
            'nama_barang' => 'BATU KORAL',
            'stok_awal' => '0',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '0',
            'satuan' => 'KARUNG'
        ]);

        Product::create([
            'kode_barang' => 'KFI-16',
            'nama_barang' => 'JARING GAWANG',
            'stok_awal' => '1',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '1',
            'satuan' => 'PCS'
        ]);     
        
        Product::create([
            'kode_barang' => 'KFI-17',
            'nama_barang' => 'LAMPU DÉCOR',
            'stok_awal' => '20',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '20',
            'satuan' => 'PCS'
        ]);

        Product::create([
            'kode_barang' => 'KFI-18',
            'nama_barang' => 'DAUN DOLAR (30K)',
            'stok_awal' => '45',
            'masuk' => '0',
            'keluar' => '35',
            'stok_akhir' => '10',
            'satuan' => ''
        ]);
        
        Product::create([
            'kode_barang' => 'KFI-19',
            'nama_barang' => 'DAUN DOLAR (33K)',
            'stok_awal' => '50',
            'masuk' => '0',
            'keluar' => '1',
            'stok_akhir' => '49',
            'satuan' => ''
        ]);

        Product::create([
            'kode_barang' => 'KFI-20',
            'nama_barang' => 'DAUN GARLAN',
            'stok_awal' => '4',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '4',
            'satuan' => ''
        ]);

        Product::create([
            'kode_barang' => 'KFI-21',
            'nama_barang' => 'DAUN CABE',
            'stok_awal' => '11',
            'masuk' => '0',
            'keluar' => '0',
            'stok_akhir' => '11',
            'satuan' => ''
        ]);

    }
}
