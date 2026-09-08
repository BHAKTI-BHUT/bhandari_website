<div class="container cityfrom">
    <div class='row mt-5'>
        <?php
        $ct = array(
            "Alipur",
            "Bawana",
            "Central Delhi",
            "Delhi",
            "Deoli",
            "East Delhi",
            "Karol Bagh",
            "Najafgarh",
            "Narela",
            "North Delhi",
            "Ghaziabad",
            "Patna",
            "Ludhiana",
            "Visakhapatnam",
            "Vadodara",
            "Mumbai",
            "Chennai",
            "Pune",
            "Cochin",
            "Kolkata",
            "Bangalore",
            "Hyderabad",
            "Ahmedabad",
            "Jaipur",
            "Lucknow",
            "Surat",
            "Coimbatore",
            "Bhopal",
            "Indore",
            "Gurgaon",
            // "Noida",
            "Chandigarh",
            "Kochi",
            "Nagpur",
            "Thiruvananthapuram",
            "Kanpur",
            "Mysore",
            "Vijayawada",
            "Nashik",
            "Ranchi",
            "Guwahati",
            "Dehradun",
            "Varanasi",
            "Amritsar",
            "Raipur",
            "Madurai",
            "Jodhpur",
            "Meerut",
            "Agra",
            "Jabalpur",
            "Gulbarga",
            "Jamnagar",
            "Ujjain",
            "Loni",
            "Siliguri",
            "Hubli-Dharwad",
            "Tiruchirappalli",
            "Udaipur",
            "Jhansi",
            "Gwalior",
            "Dhanbad",
            "Bhubaneswar",
            "Allahabad",
            "Salem",
            "Ajmer",
            "Mangalore",
            "Bilaspur",
            "Haridwar",
            "Bareilly",
            "Moradabad",
            "Tirupati",
            "Ambattur",
            "Malegaon",
            "Guntur",
            "Kakinada",
            "Panipat",
            "Bhiwadi",
            "Kollam",
            "Bhavnagar",
            "Ichalkaranji",
            "Bellary",
            "Bokaro",
            "Nellore",
            "Solapur",
            "Tumkur",
            "Hapur",
            "Anantapur",
            "Bhagalpur",
            "Warangal",
            "Tirunelveli",
            "Nanded",
            "Karimnagar",
            "Asansol",
            "Aligarh",
            "Rajahmundry",
            "Gandhinagar",

        );


        $ct = array_diff($ct, array($city));

        foreach ($ct as $c) {
            $flink = strtolower(str_replace(' ', '-', $city));;
            $tlink = strtolower(str_replace(' ', '-', $c));
        ?>
            <div class="col-sm-4">
                <a href="<?= site_url("packers-movers-from-$flink-to-$tlink") ?>">
                    <span>Packers movers from <b><?= $city ?> to <?= $c ?></b></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<style>
    span b {
        color: #FC5D09
    }

    .cityfrom span {
        font-size: 16px
    }

    .cityfrom a:hover {
        color: #FC5D09
    }
</style>