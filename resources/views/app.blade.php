<!DOCTYPE html>
<html>
   <head>
      <title>{{ config('app.name') }}</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" crossorigin="anonymous" />
      <link rel="preconnect" href="//fonts.googleapis.com" />
      <link rel="preconnect" href="//fonts.gstatic.com" crossorigin />
      <link href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('lib/themify-icons/themify-icons.css') }}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" crossorigin="anonymous" />

      <link rel="preload" as="style" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" />
      <link rel="preload" as="font" href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap" />
      <link rel="preload" as="style" href="{{ asset('lib/themify-icons/themify-icons.css') }}" />
      <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
      <link rel="preload" as="script" href="//cdn.jsdelivr.net/npm/sweetalert2@11" />
      <link rel="preload" as="script" href="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" />

      <link rel="prefetch" as="style" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" />
      <link rel="prefetch" as="font" href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap" />
      <link rel="prefetch" as="style" href="{{ asset('lib/themify-icons/themify-icons.css') }}" />
      <link rel="prefetch" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
      <link rel="prefetch" as="script" href="//cdn.jsdelivr.net/npm/sweetalert2@11" />
      <link rel="prefetch" as="script" href="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" />

      <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="//cdn.jsdelivr.net/npm/pouchdb@7.3.1/dist/pouchdb.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
      @vite(['resources/css/sass/app.scss', 'resources/js/app.js']) @yield('header_part')
      <script>
         const app_utility = {
            base_url: "{{ url('/') }}",
            redirect: "{{ request()->input('redirect_url') }}",
         };
         
         document.addEventListener("alpine:init", () => {
            Alpine.store("utility", {
               nFormatter(num, digits) {
                  let q = Intl.NumberFormat("en-US", {
                     notation: "compact",
                     maximumFractionDigits: digits,
                  }).format(num);

                  return q;
               },
               moneyFormat(v, c) {
                  if (!c || c == null || typeof c == undefined || typeof c == "undefined" || c == "") {
                     c = "USD";
                  }

                  if (!v || v == null || typeof v == undefined || typeof v == "undefined" || v == "") {
                     v = 0;
                  }

                  let cc = {
                     name: "en-US",
                     currency: "USD",
                  };

                  c = c.toUpperCase();

                  if (c == "POUND") {
                     cc.name = "en-GB";
                     cc.currency = "GBP";
                  }

                  return v.toLocaleString(cc.name, { style: "currency", currency: cc.currency });
               },
               isValidEmail(email) {
                  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                  return re.test(email);
               },
               capitalizeTxt: function (txt) {
                  return txt.charAt(0).toUpperCase() + txt.slice(1);
               },
               numberOnly(event) {
                  let evt = window.event;

                  const charCode = evt.which ? evt.which : evt.keyCode;

                  if (evt.key <= 10 || charCode == 37 || charCode == 39) {
                     console.log("1 - 10 or left or right keys");
                  } else if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                     event.preventDefault();
                  }
               },
               paginator(array, page_number, page_size) {
                  page_number = typeof page_number == "undefined" ? 1 : parseInt(page_number);
                  page_size = typeof page_size == "undefined" ? 30 : parseInt(page_size);
                  return array.slice((page_number - 1) * page_size, page_number * page_size);
               },
               sortItems(arr, t, k) {
                  if (t == "asc") {
                     return arr.sort((a, b) => (a[k] > b[k] ? 1 : -1));
                  } else if (t == "desc") {
                     return arr.sort((a, b) => (a[k] < b[k] ? 1 : -1));
                  } else {
                     return false;
                  }
               },
               isEmpty(v) {
                  let type = typeof v;
                  if (type === "undefined") {
                     return true;
                  }
                  if (type === "boolean") {
                     return !v;
                  }
                  if (v === null) {
                     return true;
                  }
                  if (v === undefined) {
                     return true;
                  }
                  if (v instanceof Array) {
                     if (v.length < 1) {
                        return true;
                     }
                  } else if (type === "string") {
                     if (v.length < 1) {
                        return true;
                     }
                     if (v === "0") {
                        return true;
                     }
                  } else if (type === "object") {
                     if (Object.keys(v).length < 1) {
                        return true;
                     }
                  } else if (type === "number") {
                     if (v === 0) {
                        return true;
                     }
                  }
                  return false;
               },
            });
         });
      </script>
   </head>
   <body>
      <div class="main-container">
         <x-header.menu />
         @yield('content')
      </div>
      <x-footer.footer />
      @yield('footer_part')
   </body>
</html>
