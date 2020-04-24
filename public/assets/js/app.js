/*
Require() : Method is used to run immediate functionalities. 
Define() : Method is used to define modules for use in multiple locations(reuse).
*/

requirejs.config({
    baseUrl: '/assets/js/dependencies', //базовый путь, где лежат все модули
    paths: {
        app: '../app', //сначала ищет модули в baseUrl
		modules: '../modules',
		jquery: 'jquery.min', // it's recommended module name for jQuery
		moment: 'moment.min',
    },
	shim: {
		'bootstrap.bundle.min': ['jquery'],
		'bootstrap-datetimepicker.min': ['jquery', 'moment']
	}
	/*config: {
		opts: {
			websiteBaseUrl: window.location.protocol + "//" + window.location.host + "/"
		}
	}*/
	
	//baseUrl - базовый путь, где лежат все модули
	//paths - пути для модулей, которые находятся не в baseUrl
	//waitSeconds - таймаут, который загрузчик будет ждать скрипта
	//shim - для поддержки модулей сторонних модулей описанных не через define
	//map - позволяет ссылаться через алиас на разные файлы для разных сборок
	//config - для дополнительных настроек, которые будут доступны в модулях
	//packages - указание директорий/пакетов, для множественной загрузки модулей
	//context - указание контекста(например: version1, version2)
	//deps - массив зависимостей
	//callback - вызовется, когда будут загружены зависимости указынные в параметре deps
	//enforceDefine - true/false. вызовет ошибку, припопытке загрузки скрипта без define
	//xhtml - true/false. использование createElementNS для создания скрипт тегов
	//urlArgs - дополнительные параметры при запросе скрипта(удобно использовать решая вопрос кеширования)
	//scriptType - тип скрипта, по умолчанию "text/javascript" (можно также "text/javascript;version=1.8")
});

// Start the main app logic.
require(['app/config', 'jquery', 'modules/routing', 'app/global'], function (config, $, routing, global) { 
	var App = {
		
		init: function (){
			//console.log(out);
		},
		
		run: function (){
			
			var routingResult = routing.routingResolve( location.pathname );
			
			
			//console.log('pages.' + routingResult.pageName + '.load');
			

			if(routingResult.pageName !== undefined)
			{		
				
				var module = "app/" + routingResult.pageName;
				
				//console.log(typeof(routingResult.pageName));
				require([module], function(m) {});
				
			}
		}
		
	}
	
	// on document ready functions:
	$(function(){
		App.init();
		App.run();
	});
	
});

