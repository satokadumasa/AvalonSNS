window.addEventListener('load', function() {
  document.getElementById('register').addEventListener('click', register, false);
  document.getElementById('push').addEventListener('click', setPush , false);
  navigator.serviceWorker.ready.then(checkPush);
}, false);

function register() {
  alert("register");
  navigator.serviceWorker.register('/serviceworker.js', {scope: '/'}).then(checkNotification).catch(console.error.bind(console));
  alert("register end:");
}

function checkNotification() {
  alert("checkNotification");
  Notification.requestPermission(function(permission) {
    alert("permission:" + permission);
    if(permission !== 'denied'){
      alert("checkNotification CH-01:" + document.getElementById('push').disabled);
      document.getElementById('push').disabled = false;
      alert("checkNotification CH-02:" + document.getElementById('push').disabled);
    }
    else{
      alert("checkNotification CH-03");
      alert('プッシュ通知を有効にできません。ブラウザの設定を確認して下さい。');
      alert("checkNotification CH-04");
    }
  });
}

var subscription = null;

function checkPush(sw) {
  alert("checkPush:" + sw.pushManager.getSubscription());
  sw.pushManager.getSubscription().then(setSubscription);
}

function setSubscription(s) {
  alert("setSubscription");
  if(!s){
    alert("setSubscription CH-01");
    resetSubscription();
    alert("setSubscription CH-02");
  }
  else {
    alert("setSubscription CH-03");
    document.getElementById('register').disabled = true;
    alert("setSubscription CH-04");
    subscription = s;
    alert("setSubscription CH-05");
    var p = document.getElementById('push');
    alert("setSubscription CH-06");
    p.textContent = 'プッシュ通知を解除する';
    alert("setSubscription CH-07");
    p.disabled = false;
    alert("setSubscription CH-08");
    registerNotification(s);
  }
}

function resetSubscription() {
  alert("resetSubscription");
  document.getElementById('register').disabled = true;
  subscription = null;
  var p = document.getElementById('push');
  p.textContent = 'プッシュ通知を有効にする';
  p.disabled = false;
}

function setPush() {
  alert("setPush");
  if(!subscription) {
    if(Notification.permission == 'denied') {
      alert('プッシュ通知を有効にできません。ブラウザの設定を確認して下さい。');
      return;
    }
    alert("setPush CH-01:" + navigator.serviceWorker.ready);
    var p = document.getElementById('push');
    alert("setPush CH-02:" + Notification.permission);
    p.textContent = 'プッシュ通知を有効にしました';
    alert("setPush CH-03");
    navigator.serviceWorker.ready.then(subscribe);
    alert("setPush CH-04");
  }
  else{
    alert("setPush CH-05");
    navigator.serviceWorker.ready.then(unsubscribe);
    alert("setPush CH-06");
  }
}

function subscribe(sw) {
  alert("subscribe");
  sw.pushManager.subscribe({
    userVisibleOnly: true
  }).then(setSubscription, resetSubscription);
}

function unsubscribe() {
  alert("unsubscribe");
  if(subscription) {
    // 自分のWebアプリサーバ等にプッシュ通知の解除を通知する処理をここに実装
    subscription.unsubscribe();
  }
  resetSubscription();
}

function registerNotification(s) {
  alert(">>>>>>>>registerNotification CH-01");
  var endpoint = s.endpoint;
  alert("registerNotification CH-02");
  // Chrome 43以前への対処
  if(('subscriptionId' in s) && !s.endpoint.match(s.subscriptionId)){
    alert("registerNotification CH-03");
    endpoint += '/regist_subscriptionid/' + s.subscriptionId;
    alert("registerNotification CH-04");
    $.ajax({
      type: "POST",
      url: endpoint,
    }).done(function( msg ) {
      alert( "データ保存: " + msg );
    });    
    alert("registerNotification CH-05");
  }
}
