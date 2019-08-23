(function() {
  // Check permissions
  if ("Notification" in window) {
    var permission = Notification.permission;
    
    if (permission === "denied") { 
      return;
    } else if (permission === "granted") { 
      return checkVersion();
    }
    
    Notification.requestPermission().then(function() {
      checkVersion();
    });
  }

  function checkVersion() {
    // Retrieve current version
    var latestVersion = document.querySelector(".js-currentVersion").textContent;
    var currentVersion = localStorage.getItem("conciseVersion");
    if (currentVersion === null || semverCompare(currentVersion, latestVersion) === -1 ) {      
      displayNotification(
        `Click to see what's new in v${latestVersion}`,
        "https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/concise-logo.png",
        "A new version of Concise is available",
        `https://github.com/ConciseCSS/concise.css/releases/v${latestVersion}`
      );
      
      localStorage.setItem("conciseVersion", latestVersion);
    }
  }

  setTimeout(displayNotification(),5000);
  
  function displayNotification(body, icon, title, link, duration) {
    link = link || 0; // Link is optional
    duration = duration || 5000; // Default duration is 5 seconds

    var options = {
      body: body,
      icon: icon
    };

    var n = new Notification(title, options);

    if (link) {
      n.onclick = function () {
        window.open(link);
      };
    }

    setTimeout(n.close.bind(n), duration);
  }
}());
