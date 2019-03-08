
Ofcold.booting((Vue, router, store) => {
	router.addRoutes([
		{
			path: '/settings/:resourceName?',
			name: 'ofcold.bundle.settings::index',
			component: require('./views/Settings'),
			props: route => {
				return {
					bundleName: route.params.resourceName || '',
				}
			},
		}
	]);
})
