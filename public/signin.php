<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Form-v10 by Colorlib</title>

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <link rel="stylesheet" type="text/css" href="css/montserrat-font.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css"
    />

    <link rel="stylesheet" href="css/signUp.css" />
    <meta name="robots" content="noindex, follow" />
  </head>
  <body class="form-v10">
    <div class="page-content">
      <div class="form-v10-content">
        <form class="form-detail" action="../server/handleSignin.php" method="post" id="myform">
          <div class="form-left">
            <h2>General Infomation</h2>
            
           
          </div>
          <div class="form-right">
            <h2>LogIn</h2>
            <div class="form-row">
              <input
                type="email"
                name="email"
                class="email"
                id="email"
                placeholder="enter your email"
                required
              />
            </div>
            <div class="form-row">
              <input
                type="password"
                name="password"
                class="password"
                id="password"
                placeholder="enter your password"
                required
              />
            </div>
        
            <div class="form-row-last">
              <input
                type="submit"
                name="register"
                class="register"
                value="Register Badge"
              />
            </div>
          </div>
        </form>
      </div>
    </div>

    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || []
      function gtag() {
        dataLayer.push(arguments)
      }
      gtag('js', new Date())

      gtag('config', 'UA-23581568-13')
    </script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
      integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
      data-cf-beacon='{"rayId":"8bad6ba64800f462","serverTiming":{"name":{"cfL4":true}},"version":"2024.8.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
      crossorigin="anonymous"
    ></script>
  </body>
</html>
