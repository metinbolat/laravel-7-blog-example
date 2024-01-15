<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'description' => 'Site Başlığı',
                    'key'         => 'title',
                    'value'       => 'Site başlığı',
                    'type'        => 'text',
                    'must'        => 0,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Site Açıklaması',
                    'key'         => 'description',
                    'value'       => 'Site açıklaması',
                    'type'        => 'text',
                    'must'        => 1,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Site Logosu',
                    'key'         => 'logo',
                    'value'       => 'logo.png',
                    'type'        => 'file',
                    'must'        => 2,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Site İkonu',
                    'key'         => 'icon',
                    'value'       => 'icon.png',
                    'type'        => 'file',
                    'must'        => 3,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Anahtar Kelimeler',
                    'key'         => 'keywords',
                    'value'       => 'Anahtar kelimeler',
                    'type'        => 'text',
                    'must'        => 4,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Sabit Telefon',
                    'key'         => 'phone',
                    'value'       => '0123 456 78 90',
                    'type'        => 'text',
                    'must'        => 5,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Cep Telefonu',
                    'key'         => 'mobile',
                    'value'       => '0123 456 78 90',
                    'type'        => 'text',
                    'must'        => 6,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'E-posta',
                    'key'         => 'email',
                    'value'       => 'username@domain.com',
                    'type'        => 'text',
                    'must'        => 7,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'İlçe',
                    'key'         => 'ilce',
                    'value'       => 'İlçe adı',
                    'type'        => 'text',
                    'must'        => 8,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'İl',
                    'key'         => 'il',
                    'value'       => 'Şehir adı',
                    'type'        => 'text',
                    'must'        => 9,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Açık Adres',
                    'key'         => 'address',
                    'value'       => 'Açık adres bilgisi',
                    'type'        => 'text',
                    'must'        => 10,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Site Footer',
                    'key'         => 'footer',
                    'value'       => 'Tüm hakları saklıdır.',
                    'type'        => 'file',
                    'must'        => 11,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Date Format',
                    'key'         => 'date_format',
                    'value'       => 'M d,Y',
                    'type'        => 'time',
                    'must'        => 12,
                    'delete'      => '0',
                    'status'      => 1,
                ],
                [
                    'description' => 'Time Format',
                    'key'         => 'time_format',
                    'value'       => 'H:i',
                    'type'        => 'time',
                    'must'        => 13,
                    'delete'      => '0',
                    'status'      => 1,
                ],
            ]
        );
    }
}
