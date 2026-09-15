<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__) . '/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link    http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright   Copyright (c) 2015 Wiredesignz
 * @version     5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller
{
    public $autoload = array();
    public $comp;
    public $data;
    public function __construct()
    {
        $class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
        log_message('debug', $class . " MX_Controller Initialized");
        Modules::$registry[strtolower($class)] = $this;
 
        /* copy a loader instance and initialize */
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);

        $admin_base = (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) 
            ? 'http://' . $_SERVER['HTTP_HOST'] . '/bhandari_admin/public/' 
            : 'https://bhandaripackersandmovers.in/admin/';
        $this->comp['admin_base_url'] = $admin_base;

        // Default NAP & Company Configuration
        $this->comp['company3'] = 'Bhandari Packers and Movers';
        $this->comp['brand_short'] = 'Bhandari Packers';
        $this->comp['companydomain'] = 'bhandaripackersandmovers.in';
        $this->comp['phone'] = '7303257332';
        $this->comp['phonehtml'] = 'tel:+917303257332';
        $this->comp['supportmail'] = 'info@bhandaripackersandmovers.in';
        $this->comp['replyToMail'] = 'info@bhandaripackersandmovers.in';
        $this->comp['mail'] = 'info@bhandaripackersandmovers.in';
        $this->comp['mailhtml'] = "mailto:info@bhandaripackersandmovers.in";
        $this->comp['mail2'] = 'info@bhandaripackersandmovers.in';
        $this->comp['mail2html'] = "mailto:info@bhandaripackersandmovers.in";
        $this->comp['businessHours'] = "Mon-Sat: 9AM - 6PM";

        $this->comp['address'] = "Office No 504, 5th floor baba Arcade, Harola, Sector 5 Noida, Distt, Gautam Budh Nagar, UTTAR PRADESH India.";
        $this->comp['address1'] = "Office No 504, 5th floor baba Arcade, Harola, Sector 5 Noida";
        $this->comp['address2'] = "Noida";
        $this->comp['addressRegion'] = "Uttar Pradesh";
        $this->comp['postalCode'] = "201301";
        $this->comp['companystate'] = "Uttar Pradesh";
        $this->comp['themeColor'] = "#FC5D09";
        
        $this->comp['company_description'] = 'Providing reliable and efficient packing and moving services across India since 2005. Your trust is our priority.';
        $this->comp['quick_links'] = [
            ['title' => 'About Us', 'url' => 'about'],
            ['title' => 'Home', 'url' => ''],
            ['title' => 'Contact', 'url' => 'contacts'],
            ['title' => 'Branches', 'url' => 'branches'],
            ['title' => 'Cancellation & Refund Policy', 'url' => 'cancellation-refund']
        ];

        $this->comp['facebookhtml'] = "https://www.facebook.com/share/1ZqpTWpfwE/";
        $this->comp['youtubehtml'] = "https://youtube.com/@bhandaripackersandmovers?si=zB430aIlN8su81TU";
        $this->comp['instagramhtml'] = "https://www.instagram.com/bhandaripackers?igsh=d24zZ2ZpcHBsbGps";
        $this->comp['twitterhtml'] = "";
        $this->comp['linkedinhtml'] = "";
        $this->comp['whatsapphtml'] = "https://api.whatsapp.com/send?phone=+917303257332&text=Hello+Bhandari+Packers+and+Movers,+I+am+interested+in+your+services";

        $this->comp['logo_url'] = base_url('assets/images/logo/logo.jpg');
        $this->comp['favicon_url'] = base_url('assets/images/logo/logo.jpg');

        // Dynamic override from Admin Settings Table
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('settings')) {
                $settings_rows = $admin_db->get('settings')->result();
                $db_settings = [];
                foreach ($settings_rows as $row) {
                    $db_settings[$row->key] = $row->value;
                }

                if (!empty($db_settings['company_name'])) {
                    $this->comp['company3'] = $db_settings['company_name'];
                }
                if (!empty($db_settings['contact_phone'])) {
                    $this->comp['phone'] = $db_settings['contact_phone'];
                    $clean_phone = preg_replace('/[^\d]/', '', $db_settings['contact_phone']);
                    $this->comp['phonehtml'] = 'tel:+91' . (strlen($clean_phone) > 10 ? substr($clean_phone, -10) : $clean_phone);
                }
                if (!empty($db_settings['contact_email'])) {
                    $this->comp['mail'] = $db_settings['contact_email'];
                    $this->comp['mail2'] = $db_settings['contact_email'];
                    $this->comp['supportmail'] = $db_settings['contact_email'];
                    $this->comp['replyToMail'] = $db_settings['contact_email'];
                    $this->comp['mailhtml'] = 'mailto:' . $db_settings['contact_email'];
                    $this->comp['mail2html'] = 'mailto:' . $db_settings['contact_email'];
                }
                if (!empty($db_settings['business_hours'])) {
                    $this->comp['businessHours'] = $db_settings['business_hours'];
                }
                if (!empty($db_settings['address'])) {
                    $this->comp['address'] = $db_settings['address'];
                }
                if (!empty($db_settings['address_short'])) {
                    $this->comp['address1'] = $db_settings['address_short'];
                }
                if (!empty($db_settings['city'])) {
                    $this->comp['address2'] = $db_settings['city'];
                }
                if (!empty($db_settings['state'])) {
                    $this->comp['addressRegion'] = $db_settings['state'];
                    $this->comp['companystate'] = $db_settings['state'];
                }
                if (!empty($db_settings['postal_code'])) {
                    $this->comp['postalCode'] = $db_settings['postal_code'];
                }
                if (!empty($db_settings['company_description'])) {
                    $this->comp['company_description'] = $db_settings['company_description'];
                }
                if (!empty($db_settings['quick_links'])) {
                    $decoded_links = json_decode($db_settings['quick_links'], true);
                    if (is_array($decoded_links) && !empty($decoded_links)) {
                        $this->comp['quick_links'] = $decoded_links;
                    }
                }

                if (isset($db_settings['social_facebook'])) {
                    $this->comp['facebookhtml'] = $db_settings['social_facebook'];
                }
                if (isset($db_settings['social_instagram'])) {
                    $this->comp['instagramhtml'] = $db_settings['social_instagram'];
                }
                if (isset($db_settings['social_youtube'])) {
                    $this->comp['youtubehtml'] = $db_settings['social_youtube'];
                }
                if (isset($db_settings['social_twitter'])) {
                    $this->comp['twitterhtml'] = $db_settings['social_twitter'];
                }
                if (isset($db_settings['social_linkedin'])) {
                    $this->comp['linkedinhtml'] = $db_settings['social_linkedin'];
                }
                if (!empty($db_settings['social_whatsapp'])) {
                    $this->comp['whatsapphtml'] = $db_settings['social_whatsapp'];
                } elseif (!empty($this->comp['phone'])) {
                    $clean_ph = preg_replace('/[^\d]/', '', $this->comp['phone']);
                    $this->comp['whatsapphtml'] = 'https://api.whatsapp.com/send?phone=+91' . (strlen($clean_ph) > 10 ? substr($clean_ph, -10) : $clean_ph) . '&text=Hello+Bhandari+Packers+and+Movers,+I+am+interested+in+your+services';
                }

                // Dynamic Logo & Favicon
                if (!empty($db_settings['logo'])) {
                    $logo_val = $db_settings['logo'];
                    if (strpos($logo_val, 'http://') === 0 || strpos($logo_val, 'https://') === 0) {
                        $this->comp['logo_url'] = $logo_val;
                    } else {
                        $this->comp['logo_url'] = $admin_base . $logo_val;
                    }
                }
                if (!empty($db_settings['favicon'])) {
                    $fav_val = $db_settings['favicon'];
                    if (strpos($fav_val, 'http://') === 0 || strpos($fav_val, 'https://') === 0) {
                        $this->comp['favicon_url'] = $fav_val;
                    } else {
                        $this->comp['favicon_url'] = $admin_base . $fav_val;
                    }
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'MX_Controller dynamic settings error: ' . $e->getMessage());
        }

        $this->comp['sku'] = "PM28988";
        $this->comp['mpn'] = "BPM28988";
        // Review
        $this->comp['ratingValue'] = "4.8";
        $this->comp['ratingCount'] = "1839";
        $this->comp['datePublished'] = "16 October, 2025";
        $this->comp['reviewBody'] = "Bhandari Packers provided excellent service with their IBA-approved goods insurance. My items were securely moved, affordable, and stress-free.";
        $this->comp['reviewperson'] = "Shantanu Kumar";

        /* autoload module items */
        $this->load->_autoloader($this->autoload);
    }

    public function __get($class)
    {
        return CI::$APP->$class;
    }
}
