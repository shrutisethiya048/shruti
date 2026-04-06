<footer class="footer bg-light py-3 mt-auto">
  <p class="text-center mb-0">© 2025 Beauty Shop | Designed by Shruti Jain</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./assets/js/scripts.min.js"></script>
<!-- ✅ WhatsApp Chat Button -->
<script>
  var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?17879';
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = url;
  var options = {
    "enabled": true,
    "chatButtonSetting": {
        "backgroundColor": "#4dc247",
        "ctaText": "",
        "borderRadius": "25",
        "marginLeft": "0",
        "marginBottom": "50",
        "marginRight": "50",
        "position": "right"
    },
    "brandSetting": {
        "brandName": "Shruti",
        "brandSubTitle": "Hi welcome to Beauty Shop 💄",
        "brandImg": "https://cdn.clare.ai/wati/images/WATI_logo_square_2.png",
        "welcomeText": "Hi there! 👋\nHow can I help you?",
        "messageText": "Hello, I have a question about {{page_link}}",
        "backgroundColor": "#0a5f54",
        "ctaText": "Start Chat",
        "borderRadius": "25",
        "autoShow": false,
        "phoneNumber": "+919468810065"
    }
  };
  s.onload = function() { CreateWhatsappChatWidget(options); };
  var x = document.getElementsByTagName('script')[0];
  x.parentNode.insertBefore(s, x);
</script>

</body>
</html>
