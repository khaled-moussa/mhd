<?php

return [
    'sections' => [

        /*
        |----------------------
        | Hero
        |----------------------
        */
        'hero' => [
            'label' => 'Hero',
            'title' => 'Find Your Dream Property',
            'description' => 'Discover modern real estate solutions with cutting-edge architecture and sustainable developments.',
            'url' => '#hero',
            'visible' => true,
            'order' => 1,
            'data' => [],
        ],

        /*
        |----------------------
        | About
        |----------------------
        */
        'about' => [
            'label' => 'About',
            'title' => 'Discover who we are, what drives us.',
            'description' => '“We are passionate about transforming ideas into impactful digital experiences.
                Our team combines creativity, technology, and strategy to deliver exceptional
                solutions that empower businesses to grow and innovate.
                With a focus on user experience and cutting-edge design, we craft websites and digital
                platforms that reflect your brand’s identity and connect with your audience.
                Every project is approached with a commitment to quality, functionality, and long-term value.
                Whether it’s building a brand from the ground up, developing custom web solutions,
                or enhancing your online presence — we’re here to bring your vision to life with
                precision, innovation, and care.”',

            'url' => '#about',
            'visible' => true,
            'order' => 2,
            'data' => [],
        ],

        /*
        |----------------------
        | Services
        |----------------------
        */
        'services' => [
            'label' => 'Services',
            'title' => 'Our Services',
            'description' => 'We provide professional real estate solutions to help you find, manage, and grow your investments with confidence..',
            'url' => '#services',
            'visible' => false,
            'order' => 3,
            'data' => [
                [
                    'uuid' => 'srv-100',
                    'icon' => '<i class="fi fi-tc-garage"></i>',
                    'title' => 'Property Sales',
                    'description' => 'Buy and sell residential and commercial properties with expert guidance.',
                ],
                [
                    'uuid' => 'srv-101',
                    'icon' => '<i class="fi fi-ts-document-gear"></i>',
                    'title' => 'Property Management',
                    'description' => 'Full-service management for rental properties, including tenants and maintenance.',
                ],
                [
                    'uuid' => 'srv-102',
                    'icon' => '<i class="fi fi-tr-builder"></i>',
                    'title' => 'Real Estate Investment',
                    'description' => 'Discover profitable real estate opportunities and maximize your ROI.',
                ],
                [
                    'uuid' => 'srv-103',
                    'icon' => '<i class="fi fi-tr-assessment"></i>',
                    'title' => 'Legal & Documentation',
                    'description' => 'Hassle-free support with contracts, property titles, and legal compliance.',
                ],
                [
                    'uuid' => 'srv-104',
                    'icon' => '<i class="fi fi-ts-apartment"></i>',
                    'title' => 'Construction & Development',
                    'description' => 'From planning to execution, we develop high-quality housing and commercial projects.',
                ],
                [
                    'uuid' => 'srv-105',
                    'icon' => '<i class="fi fi-tr-brain-bulb"></i>',
                    'title' => 'Consulting & Valuation',
                    'description' => 'Accurate property valuation and professional advice for smart decisions.',
                ],
            ],

        ],

        /*
        |----------------------
        | Projects
        |----------------------
        */
        'projects' => [
            'label' => 'Projects',
            'title' => 'Our Projects',
            'description' => 'Explore some of our recent real estate developments — from modern apartments to commercial complexes.',
            'url' => '#projects',
            'visible' => false,
            'order' => 4,

            'data' => [
                [
                    'uuid' => 'pr-100',
                    'cover' => 'https://picsum.photos/900/650?random=1',

                    'images' => [
                        'https://picsum.photos/900/650?random=1',
                        'https://picsum.photos/900/650?random=2',
                        'https://picsum.photos/900/650?random=3',
                    ],

                    'title' => 'Luxury Apartments',
                    'price' => '25000',
                    'delivered' => 'August 2025',
                    'address' => 'New Cairo, Egypt',
                    'location' => 'https://www.google.com/maps?q=New+Cairo,Egypt&output=embed',
                    'description' => 'Vero delectus, mollitia cupiditate beatae modi ratione consequuntur quis veritatis deleniti accusamus, incidunt, exercitationem architecto.',
                ],

                [
                    'uuid' => 'pr-101',
                    'cover' => 'https://picsum.photos/900/650?random=4',

                    'images' => [
                        'https://picsum.photos/900/650?random=4',
                        'https://picsum.photos/900/650?random=5',
                        'https://picsum.photos/900/650?random=6',
                    ],

                    'title' => 'Downtown Offices',
                    'price' => '30000',
                    'delivered' => 'August 2025',
                    'address' => 'Nasr City, Egypt',
                    'location' => 'https://www.google.com/maps?q=Nasr+City,Egypt&output=embed',
                    'description' => 'A state-of-the-art business hub designed for growing enterprises and startups.',
                ],

                [
                    'uuid' => 'pr-102',
                    'cover' => 'https://picsum.photos/900/650?random=7',
                    'images' => [
                        'https://picsum.photos/900/650?random=7',
                        'https://picsum.photos/900/650?random=8',
                        'https://picsum.photos/900/650?random=9',
                    ],

                    'title' => 'Green Villas',
                    'price' => '40000',
                    'delivered' => 'August 2025',
                    'address' => 'Sheikh Zayed, Egypt',
                    'location' => 'https://www.google.com/maps?q=Sheikh+Zayed,Egypt&output=embed',
                    'description' => 'Eco-friendly luxury villas surrounded by landscaped gardens and open spaces.',
                ],

                [
                    'uuid' => 'pr-103',
                    'cover' => 'https://picsum.photos/900/650?random=10',

                    'images' => [
                        'https://picsum.photos/900/650?random=11',
                        'https://picsum.photos/900/650?random=12',
                        'https://picsum.photos/900/650?random=13',
                    ],

                    'title' => 'Skyline Tower',
                    'price' => '50000',
                    'delivered' => 'August 2025',
                    'address' => '6th October, Egypt',
                    'location' => 'https://www.google.com/maps?q=6th+October+City,Egypt&output=embed',
                    'description' => 'A high-rise residential tower redefining modern urban living with breathtaking views.',
                ],
            ],
        ],

        /*
        |----------------------
        | Contact
        |----------------------
        */
        'contact' => [
            'label' => 'Contact',
            'title' => 'Let\'s Connect',
            'description' => 'Have questions or ready to start your real estate journey? Reach out to us — our team is here to assist you every step of the way.',
            'url' => '#contact',
            'visible' => true,
            'order' => 5,
            'data' => [],
        ],

        /*
        |----------------------
        | Footer
        |----------------------
        */
        'footer' => [
            'label' => 'Footer',
            'title' => 'Our Services',
            'description' => 'The most trusted real estate company, empowering clients with innovative solutions and top-quality developments.',
            'url' => null,
            'visible' => true,
            'order' => null,
            'data' => [
                'socials' => [
                    [
                        'label' => 'Facebook',
                        'icon' => 'fi-brands-facebook',
                        'link' => 'https://facebook.com/',
                    ],
                    [
                        'label' => 'Instagram',
                        'icon' => 'fi-brands-instagram',
                        'link' => 'https://instagram.com/',
                    ],
                    [
                        'label' => 'LinkedIn',
                        'icon' => 'fi-brands-linkedin',
                        'link' => 'https://linkedin.com/in/',
                    ],
                    [
                        'label' => 'X',
                        'icon' => 'fi-brands-twitter-alt-circle',
                        'link' => 'https://x.com/',
                    ],
                ],

                'company' => [
                    [
                        'label' => 'Facebook',
                        'icon' => 'fi-brands-facebook',
                        'link' => 'https://facebook.com/',
                    ],
                    [
                        'label' => 'Instagram',
                        'icon' => 'fi-brands-instagram',
                        'link' => 'https://instagram.com/',
                    ],
                    [
                        'label' => 'LinkedIn',
                        'icon' => 'fi-brands-linkedin',
                        'link' => 'https://linkedin.com/in/',
                    ],
                    [
                        'label' => 'X',
                        'icon' => 'fi-brands-twitter-alt-circle',
                        'link' => 'https://x.com/',
                    ],
                ],
            ],
        ],
    ],
];
