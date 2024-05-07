<?php

namespace App\DataFixtures;

use App\Entities\Attribute;
use App\Entities\AttributeSet;
use App\Entities\Brand;
use App\Entities\Category;
use App\Entities\Currency;
use App\Entities\Gallery;
use App\Entities\Price;
use App\Entities\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DatabaseSeeder implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Categories
        $allCategory = new Category();
        $allCategory->setName('all');
        $manager->persist($allCategory);

        $techCategory = new Category();
        $techCategory->setName('tech');
        $manager->persist($techCategory);

        $clothesCategory = new Category();
        $clothesCategory->setName('clothes');
        $manager->persist($clothesCategory);


        // Brand
        $microsoftBrand = new Brand();
        $microsoftBrand->setName('Microsoft');
        $manager->persist($microsoftBrand);

        $sonyBrand = new Brand();
        $sonyBrand->setName('Sony');
        $manager->persist($sonyBrand);

        $candaGooseBrand = new Brand();
        $candaGooseBrand->setName('Canada Goose');
        $manager->persist($candaGooseBrand);

        $nikeBrand = new Brand();
        $nikeBrand->setName('Nike x Stussy');
        $manager->persist($nikeBrand);

        $appleBrand = new Brand();
        $appleBrand->setName('Apple');
        $manager->persist($appleBrand);


        // Currency
        $currencyUSD = new Currency();
        $currencyUSD->setSymbol('$');
        $currencyUSD->setLabel('USD');
        $manager->persist($currencyUSD);


        // Attribute sets
        $attrSetShoeSize = new AttributeSet();
        $attrSetShoeSize->setName('Size');
        $attrSetShoeSize->setType('text');
        $manager->persist($attrSetShoeSize);

        $attrSetApparelSize = new AttributeSet();
        $attrSetApparelSize->setName('Size');
        $attrSetApparelSize->setType('text');
        $manager->persist($attrSetApparelSize);

        $attrSetColor = new AttributeSet();
        $attrSetColor->setName('Color');
        $attrSetColor->setType('swatch');
        $manager->persist($attrSetColor);

        $attrSetCapacity = new AttributeSet();
        $attrSetCapacity->setName('Capacity');
        $attrSetCapacity->setType('text');
        $manager->persist($attrSetCapacity);

        $attrSetUsbThreePorts = new AttributeSet();
        $attrSetUsbThreePorts->setName('With USB 3 ports');
        $attrSetUsbThreePorts->setType('text');
        $manager->persist($attrSetUsbThreePorts);

        $attrSetTouchIDKeyboard = new AttributeSet();
        $attrSetTouchIDKeyboard->setName('Touch ID in keyboard');
        $attrSetTouchIDKeyboard->setType('text');
        $manager->persist($attrSetTouchIDKeyboard);

        // Shoe Size
        $shoeAttributes = [
            [
                "name" => "Small",
                "displayValue" => "Small",
                "value" => "S",
            ],
            [
                "name" => "Medium",
                "displayValue" => "Medium",
                "value" => "M",
            ],
            [
                "name" => "Large",
                "displayValue" => "Large",
                "value" => "L",
            ],
            [
                "name" => "Extra Large",
                "displayValue" => "Extra Large",
                "value" => "XL",
            ]
        ];

        foreach ($shoeAttributes as $shoeAttribute) {
            $attrShoe = new Attribute();
            $attrShoe->setName($shoeAttribute['name']);
            $attrShoe->setDisplayValue($shoeAttribute['displayValue']);
            $attrShoe->setValue($shoeAttribute['value']);
            $attrShoe->assignToAttributeSet($attrSetShoeSize);
            $manager->persist($attrShoe);
        }

        // Apparel Size
        $apparelAttributes = [
            [
                "name" => "40",
                "displayValue" => "40",
                "value" => "40",
            ],
            [
                "name" => "41",
                "displayValue" => "41",
                "value" => "41",
            ],
            [
                "name" => "42",
                "displayValue" => "42",
                "value" => "42",
            ],
            [
                "name" => "43",
                "displayValue" => "43",
                "value" => "43",
            ],
        ];

        foreach ($apparelAttributes as $apparelAttribute) {
            $attrClothing = new Attribute();
            $attrClothing->setName($apparelAttribute['name']);
            $attrClothing->setDisplayValue($apparelAttribute['displayValue']);
            $attrClothing->setValue($apparelAttribute['value']);
            $attrClothing->assignToAttributeSet($attrSetApparelSize);
            $manager->persist($attrClothing);
        }

        // Color
        $colorAttributes = [
            [
                "name" => "Green",
                "displayValue" => "Green",
                "value" => "#44FF03",
            ],
            [
                "name" => "Cyan",
                "displayValue" => "Cyan",
                "value" => "#03FFF7",
            ],
            [
                "name" => "Blue",
                "displayValue" => "Blue",
                "value" => "#030BFF",
            ],
            [
                "name" => "Black",
                "displayValue" => "Black",
                "value" => "#000000",
            ],
            [
                "name" => "White",
                "displayValue" => "White",
                "value" => "#FFFFFF",
            ],
        ];

        foreach ($colorAttributes as $colorAttribute) {
            $attrColor = new Attribute();
            $attrColor->setName($colorAttribute['name']);
            $attrColor->setDisplayValue($colorAttribute['displayValue']);
            $attrColor->setValue($colorAttribute['value']);
            $attrColor->assignToAttributeSet($attrSetColor);
            $manager->persist($attrColor);
        }

        // Capacity
        $capacityAttributes = [
            [
                "name" => "256GB",
                "displayValue" => "256GB",
                "value" => "256GB",
            ],
            [
                "name" => "512G",
                "displayValue" => "512G",
                "value" => "512G",
            ],
            [
                "name" => "1T",
                "displayValue" => "1T",
                "value" => "1T",
            ],
        ];

        foreach ($capacityAttributes as $capacityAttribute) {
            $attrCapacity = new Attribute();
            $attrCapacity->setName($capacityAttribute['name']);
            $attrCapacity->setDisplayValue($capacityAttribute['displayValue']);
            $attrCapacity->setValue($capacityAttribute['value']);
            $attrCapacity->assignToAttributeSet($attrSetCapacity);
            $manager->persist($attrCapacity);
        }

        // UsbThreePorts
        $usbPortsAttributes = [
            [
                "name" => "Yes",
                "displayValue" => "Yes",
                "value" => "Yes",
            ],
            [
                "name" => "No",
                "displayValue" => "No",
                "value" => "No",
            ]
        ];

        foreach ($usbPortsAttributes as $usbPortsAttribute) {
            $attrUsbPorts = new Attribute();
            $attrUsbPorts->setName($usbPortsAttribute['name']);
            $attrUsbPorts->setDisplayValue($usbPortsAttribute['displayValue']);
            $attrUsbPorts->setValue($usbPortsAttribute['value']);
            $attrUsbPorts->assignToAttributeSet($attrSetUsbThreePorts);
            $manager->persist($attrUsbPorts);
        }

        // TouchIDKeyboard
        $touchIdAttributes = [
            [
                "name" => "Yes",
                "displayValue" => "Yes",
                "value" => "Yes",
            ],
            [
                "name" => "No",
                "displayValue" => "No",
                "value" => "No",
            ],
        ];

        foreach ($touchIdAttributes as $touchIdAttribute) {
            $attrTouchId = new Attribute();
            $attrTouchId->setName($touchIdAttribute['name']);
            $attrTouchId->setDisplayValue($touchIdAttribute['displayValue']);
            $attrTouchId->setValue($touchIdAttribute['value']);
            $attrTouchId->assignToAttributeSet($attrSetTouchIDKeyboard);
            $manager->persist($attrTouchId);
        }

        // Products

        // Product #1
        $product = new Product();
        $product->setSlug('huarache-x-stussy-le');
        $product->setName('Nike Air Huarache Le');
        $product->setDescription('<p>Great sneakers for everyday use!</p>');
        $product->setBrand($nikeBrand);
        $product->setCategory($clothesCategory);
        $product->assignToAttributeSet($attrSetShoeSize);
        $manager->persist($product);
        $images = [
            "https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_2_720x.jpg?v=1612816087",
            "https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_1_720x.jpg?v=1612816087",
            "https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_3_720x.jpg?v=1612816087",
            "https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_5_720x.jpg?v=1612816087",
            "https://cdn.shopify.com/s/files/1/0087/6193/3920/products/DD1381200_DEOA_4_720x.jpg?v=1612816087"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(144.69);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #2
        $product = new Product();
        $product->setSlug('jacket-canada-goosee');
        $product->setName('Jacket');
        $product->setDescription('<p>Awesome winter jacket</p>');
        $product->setBrand($candaGooseBrand);
        $product->setCategory($clothesCategory);
        $product->assignToAttributeSet($attrSetApparelSize);
        $manager->persist($product);
        $images = [
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016105/product-image/2409L_61.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016107/product-image/2409L_61_a.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016108/product-image/2409L_61_b.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016109/product-image/2409L_61_c.jpg",
            "https://images.canadagoose.com/image/upload/w_480,c_scale,f_auto,q_auto:best/v1576016110/product-image/2409L_61_d.jpg",
            "https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058169/product-image/2409L_61_o.png",
            "https://images.canadagoose.com/image/upload/w_1333,c_scale,f_auto,q_auto:best/v1634058159/product-image/2409L_61_p.png"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(518.47);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #3
        $product = new Product();
        $product->setSlug('ps-5');
        $product->setName('PlayStation 5');
        $product->setIsInStock(false);
        $product->setDescription('<p>A good gaming console. Plays games of PS4! Enjoy if you can buy it mwahahahaha</p>');
        $product->setBrand($sonyBrand);
        $product->setCategory($techCategory);
        $product->assignToAttributeSet($attrSetColor);
        $product->assignToAttributeSet($attrSetCapacity);
        $manager->persist($product);
        $images = [
            "https://images-na.ssl-images-amazon.com/images/I/510VSJ9mWDL._SL1262_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/610%2B69ZsKCL._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/51iPoFwQT3L._SL1230_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/61qbqFcvoNL._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/51HCjA3rqYL._SL1230_.jpg"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(844.02);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #4
        $product = new Product();
        $product->setSlug('xbox-series-s');
        $product->setName('Xbox Series S');
        $product->setIsInStock(false);
        $product->setDescription('\n<div>\n    <ul>\n        <li><span>Hardware-beschleunigtes Raytracing macht dein Spiel noch realistischer</span></li>\n        <li><span>Spiele Games mit bis zu 120 Bilder pro Sekunde</span></li>\n        <li><span>Minimiere Ladezeiten mit einer speziell entwickelten 512GB NVMe SSD und wechsle mit Quick Resume nahtlos zwischen mehreren Spielen.</span></li>\n        <li><span>Xbox Smart Delivery stellt sicher, dass du die beste Version deines Spiels spielst, egal, auf welcher Konsole du spielst</span></li>\n        <li><span>Spiele deine Xbox One-Spiele auf deiner Xbox Series S weiter. Deine Fortschritte, Erfolge und Freundesliste werden automatisch auf das neue System übertragen.</span></li>\n        <li><span>Erwecke deine Spiele und Filme mit innovativem 3D Raumklang zum Leben</span></li>\n        <li><span>Der brandneue Xbox Wireless Controller zeichnet sich durch höchste Präzision, eine neue Share-Taste und verbesserte Ergonomie aus</span></li>\n        <li><span>Ultra-niedrige Latenz verbessert die Reaktionszeit von Controller zum Fernseher</span></li>\n        <li><span>Verwende dein Xbox One-Gaming-Zubehör -einschließlich Controller, Headsets und mehr</span></li>\n        <li><span>Erweitere deinen Speicher mit der Seagate 1 TB-Erweiterungskarte für Xbox Series X (separat erhältlich) und streame 4K-Videos von Disney+, Netflix, Amazon, Microsoft Movies &amp; TV und mehr</span></li>\n    </ul>\n</div>');
        $product->setBrand($microsoftBrand);
        $product->setCategory($techCategory);
        $product->assignToAttributeSet($attrSetColor);
        $product->assignToAttributeSet($attrSetCapacity);
        $manager->persist($product);
        $images = [
            "https://images-na.ssl-images-amazon.com/images/I/71vPCX0bS-L._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/71q7JTbRTpL._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/71iQ4HGHtsL._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/61IYrCrBzxL._SL1500_.jpg",
            "https://images-na.ssl-images-amazon.com/images/I/61RnXmpAmIL._SL1500_.jpg"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(333.99);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #5
        $product = new Product();
        $product->setSlug('apple-imac-2021');
        $product->setName('iMac 2021');
        $product->setDescription('The new iMac!');
        $product->setBrand($appleBrand);
        $product->setCategory($techCategory);
        $product->assignToAttributeSet($attrSetCapacity);
        $product->assignToAttributeSet($attrSetUsbThreePorts);
        $product->assignToAttributeSet($attrSetTouchIDKeyboard);
        $manager->persist($product);
        $images = [
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/imac-24-blue-selection-hero-202104?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1617492405000"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(1688.03);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #6
        $product = new Product();
        $product->setSlug('apple-iphone-12-pro');
        $product->setName('apple-iphone-12-pro');
        $product->setDescription('This is iPhone 12. Nothing else to say.');
        $product->setBrand($appleBrand);
        $product->setCategory($techCategory);
        $product->assignToAttributeSet($attrSetColor);
        $product->assignToAttributeSet($attrSetCapacity);
        $manager->persist($product);
        $images = [
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-12-pro-family-hero?wid=940&amp;hei=1112&amp;fmt=jpeg&amp;qlt=80&amp;.v=1604021663000"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(1000.76);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #7
        $product = new Product();
        $product->setSlug('apple-airpods-pro');
        $product->setName('AirPods Pro');
        $product->setIsInStock(false);
        $product->setDescription('\n<h3>Magic like you’ve never heard</h3>\n<p>AirPods Pro have been designed to deliver Active Noise Cancellation for immersive sound, Transparency mode so you can hear your surroundings, and a customizable fit for all-day comfort. Just like AirPods, AirPods Pro connect magically to your iPhone or Apple Watch. And they’re ready to use right out of the case.\n\n<h3>Active Noise Cancellation</h3>\n<p>Incredibly light noise-cancelling headphones, AirPods Pro block out your environment so you can focus on what you’re listening to. AirPods Pro use two microphones, an outward-facing microphone and an inward-facing microphone, to create superior noise cancellation. By continuously adapting to the geometry of your ear and the fit of the ear tips, Active Noise Cancellation silences the world to keep you fully tuned in to your music, podcasts, and calls.\n\n<h3>Transparency mode</h3>\n<p>Switch to Transparency mode and AirPods Pro let the outside sound in, allowing you to hear and connect to your surroundings. Outward- and inward-facing microphones enable AirPods Pro to undo the sound-isolating effect of the silicone tips so things sound and feel natural, like when you’re talking to people around you.</p>\n\n<h3>All-new design</h3>\n<p>AirPods Pro offer a more customizable fit with three sizes of flexible silicone tips to choose from. With an internal taper, they conform to the shape of your ear, securing your AirPods Pro in place and creating an exceptional seal for superior noise cancellation.</p>\n\n<h3>Amazing audio quality</h3>\n<p>A custom-built high-excursion, low-distortion driver delivers powerful bass. A superefficient high dynamic range amplifier produces pure, incredibly clear sound while also extending battery life. And Adaptive EQ automatically tunes music to suit the shape of your ear for a rich, consistent listening experience.</p>\n\n<h3>Even more magical</h3>\n<p>The Apple-designed H1 chip delivers incredibly low audio latency. A force sensor on the stem makes it easy to control music and calls and switch between Active Noise Cancellation and Transparency mode. Announce Messages with Siri gives you the option to have Siri read your messages through your AirPods. And with Audio Sharing, you and a friend can share the same audio stream on two sets of AirPods — so you can play a game, watch a movie, or listen to a song together.</p>\n');
        $product->setBrand($appleBrand);
        $product->setCategory($techCategory);
        $manager->persist($product);
        $images = [
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/MWP22?wid=572&hei=572&fmt=jpeg&qlt=95&.v=1591634795000"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(300.23);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);

        // Product #8
        $product = new Product();
        $product->setSlug('apple-airtag');
        $product->setName('AirTag');
        $product->setDescription('\n<h1>Lose your knack for losing things.</h1>\n<p>AirTag is an easy way to keep track of your stuff. Attach one to your keys, slip another one in your backpack. And just like that, they’re on your radar in the Find My app. AirTag has your back.</p>\n');
        $product->setBrand($appleBrand);
        $product->setCategory($techCategory);
        $manager->persist($product);
        $images = [
            "https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/airtag-double-select-202104?wid=445&hei=370&fmt=jpeg&qlt=95&.v=1617761672000"
        ];
        foreach ($images as $image) {
            $gallery = new Gallery();
            $gallery->setImageURL($image);
            $gallery->assignToProduct($product);
            $manager->persist($gallery);
        }
        $price = new Price();
        $price->setAmount(120.57);
        $price->setCurrency($currencyUSD);
        $price->setProduct($product);
        $manager->persist($price);


        $manager->flush();
    }
}
