export default [
    {path: '/', redirect: '/dashboard'},

    {
        path: '/dashboard',
        name: 'dashboard',
        component: require('./screen/dashboard/index')
    },

    {
        path: '/products',
        name: 'products',
        component: require('./screen/products/index')
    },

    {
        path: '/products/:id',
        name: 'products-preview',
        component: require('./screen/products/preview')
    },
    
];
