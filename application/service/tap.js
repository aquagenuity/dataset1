
var casper = require('casper').create({
    verbose: false,
    stepTimeout: 100000,
    waitTimeout: 20000,
    logLevel: 'debug', // debug, info, warning, error, trace
    loadImages:  false,
    loadPlugins: false,
    viewportSize: {width:1280, height:800}
});

var system = require('system');
var utils = require('utils');
var fs = require('fs');

var url = 'https://www.ewg.org/tapwater/';
var proxy_value = casper.cli.raw.get('proxy-value');
var api = casper.cli.raw.get('api');
var zip = casper.cli.raw.get('zip');
var verbose = casper.cli.get('verbose');

var json = null;

if(api == null) api = 'https://lcl.qea.la:8109/api/results';
if(zip == null) zip = '90210';

var proxy_value = '172.245.225.204';
var agent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5';


phantom.setProxy(proxy_value,'80','manual','helpbondme','6VDcAt1jDCtcaODrQCzX');

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

casper.userAgent(agent);

casper.open(url);

casper.waitForSelector('form input[name=zip5]', function(){
  this.trace('two');
  this.trace('fill');
  this.fill('form', {
    'zip5':zip
  }, true);
}, function(){
  throw 'timeout form input[name=zip5]';
}, 3000);

casper.waitForSelector("h1.h1-dark-theme", function(){
  this.trace('three');

  if(this.exists('table.search-results-table')){

    var items = this.evaluate(function(zip){
      var items = [];
      var tables = document.querySelectorAll("table.search-results-table");
      for(var i=0;i<tables.length;i++){
        var table = tables[i];
        var tbodies = table.tBodies;
        for(var j=0;j<tbodies.length;j++){
          var tbodie = tbodies[j];
          var rows = tbodie.rows;
          for(var k=0;k<rows.length;k++){
            var row = rows[k];
            var cells = row.cells;

            var cell = cells[0];
            var a = cell.querySelector('a');
            var href = a.getAttribute('href');
            var pws = href.replace('system.php?pws=', '');
            var utility = a.innerText;

            var cell = cells[1];
            var city = cell.innerHTML;

            var cell = cells[2];
            var served = cell.innerText;
            served = served.replace(/\D/g,'');

            var item = {zip:zip, pws:pws, utility:utility, city:city, served:served};
            items[items.length] = item;
          }
        }
      }
      return items;
    }, zip);

    this.storage.items = items;

  }else{

    this.trace('missed the table');

    var content = this.getPageContent();
    var regex = /.*No systems found that match your search.*/ig;
    if(content.match(regex)){
      this.error('No results for zip ' + zip);
    }else{
      this.error('table.search-results-table not found for zip ' + zip);
    }

    this.bypass(99);
  }

}, function(){
  throw 'timeout h1.h1-dark-theme';
}, 3000);

casper.then(function(){
  this.storage.results = [];
  var items = this.storage.items;
  for(var i=0;i<items.length;i++){
    var item = items[i];
    var pws = item.pws;
    var surl = 'https://www.ewg.org/tapwater/system.php?pws=' + pws;
    this.thenOpen(surl, function(data){

      this.trace(data.url);

      var results = this.evaluate(function(zip, pws){

        String.prototype.unit = function(){
          var result = null;
          var value = this;
          var ppm = /ppm/g;
          var ppb = /ppb/g;
          if(value.match(ppm)){
            result = 'ppm';
          }else if(value.match(ppb)){
            result = 'ppb';
          }
          return result;
        };

        var utility_name = null;
        var hitems = document.querySelectorAll('h1');
        if(hitems.length > 0){
          var hitem = hitems[0];
          utility_name = hitem.innerHTML;
        }

        var items = [];
        var modes = ['above_hbl', 'other'];
        for(var m=0;m<modes.length;m++){

          var mode = modes[m];
          var selector = 'ul#contams_' + mode + ' li div.contaminant-name h3';
          var jitems = document.querySelectorAll(selector);

          for(var j=0;j<jitems.length;j++){

            var item = {zip:zip, pws:pws, mode:mode, utility_name:utility_name};
            var jitem = jitems[j];
            var html = jitem.innerHTML;
            var toxin = html;
            item.toxin = toxin;

            var section = jitem.parentElement.parentElement;
            if(section.tagName == 'SECTION'){

              // health guideline
              var div = section.querySelector('div.health-guideline-ppb');
              if(div){
                var html = div.innerHTML;
                var unit = html.unit();
                html = html.replace('HEALTH GUIDELINE:<br>', '');
                html = html.replace('ppb', '');
                html = html.replace('ppm', '');
                html = html.replace(',', '');
                html = html.trim();
                item.health_guideline = html;
                item.health_guideline_unit = unit;
              }

              // legal limit
              var div = section.querySelector('div.legal-limit-ppb');
              if(div){
                var html = div.innerHTML;
                var unit = html.unit();
                html = html.replace('LEGAL LIMIT:<br>', '');
                html = html.replace('ppb', '');
                html = html.replace('ppm', '');
                html = html.replace(',', '');
                html = html.trim();
                item.legal_limit = html;
                item.legal_limit_unit = unit;
              }

              // national
              var div = section.querySelector('div.national-ppb-popup');
              if(div){
                var html = div.innerHTML;
                var unit = html.unit();
                html = html.replace('ppb', '');
                html = html.replace('ppm', '');
                html = html.replace(',', '');
                html = html.trim();
                item.national_average = html;
                item.national_average_unit = unit;
              }

              // state
              var div = section.querySelector('div.state-ppb-popup');
              if(div){
                var html = div.innerHTML;
                var unit = html.unit();
                html = html.replace('ppb', '');
                html = html.replace('ppm', '');
                html = html.replace(',', '');
                html = html.trim();
                item.state_average = html;
                item.state_average_unit = unit;
              }

              // utility
              var div = section.querySelector('div.this-utility-ppb-popup');
              if(div){
                var html = div.innerHTML;
                var unit = html.unit();
                html = html.replace('ppb', '');
                html = html.replace('ppm', '');
                html = html.replace(',', '');
                html = html.trim();
                item.utility_average = html;
                item.utility_average_unit = unit;
              }
            }

            items[items.length] = item;
          }
        }
        return items;
      }, zip, pws);

      for(var r=0;r<results.length;r++){
        var result = results[r];
        this.storage.results[this.storage.results.length] = result;
      }
    });
    //if(i > 10) break;
  }
});

casper.then(function(){
  var data = this.storage.results;
  var json = JSON.stringify(data, null, 2);

   casper.thenOpen(api, {
      method: 'post',
      data:{json:json}
   });

  this.trace(json);
});

casper.run(function() {
  //this.trace('run');
  this.exit();
});
