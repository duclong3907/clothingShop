@php
$title="Contact";
@endphp
<!DOCTYPE html>
<html>

<head>
   @include('frontend.css')
   <style>
      .center {
         margin: auto;
         width: 50%;
         text-align: center;
         padding: 30px;
      }

      table,
      th,
      td {
         border: 1px solid black;
      }

      .th_deg {
         font-size: 24px;
         padding: 5px;
         background: skyblue;
      }

      .total_deg {
         font-size: 20px;
         padding: 40px;
         font-weight: bold;
      }

      .popup {
         width: 400px;
         background-color: #fff;
         border-radius: 6px;
         position: absolute;
         top: 0;
         left: 50%;
         transform: translate(-50%, -50%) scale(0.1);
         text-align: center;
         padding: 0 30px 30px;
         color: #333;
         visibility: hidden;
         transition: transform 0.4s, top 0.4s;
         border: 1px solid #ccc;
         background: #ffffff;
      }

      .open-popup {
         visibility: visible;
         top: 50%;
         transform: translate(-50%, -50%) scale(1);
      }

      .popup img {
         width: 100px;
         margin-top: -50px;
         border-radius: 50%;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      }

      .popup h2 {
         font-size: 38px;
         font-weight: 500;
         margin: 30px 0 10px;
      }

      .popup button {
         width: 100%;
         margin-top: 50px;
         padding: 10px 0;
         background: #6fd649;
         color: #fff;
         border: 0;
         outline: none;
         font-size: 18px;
         border-radius: 4px;
         cursor: pointer;
         box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
      }

      .sendMail {
         display: block;
         padding: 10px 45px;
         background-color: #f7444e;
         border: 1px solid #f7444e;
         color: #ffffff;
         border-radius: 0;
         -webkit-transition: all 0.3s;
         transition: all 0.3s;
         margin: auto;
      }

      .sendMail:hover {
         background-color: #333;
         color: #ffffffa8;
      }

      form input {
         text-transform: none;
      }
   </style>
</head>

<body>
@include('sweetalert::alert')
   <div class="hero_area">
      @include('frontend.header')

      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Contact with us</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      <section class="why_section layout_padding">
         <div class="container">

            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <!-- <div class="full"> -->
                  <form action="{{url('add_feedback')}}" method="POST">
                     @csrf
                     <input type="text" placeholder="Enter full name" name="fullname" required id="fullname"
                        value="{{Auth::user()->name}}" />
                     <input type="email" placeholder="Enter email" name="email" id="email" required
                        value="{{Auth::user()->email}}" />
                     <input type="tel" placeholder="Enter phone number" name="phone" id="phone" required
                        value="{{Auth::user()->phone}}" />
                     <input type="text" placeholder="Enter subject" name="subject_name" id="subject_name" required />
                     <textarea placeholder="Enter content" required name="note" id="note"></textarea>
                     <button type="button" class="btn sendMail" onclick="openPopup()">Send Message</button>
                     <div class="popup" id="popup">
                        <img src="{{ asset('themes/frontend/images/404-tick.png') }}" alt="">
                        <h2>Thank You!</h2>
                        <p>Thank you for contacting me. I will reply as soon as possible. Click Continue to go Homepage!
                        </p>
                        <button type="submit" onclick="closePopup()">CONTINUE</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
   </div>
   </section>
   <!-- end why section -->
   <!-- arrival section -->
   <section class="arrival_section">
      <div class="container">
         <div class="box">
            <div class="arrival_bg_box">
               <img src="{{ asset('themes/frontend/images/sonyejin1.png') }}" alt="">
            </div>
            <div class="row">
               <div class="col-md-6 ml-auto">
                  <div class="heading_container remove_line_bt">
                     <h2>
                        New Arrivals
                     </h2>
                  </div>
                  <p style="margin-top: 20px;margin-bottom: 30px;">
                     Discover our captivating new arrivals—fresh, trendy products that exceed expectations. From
                     fashion-forward apparel to cutting-edge gadgets, our curated collection has something for everyone.
                     Explore and elevate your style today!
                  </p>
                  <a href="">
                     Shop Now
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- end client section -->
   <!-- footer start -->
   @include('frontend.footer')
   <!-- footer end -->

   <script>
      let popup = document.getElementById("popup");
      let sendButton = document.querySelector('.sendMail');
      sendButton.addEventListener("click", openPopup);

      function openPopup() {
         var nameInput = document.getElementById("fullname");
         var emailInput = document.getElementById("email");
         var phoneInput = document.getElementById("phone");
         var subjectInput = document.getElementById("subject_name");
         var messageMail = document.getElementById("note");

         if (nameInput.value === "" || emailInput.value === "" || subjectInput.value === "" || phoneInput.value === "") {
            Swal.fire({
               icon: 'warning',
               title: 'Please complete all information',
            });
         } else if (messageMail.value === "") {
            Swal.fire({
               icon: 'warning',
               title: 'Please fill in the message',
            });
         } else {
            popup.classList.add("open-popup");
            document.addEventListener("click", closePopupOutside);
         }
      }

      function closePopup() {
         popup.classList.remove("open-popup");
         document.removeEventListener("click", closePopupOutside);
      }

      function closePopupOutside(event) {
         if (!popup.contains(event.target) && event.target !== sendButton) {
            closePopup();
         }
      }
   </script>
</body>

</html>