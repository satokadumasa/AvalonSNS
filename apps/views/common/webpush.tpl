
<script src="https://www.gstatic.com/firebasejs/4.1.2/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyD-eOVF5bcHJinjjVwz2M61v3qfgg_qMUM",
    authDomain: "avalonsns.firebaseapp.com",
    databaseURL: "https://avalonsns.firebaseio.com",
    projectId: "avalonsns",
    storageBucket: "avalonsns.appspot.com",
    messagingSenderId: "218719495965"
  };
  firebase.initializeApp(config);

  if ('serviceWorker' in navigator) {
    console.log('Service Worker is supported');
    navigator.serviceWorker.register('./js/serviceworker.js').then(function(reg) {
      console.log('Service Worker is ready :^)', reg);
      reg.pushManager.subscribe({userVisibleOnly: true}).then(function(sub) {
        console.log('subscribed:' , sub)
        console.log('endpoint:', sub.endpoint);

        var iframe = document.createElement("iframe");
        iframe.src = './send?endpoint=' + sub.endpoint;
        iframe.width = 1
        iframe.height = 1
        document.body.appendChild(iframe);

      });
    }).catch(function(error) {
      console.log('Service Worker error :^(', error);
    });
  }
</script>
<script src="/js/webapp.js"></script>
<link rel="manifest" href="manifest.json">
