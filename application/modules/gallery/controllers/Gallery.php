<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MX_Controller {

    function photo_gallery()
    {
        $data['title']       = "Photo Gallery - Bhandari Packers and Movers | Safe & Reliable Relocation Services";
        $data['description'] = "Explore the photo gallery of Bhandari Packers and Movers showcasing our professional packing, loading, and relocation services. Trusted for safe home and office shifting across India.";
        $data['module']      = "gallery";
        $data['view_file']   = "photo-gallery";

        // ── Fetch gallery images from the admin database ──────────────────
        // Use the 'admin_hub' DB connection which points to service_hub (Laravel admin DB).
        $gallery_images = [];

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            $query    = $admin_db->select('id, title, image, alt_text, sort_order')
                                 ->where('status', 1)
                                 ->order_by('sort_order', 'ASC')
                                 ->order_by('id', 'ASC')
                                 ->get('gallery_images');

            if ($query && $query->num_rows() > 0) {
                $gallery_images = $query->result_array();
            }
        } catch (Exception $e) {
            // Silently fall back to empty array — view will handle "no images" state
            log_message('error', 'Gallery DB fetch error: ' . $e->getMessage());
        }

        // Fallback: if DB is empty or failed, scan static folder (backward compat)
        if (empty($gallery_images)) {
            $imageFolder = 'assets/images/gallery/';
            $imageFiles  = glob($imageFolder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) ?: [];
            foreach ($imageFiles as $i => $imageFile) {
                $imageName        = pathinfo($imageFile, PATHINFO_FILENAME);
                $gallery_images[] = [
                    'id'        => $i,
                    'title'     => ucwords(str_replace(['-', '_'], ' ', $imageName)),
                    'image'     => $imageFile,
                    'alt_text'  => $imageName . ' - Bhandari Packers and Movers',
                    'sort_order' => $i,
                ];
            }
        }

        $data['gallery_images'] = $gallery_images;
        echo Modules::run('template/layout2', $data);
    }

    function video_gallery()
    {
        $data['title']       = "Video Gallery - Bhandari Packers and Movers | Safe & Reliable Relocation Services";
        $data['description'] = "Watch our professional packing, loading, and moving videos. Learn how Bhandari Packers and Movers handles household relocations safely across India.";
        $data['module']      = "gallery";
        $data['view_file']   = "video-gallery";

        $video_gallery = [];

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id) {
                $query = $admin_db->select('id, title, caption, video_url, image, sort_order')
                                  ->where('status', 1)
                                  ->order_by('sort_order', 'ASC')
                                  ->order_by('id', 'ASC')
                                  ->get('video_gallery');
                if ($query && $query->num_rows() > 0) {
                    $video_gallery = $query->result_array();
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Video Gallery DB fetch error: ' . $e->getMessage());
        }

        // Process video URLs to get embed links and default thumbnails
        foreach ($video_gallery as &$vid) {
            $video_url = $vid['video_url'];
            $embed_url = '';
            $thumbnail = '';

            // YouTube parsing
            $ytRegex = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i';
            if (preg_match($ytRegex, $video_url, $matches)) {
                $videoId = $matches[1];
                $embed_url = 'https://www.youtube.com/embed/' . $videoId;
                $thumbnail = 'https://img.youtube.com/vi/' . $videoId . '/hqdefault.jpg';
            } else {
                // Vimeo parsing
                $vimeoRegex = '/vimeo\.com\/(?:video\/)?([0-9]+)/i';
                if (preg_match($vimeoRegex, $video_url, $matches)) {
                    $vimeoId = $matches[1];
                    $embed_url = 'https://player.vimeo.com/video/' . $vimeoId;
                    $thumbnail = 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=600&auto=format&fit=crop&q=60';
                } else {
                    $embed_url = $video_url;
                    $thumbnail = 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?w=600&auto=format&fit=crop&q=60';
                }
            }

            $vid['embed_url'] = $embed_url;
            // Use custom cover image if set, otherwise parsed thumbnail
            if (!empty($vid['image'])) {
                $vid['thumbnail_url'] = base_url($vid['image']);
            } else {
                $vid['thumbnail_url'] = $thumbnail;
            }
        }

        $data['video_gallery'] = $video_gallery;
        echo Modules::run('template/layout2', $data);
    }

}