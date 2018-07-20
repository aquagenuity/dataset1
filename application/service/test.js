// $buy_proxys = explode(',', BUY_PROXY);
// $buy_proxy_key = array_rand($buy_proxys);
// $buy_proxy = $buy_proxys[$buy_proxy_key];

// //define('BUY_PROXY', '107.172.246.177:80,172.245.225.204:80,173.44.153.114:80,104.160.9.223:80,107.172.246.186:80');
// define('BUY_PROXY', '107.172.246.177:80');  // New York Proxy
// define('BUY_PROXY_AUTH', 'helpbondme:6VDcAt1jDCtcaODrQCzX');


var casper = require('casper').create({
    verbose: false,
    stepTimeout: 100000,
    waitTimeout: 20000,
    logLevel: 'debug', // debug, info, warning, error, trace
    loadImages:  false,
    loadPlugins: false,
    viewportSize: {width:1280, height:800},

  pageSettings: {
        loadImages:  true,        // do not load images
        loadPlugins: true         // do not load NPAPI plugins (Flash, Silverlight, ...)
    }

  });

var system = require('system');
var utils = require('utils');
var fs = require('fs');

var url = 'https://upgrademypolicy.com';
var url = 'https://qeala.com';
var verbose = casper.cli.get('verbose');

var json = null;

casper.storage = {};

if(verbose != null){
  casper.options.verbose = (verbose === true)? true : false;
}

casper.echo = function echo(text, style, pad) {
    "use strict";
    if(this.options.verbose){
      if (!utils.isString(text)) {
          try {
              text = text.toString();
          } catch (e) {
              try {
                  text = utils.serialize(text);
              } catch (e2) {
                  text = '';
              }
          }
      }

    // ERROR: white text on red background
    // INFO: green text
    // TRACE: green text
    // PARAMETER: cyan text
    // COMMENT: yellow text
    // WARNING: red text
    // GREEN_BAR: white text on green background
    // RED_BAR: white text on red background
    // INFO_BAR: cyan text
    // WARN_BAR: white text on orange background


      if(style){
        var message = style ? this.colorizer.colorize(text, style, pad) : text;

        if(this.options.logLevel == 'debug' && (style == 'ERROR' || style == 'WARNING' || style == 'COMMENT' || style == 'TRACE')){
          console.log(this.filter('echo.message', message) || message);
        }
        if(this.options.logLevel == 'info' && (style == 'ERROR' || style == 'WARNING' || style == 'COMMENT')){
          console.log(this.filter('echo.message', message) || message);
        }
        if(this.options.logLevel == 'warning' && (style == 'ERROR' || style == 'WARNING' || style == 'COMMENT')){
          console.log(this.filter('echo.message', message) || message);
        }
        if(this.options.logLevel == 'error' && (style == 'ERROR' || style == 'COMMENT')){
          console.log(this.filter('echo.message', message) || message);
        }
      }else{
        console.log(text);
      }
    }
    return this;
};

// debug, info, warning, error
casper.trace = function(text){
  this.echo(text, 'COMMENT'); //green
};

casper.debug = function(text){
  this.echo(text, 'TRACE'); //green
};

casper.info = function(text){
  this.echo(text, 'COMMENT'); // yellow
};

casper.warning = function(text){
  this.echo(text, 'WARNING'); // red
};

casper.error = function(text){
  this.echo(text, 'ERROR'); // white on red
};

casper.on('error', function(msg, trace){
  var content = this.getPageContent();
  var folder_path = '/var/www/aq.qea.la/application/logs';
  var file_path = folder_path + '/casper.htm';
  fs.write(file_path, content, 'w');
  this.captureSelector(folder_path + '/casper.png', 'html');
  var item = {};
  item.status = 'error';
  item.error = msg;
  json = JSON.stringify(item);
  this.write(json);
  this.bypass(99);
});

casper.on('load.finished', function(status){
  var url = this.getCurrentUrl();
  this.trace(url);
});

casper.on('remote.message', function(msg) {
  if(msg.indexOf('Viewport argument value') != -1) return;
  this.trace(msg);
})

casper.start();

casper.userAgent('Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5');

casper.open(url);

casper.then(function(){
  console.log(url);
});

casper.run(function() {
  //this.trace('run');
  this.exit();
});
