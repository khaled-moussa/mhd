<?php

use Illuminate\Support\Str;

return [
    'sections' => [
        'hero' => [
            'title' => 'Find Your Dream Property',
            'description' => 'Discover modern real estate solutions with cutting-edge architecture and sustainable developments.',
            'data' => [],
            'visible' => true,
            'order' => 1,
        ],

        'about-us' => [
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
            'data' => [],
            'visible' => true,
            'order' => 2,
        ],

        'services' => [
            'title' => 'Our Services',
            'description' => 'We provide professional real estate solutions to help you find, manage, and grow your investments with confidence..',
            'data' => [
                [
                    'uuid' => 'srv-100',
                    'icon' => 'fi fi-tc-garage',
                    'title' => 'Property Sales',
                    'description' => 'Buy and sell residential and commercial properties with expert guidance.',
                ],
                [
                    'uuid' => 'srv-101',
                    'icon' => 'fi fi-ts-document-gear',
                    'title' => 'Property Management',
                    'description' => 'Full-service management for rental properties, including tenants and maintenance.',
                ],
                [
                    'uuid' => 'srv-102',
                    'icon' => 'fi fi-tr-builder',
                    'title' => 'Real Estate Investment',
                    'description' => 'Discover profitable real estate opportunities and maximize your ROI.',
                ],
                [
                    'uuid' => 'srv-103',
                    'icon' => 'fi fi-tr-assessment',
                    'title' => 'Legal & Documentation',
                    'description' => 'Hassle-free support with contracts, property titles, and legal compliance.',
                ],
                [
                    'uuid' => 'srv-104',
                    'icon' => 'fi fi-ts-apartment',
                    'title' => 'Construction & Development',
                    'description' => 'From planning to execution, we develop high-quality housing and commercial projects.',
                ],
                [
                    'uuid' => 'srv-105',
                    'icon' => 'fi fi-tr-brain-bulb',
                    'title' => 'Consulting & Valuation',
                    'description' => 'Accurate property valuation and professional advice for smart decisions.',
                ],
            ],
            'visible' => true,
            'order' => 3,
        ],

        'projects' => [
            'title' => 'Our Projects',
            'description' => 'Explore some of our recent real estate developments — from modern apartments to commercial complexes.',
            'data' => [
                [
                    'uuid' => 'pr-100',
                    'img' => 'hero-bg.jpg',
                    'title' => 'Luxury Apartments',
                    'delivered' => 'Augest 2025',
                    'address' => 'Egypt',
                    'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero delectus, mollitia cupiditate beatae modi ratione consequuntur quis veritatis deleniti accusamus, incidunt, exercitationem architecto. Omnis dolor a veniam quibusdam voluptate modi sunt exercitationem magni totam voluptatem harum quisquam, voluptates consectetur. Nostrum dolorum assumenda, ullam non rem vitae nisi impedit officia nobis mollitia aliquid dolores obcaecati modi libero veritatis iusto saepe ratione dicta quisquam accusantium repellat distinctio quas? Maxime provident animi doloribus neque cum quod quo ratione, aperiam non. Eius unde ipsam ipsum saepe similique ex obcaecati culpa distinctio magni inventore, sed quasi sit nesciunt impedit error fugit nulla ab quia ut.',
                ],
                [
                    'uuid' => 'pr-101',
                    'img' => 'hero-bg.jpg',
                    'title' => 'Downtown Offices',
                    'delivered' => 'Augest 2025',
                    'address' => 'Egypt',
                    'description' => 'A state-of-the-art business hub designed for growing enterprises and startups.',
                ],
                [
                    'uuid' => 'pr-102',
                    'img' => 'hero-bg.jpg',
                    'title' => 'Green Villas',
                    'delivered' => 'Augest 2025',
                    'address' => 'Egypt',
                    'description' => 'Eco-friendly luxury villas surrounded by landscaped gardens and open spaces.',
                ],
                [
                    'id' => 'pr-103',
                    'img' => 'hero-bg.jpg',
                    'title' => 'Skyline Tower',
                    'delivered' => 'Augest 2025',
                    'address' => 'Egypt',
                    'description' => 'A high-rise residential tower redefining modern urban living with breathtaking views.',
                ],
            ]
        ],

        'footer' => [
            'title' => 'Our Services',
            'description' => 'The most trusted real estate company, empowering clients with innovative solutions
                    and top-quality developments.',
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

            'visible' => true,
            'order' => null,
        ],
    ],
];
