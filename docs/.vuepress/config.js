module.exports = {
    title: 'Mobile Money API',
    description: "Mobile Money Payments API in Kenya (MPESA, EQUITY/EQUITEL,T-CASH). Supports B2B, B2C and C2B ",
    home: true,
    serviceWorker: true,
    themeConfig: {
        repo: 'samerior/mobile-money',
        // editLinks: true,
        nav: [
            {text: 'Home', link: '/'},
            {text: 'Samerior Group', link: 'https://www.samerior.com'},
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
            ['/about', 'About Samerior Group'],
            ['/guide/installation', 'Installation'],
            {
                title: 'Mpesa',
                collapsable: false,
                children: [
                    ['/guide/mpesa/', 'Introduction'],
                    ['/guide/mpesa/register', 'Register URL'],
                    ['/guide/mpesa/stk', 'STK Push'],
                    ['/guide/mpesa/c2b', 'C2B Events'],
                    ['/guide/mpesa/faq', 'FAQ']
                ]
            },
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
