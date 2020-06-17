module.exports = {
    title: 'Mobile Money API',
    description: "Mobile Money Payments API in Kenya (MPESA, EQUITEL, Airtel Money,T-CASH). B2B, B2C, C2B, Balance Query and Reversals ",
    home: true,
    serviceWorker: true,
    head: [
        ['link', {rel: 'icon', href: `/favicon.ico`}],
        ['link', {rel: 'manifest', href: '/manifest.json'}],
        ['meta', {name: 'theme-color', content: '#3eaf7c'}],
        ['meta', {name: 'apple-mobile-web-app-capable', content: 'yes'}],
        ['meta', {name: 'apple-mobile-web-app-status-bar-style', content: 'black'}],
        ['link', {rel: 'apple-touch-icon', href: '/images/icons/icon-152x152.png'}],
        ['link', {rel: 'mask-icon', href: '/images/icons/icon-152x152.png', color: '#3eaf7c'}],
        ['meta', {name: 'msapplication-TileImage', content: '/images/icons/icon-144x144.png'}],
        ['meta', {name: 'msapplication-TileColor', content: '#000000'}]
    ],
    ga: 'UA-119008638-1',
    plugins: [
        ['@vuepress/pwa',
            {
                serviceWorker: true,
                updatePopup: true
            }
        ]
    ],
    themeConfig: {
        repo: 'samerior/mobile-money',
        // editLinks: true,
        nav: [
            {text: 'Home', link: '/'},
            {text: 'Agweria LLC', link: 'https://agweria.com'},
            {
                text: 'Developer Portal',
                items: [
                    {text: 'Safaricom Developer Portal', link: 'https://developer.safaricom.co.ke/'},
                    {text: 'Equity Developer Portal', link: 'https://developers.equitybankgroup.com/'},
                ]
            }
        ],
        sidebar: [
            '/',
            ['/guide/introduction', 'Introduction'],
            ['/about', 'About Agweria LLC'],
            ['/guide/installation', 'Installation'],
            {
                title: 'Mpesa',
                collapsable: false,
                children: [
                    ['/guide/mpesa/', 'Introduction'],
                    ['/guide/mpesa/register', 'Register URL'],
                    ['/guide/mpesa/stk', 'STK Push'],
                    ['/guide/mpesa/c2b', 'C2B Events'],
                    ['/guide/mpesa/b2c', 'B2C Payments'],
                    ['/guide/mpesa/faq', 'FAQ'],
                    ['/guide/mpesa/errors', 'Errors']
                ]
            },
            {
                title: 'Equity',
                collapsable: true,
                children: [
                    ['/guide/equity/', 'Introduction']
                ]
            },
            ['/LICENSE', 'License'],
            {
                title: 'Contributing',
                children: [
                    ['/developers/contributing', 'Contributing'],
                    ['/developers/coc', 'Code of Conduct']
                ]
            }
        ]
    }
}
