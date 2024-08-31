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
        <form class="form-detail" action="../server/handleSignup.php" method="post" id="myform">
          <div class="form-left">
            <h2>General Infomation</h2>
            <div class="form-row">
              
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <input
                  type="text"
                  name="first_name"
                  id="first_name"
                  class="input-text"
                  placeholder="First Name"
                  required
                />
              </div>
              <div class="form-row form-row-2">
                <input
                  type="text"
                  name="last_name"
                  id="last_name"
                  class="input-text"
                  placeholder="Last Name"
                  required
                />
              </div>
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="input-text"
                  placeholder="enter password"
                  required
                />
              </div>
              <div class="form-row form-row-2">
                <input
                  type="password"
                  name="rePassword"
                  id="rePassword"
                  class="input-text"
                  placeholder="re-enter password"
                  required
                />
              </div>
            </div>
          
          </div>
          <div class="form-right">
            <h2>Contact Details</h2>
            <div class="form-row">
              <input
                type="text"
                name="street"
                class="street"
                id="street"
                placeholder="Street + Nr"
                required
              />
            </div>
            <div class="form-row">
              <input
                type="text"
                name="additional"
                class="additional"
                id="additional"
                placeholder="Additional Information"
                required
              />
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <input
                  type="text"
                  name="zip"
                  class="zip"
                  id="zip"
                  placeholder="Zip Code"
                  required
                />
              </div>
              <div class="form-row form-row-2">
                <select name="place">
                  <option value="place">Place</option>
                  <option value="Street">Street</option>
                  <option value="District">District</option>
                  <option value="City">City</option>
                </select>
                <span class="select-btn">
                  <i class="zmdi zmdi-chevron-down"></i>
                </span>
              </div>
            </div>
            <div class="form-row">
              <select name="country">
                <option value="country">Country</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Malaysia">Malaysia</option>
                <option value="India">India</option>
              </select>
              <span class="select-btn">
                <i class="zmdi zmdi-chevron-down"></i>
              </span>
            </div>
            <div class="form-group">
              <div class="form-row form-row-1">
                <input
                  type="text"
                  name="code"
                  class="code"
                  id="code"
                  placeholder="Code +"
                  required
                />
              </div>
              <div class="form-row form-row-2">
                <input
                  type="text"
                  name="phone"
                  class="phone"
                  id="phone"
                  placeholder="Phone Number"
                  required
                />
              </div>
            </div>
            <div class="form-row">
              <input
                type="text"
                name="your_email"
                id="your_email"
                class="input-text"
                required
                pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}"
                placeholder="Your Email"
              />
            </div>
            <div class="form-checkbox">
              <label class="container"
                ><p>
                  I do accept the
                  <a href="#" class="text">Terms and Conditions</a> of your
                  site.
                </p>
                <input type="checkbox" name="checkbox" />
                <span class="checkmark"></span>
              </label>
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
