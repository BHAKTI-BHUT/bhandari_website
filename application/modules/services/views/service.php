<div class="service-sidebar shadow mt-3">
    <div class="widget">
        <p class="title site-title">All Services</p>
        <div class="category">
            <?php
            // Get the current URL segment
            $link = $this->uri->segment(1);

            // Define services array with icons
            $services = array(
                array("link" => "home-relocation", "label" => "Home Relocation", "icon" => "fa-home"),
                array("link" => "office-relocation", "label" => "Office Relocation", "icon" => "fa-building"),
                array("link" => "car-transportation-service", "label" => "Car Transportation", "icon" => "fa-car"),
                array("link" => "courier-and-cargo", "label" => "Courier and Cargo Services", "icon" => "fa-box"),
                array("link" => "luggage-delivery", "label" => "Luggage Delivery", "icon" => "fa-suitcase"),
                array("link" => "goods-insurance", "label" => "Goods Insurance", "icon" => "fa-shield-alt")
            );

            // Iterate over the services to create links dynamically
            foreach ($services as $service) {
                // Check if the current service link matches the active page link
                $isActive = ($service['link'] == $link) ? 'active' : '';

                // Apply red background color only if active
                $style = ($isActive) ? 'style="color: #FC5D09;"' : '';

                echo "<a href='" . site_url($service['link']) . "' class='service-link $isActive' $style>
                        <i class='fa " . $service['icon'] . " ser-icons'></i> " . $service['label'] . "
                      </a>";
            }
            ?>
        </div>
    </div>
</div>
