(function($){
  var app = {
    'machineName':'CH-DAL-TEST2',
    'url':'http://m4400:8080/',
    'jsonx':'{"Activation":{},"Company":{},"Eligibility":{},"Patient":{"Unrestricted":true},"Clinical_Metrics":{},"Control":{},"EMRConfig":{},"EthnicityType":{},"Field":{},"HealthEvalStatus":{},"Kit":{},"LanguageType":{},"Location":{},"RequiredFieldConfig":{},"SecurityQuestion":{},"State":{},"CatapultConnectSettings":{},"VaccineLot":{},"AuthToken":{"Enabled":false},"Staff":{"Unrestricted":true}}',
    'json':'{"Activation":{},"Company":{},"Eligibility":{},"Patient":{"Unrestricted":true},"HealthEvent":{"Children":[{"Clinic":{"Children":[{"HealthEval":{"Unrestricted":true}},{"ClinicKits":{}},{"ClinicStaff":{}},{"VaccineForm":{"Unrestricted":true,"Children":[{"Vaccine":{"Unrestricted":true}}]}}]}},{"OutcomesProgram":{"Children":[{"OutcomesProgramResult":{"Unrestricted":true}},{"OutcomesProgramMetric":{}},{"OutcomesProgramMetricResult":{"Unrestricted":true}}]}}]},"Clinical_Metrics":{},"Control":{},"EMRConfig":{},"EthnicityType":{},"Field":{},"HealthEvalStatus":{},"Kit":{},"LanguageType":{},"Location":{},"RequiredFieldConfig":{},"SecurityQuestion":{},"State":{},"CatapultConnectSettings":{},"VaccineLot":{},"AuthToken":{ "Enabled":false },"Staff":{"Unrestricted":true}}',
    'db':null,
    'filter':{},
    'filtered':[],
    'init':function(cb){
      try{
        app.db = openDatabase('mydb', '1.0', 'mydb', 100 * 1024 * 1024);  // 100Mb
      }catch(ex){
        var r = {};
        r['status'] = 'error';
        r['error'] = ex.message;
        if(cb) cb(r);
      }

      app.db.transaction(function(tx){
        tx.executeSql('drop table if exists car');
        tx.executeSql('drop table if exists company');
        tx.executeSql('drop table if exists laptop');
      }, function(ex){
        var r = {};
        r['status'] = 'error';
        r['error'] = ex.message;
        if(cb) cb(r);
      }, function(){
        var r = {};
        r['status'] = 'success';
        if(cb) cb(r);
      });
    },
    'getTable':function(name, cb){
      app.db.transaction(function(tx){
        tx.executeSql('select type, name, tbl_name, rootpage, sql from sqlite_master where name like ?', [name], function(tx, rs){
          var r = {};
          r['status'] = 'success';
          r['items'] = rs.rows;
          if(cb) cb(r);
        }, function(tx, ex){
          var r = {};
          r['status'] = 'error';
          r['error'] = ex.message;
          if(cb) cb(r);
        });
      });
    },
    'getJson':function(cmd, qs, cb){

      var settings = {};
      settings.url = app.url;
      settings.cache = false;
      settings.async = true;
      settings.dataType = 'json';
      settings.type = 'POST';
      settings.headers = {"Authorization":"Basic REJQdWJsaXNoZXI6JENhdGFwdWx0UHViMjAxMQ=="};

      var data = 'cmd=' + cmd;
      if(qs) data += '&' + qs;
      settings.data = data;

      //trace('getJson:' + settings.data);

      settings.error = function(rq,cd,ex) { 
        var r = {};
        r['status'] = 'error';
        r['cmd'] = cmd;
        r['error'] = ex.message;
        if(cb) cb(r);
      };

      settings.success = function(rs,cd,rq) {
        if(rs.Status == 'Success'){
          var r = {};
          r['status'] = 'success';
          r['cmd'] = cmd;
          r['items'] = rs[cmd];
          if(cb) cb(r);
        }else{
          var r = {};
          r['status'] = 'error';
          r['cmd'] = cmd;
          r['error'] = rs;
          if(cb) cb(r);
        }
      };
      $.ajax(settings);
    },
    'syncData':function(cmd, items, cb){

      if( !$.isArray(items) || items.length == 0 ){
        var r = {};
        r['status'] = 'success';
        r['cmd'] = cmd;
        r['count'] = 0;
        if(cb) cb(r);
      } 


      var col = [];
      var arg = [];
      for(var p in items[0]){
        col.push(p);
        arg.push('?');
      }

      // if you don't have a table, create it
      app.getTable(cmd, function(data){
        if(data.status == 'success'){

          var csql = null;

          if(data.items.length == 0){
            csql = "create table _cmd_ (_col_)"
            csql = csql.replace('_cmd_', cmd);
            csql = csql.replace('_col_', col.join(','));
          }

          // build the sql
          var sql = "insert into _cmd_ (_col_) values (_arg_)";
          sql = sql.replace('_cmd_', cmd);
          sql = sql.replace('_col_', col.join(','));
          sql = sql.replace('_arg_', arg.join(','));

          // now persist
          var count = 0;

          app.db.transaction(function(tx){

            if(csql) tx.executeSql(csql);

            for(var i=0;i<items.length;i++){
              var item = items[i];
              var val = [];
              for(var p in item) val.push(item[p]);

              if (cmd == "Laptop")
              {
                app.filter.DeviceUid = item.Name;
                app.filter.CompanyName = item.Publication__c;
                app.status('Laptop:' + app.filter.DeviceUid);
                app.status('Client:' + app.filter.CompanyName);
              }
              else if (cmd == "Company")
              {
                var Name = item.Name;
                var CompanyName = app.filter.CompanyName;
                if (Name == CompanyName) app.filter.CompanyId = item.Id;
              }
              else if (cmd == "HealthEvent") app.filter.HealthEventId = item.Id;
              else if (cmd == "Clinic") app.filter.ClinicId = item.Id;
              else if (cmd == "VaccineForm") app.filter.VaccineFormId = item.VaccineFormId;
              else if (cmd == "OutcomesProgram") app.filter.OutcomesProgramId = item.Id;
              else if (cmd == "OutcomesProgramResult") app.filter.OutcomesProgramResultId = item.OutcomesProgramResultId;
                  

              tx.executeSql(sql, val, function(tx, rs){ count++; });
            }

          }, function(ex){
            var r = {};
            r['status'] = 'error';
            r['cmd'] = cmd;
            r['error'] = ex.message;
            if(cb) cb(r);
          }, function(){
            var r = {};
            r['status'] = 'success';
            r['cmd'] = cmd;
            r['count'] = count;
            if(cb) cb(r);
          });
        }else{
          var r = {};
          r['status'] = 'error';
          r['cmd'] = cmd;
          r['error'] = data.error;
          if(cb) cb(r);
        }

      });
    },
    'status':function(html){
      $('div.status').append($('<div>').html(html));
    },
    'error':function(html){
      $('div.status').append($('<div>').addClass('error').html(html));
    },
    'getLaptop':function(cb){
      var key = 'Laptop';
      var qs = app.getQs(key);
      app.getItem(key, qs, function(data){
        if(data.status == 'success'){
          //app.status(data.key + ':' + data.count);
          var r = {};
          r['status'] = 'success';
          if(cb) cb(r);
        }else{
          //app.error(data.key + ':' + data.error);
          var r = {};
          r['status'] = 'error';
          r['error'] = data.error;
          if(cb) cb(r);
        }
      });
    },
    'getUnfiltered':function(root, cb){
      var unfiltered = [];
      for(var key in root){
        var qs = app.getQs(key);
        if(qs == 'Unfiltered'){
          unfiltered.push(key);
          app.getItem(key, null, function(data){
            if(data.status == 'success'){
              app.status(data.key + ':' + data.count);
            }else{
              app.error(data.key + ':' + data.error);
            }
            var n = unfiltered.indexOf(data.key);
            if(n != -1) unfiltered.splice(n, 1);
          });
        } 
      }
      var ii = window.setInterval(function(){
        if(unfiltered.length == 0){
          window.clearInterval(ii);
          var r = {};
          r['status'] = 'success';
          if(cb) cb(r);
        }
      },500);
    },
    'getFiltered':function(root, cb){
      
      app.filtered = [];

      for(var key in root){
        var item = root[key];
        var qs = app.getQs(key);
        if(qs != 'Unfiltered'){
          item.key = key;
          app.filtered.push(item);
        }
      }
      app.processFiltered(cb);
    },
    'processFiltered':function(cb){
      
      if(app.filtered.length > 0) {
        var item = app.filtered.shift();
        var key = item.key;
        var qs = app.getQs(key);
        if(qs == 'Unfiltered'){
          app.error('Unfiltered found in filtered collection for ' + key);
        }else if(qs == null){
          app.error('null filter found in getFiltered for ' + key);
        }else{
          app.getItem(key,qs,function(data){
            if(data.status == 'success'){
              app.status(data.key + ':' + data.count);
              app.processFiltered(cb);
            }else{
              app.error(data.key + ':' + data.error);
            }
          });
        }
      }else{
        if(cb) cb();
      }
    },
    'getItem':function(key, qs, cb){

      app.getJson(key, qs, function(data){
        if(data.status == 'success'){
          app.syncData(data.cmd, data.items, function(data){
            if(data.status == 'success'){
              var r = {};
              r['status'] = 'success';
              r.key = key;
              r['count'] = data.count;
              if(cb) cb(r);
            }else{
              var r = {};
              r['status'] = 'error';
              r.key = key;
              r['error'] = data.error;
              if(cb) cb(r);
            }
          });
        }else{
          var r = {};
          r['status'] = 'error';
          r.key = key;
          r['error'] = data.error;
          if(cb) cb(r);
        }
      });

        // var children = root.Children? root.Children : [];
        // for(var i=0;i<children.length;i++){
        //   var child = children[i];
        //   app.snapShot(child);
        // }
    },
    'getQs':function(key){
      var result = null;
      var filters = [];
      //filters.push("cmd=" + key);

      switch(key){
        case "Laptop":
          if(app.machineName) filters.push("Name=" + app.machineName);
          break;
        case "Activation":
          if(app.filter.DeviceUid) filters.push("DeviceUid=" + app.filter.DeviceUid);
          break;
        case "Patient":
        case "HealthEvent":
          if(app.filter.CompanyId) filters.push("CompanyId=" + app.filter.CompanyId);
          break;
        case "Clinic":
        case "OutcomesProgram":
          if(app.filter.HealthEventId) filters.push("HealthEventId=" + app.filter.HealthEventId);
          break;
        case "HealthEval":
        case "ClinicKits":
        case "ClinicStaff":
        case "VaccineForm":
          if(app.filter.ClinicId) filters.push("ClinicId=" + app.filter.ClinicId);
          break;
        case "Vaccine":
          if(app.filter.VaccineFormId) filters.push("VaccineFormId=" + app.filter.VaccineFormId);
          break;
        case "Eligibility":
          if(app.filter.CompanyName) filters.push("CompanyName=" + app.filter.CompanyName);
          break;
        case "OutcomesProgramMetric":
        case "OutcomesProgramResult":
        case "OutcomesProgramMetricResult":
          if(app.filter.OutcomesProgramId) filters.push("OutcomesProgramId=" + app.filter.OutcomesProgramId);
          break;
        default:
          filters.push('Unfiltered');
          break;
      }
      if(filters.length > 0) result = filters.join('&');
      return result      
    }
  };
  $(document).ready(function(){
    $('.loader').show();      
    app.init(function(data){
      if(data.status == 'success'){
        window.setTimeout(function(){
          var dtm0 = new Date();
          var root = JSON.parse(app.json);
          app.getLaptop(function(data){
            trace('Laptop Complete.');
            app.getUnfiltered(root, function(data){
              trace('Unfiltered Complete.');
              app.getFiltered(root, function(data){
                trace('Filtered Complete.');
                var dtm1 = new Date();
                var ms = dtm1 - dtm0;
                var ss = ms/1000;
                app.status('Elapsed time ' + ms + ' ms');
                $('.loader').fadeOut('fast');
              });
            });
          });
        },0);


        // filtered items can have children
        // really unfiltered items can have children
        // but a child of an unfiltered parent is unfiltered
        // so we are only interested in children of filtered parents
        // if it is filtered then it has to be in an order, so we need a queue
        // at the end of the process we check for more items to process
        // if there are not more items then make the callback

        // window.setTimeout(function(){
        //   app.snapShot(root, function(data){
        //     if(data.status == 'success'){
        //       var dtm1 = new Date();
        //       var ms = dtm1 - dtm0;
        //       var ss = ms/1000;
        //       app.status(app.filter.CompanyName +' Snapshot  in ' + ms + ' ms');
        //     }else{
        //       app.error(data.error);
        //     }
        //   });        
        // }, 0);


      }else{
        trace(data);
      }
    });
  });

  function trace(s){
    if(typeof(s) == 'object') s = JSON.stringify(s);
    if(window.console) window.console.log(s);
  }

})(jQuery);

