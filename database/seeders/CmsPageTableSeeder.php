<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CmsPage;

class CmsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cmsPageData = [
            [
                'id' => 1,
                'title' => 'About Us',
                'description' => 'Content',
                'url' => 'about-us',
                'meta_title' => 'About Us',
                'meta_description' => 'About Us Content',
                'meta_keywords' => 'About Us',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 2,
                'title' => 'Terms & Conditions',
                'description' => 'Content',
                'url' => 'terms-conditions',
                'meta_title' => 'Terms & Conditions',
                'meta_description' => 'Terms & Conditions Content',
                'meta_keywords' => 'Terms & Conditions',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id' => 3,
                'title' => 'Privacy Policy',
                'description' => 'Content',
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Privacy Policy Content',
                'meta_keywords' => 'Privacy Policy',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        
        ];

        CmsPage::insert($cmsPageData);
    }
}
