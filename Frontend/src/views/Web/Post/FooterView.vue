<template>
  <footer class="footer text-black pt-5 pb-2 mt-3">
    <div class="container text-center text-md-left">
      <div class="row text-center text-md-left">
        <h5 class="footer-header text-white p-3 mb-5">List of property</h5>
        <div class="col-12 col-md-3 col-lg-2 col-xl-2 mx-auto head">
          <img src="../../../Image/InnsRest.png" class="logo">
        </div>

        <div class="col-12 col-md-9 col-lg-8 col-xl-8 mx-auto">
          <div class="socialmedai">
            <button type="button" class="btn btn-custom">
              <a href="https://x.com/?lang=en"><img src="../../../Image/Twitter.png" alt="" class="media"></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.facebook.com/people/%E1%9E%98%E1%9F%89%E1%9E%B6-%E1%9E%9F%E1%9F%92%E1%9E%9A%E1%9E%B8%E1%9E%93%E1%9E%B8/pfbid032m4gZpP773VVtj4TiTkCD5aepaePD1JeY2hA2pJXSKhB5fXx6i4x3HSJJsJc6g5Jl/?locale=en_GB"><img src="../../../Image/Facebook.png" alt="" class="media"></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.instagram.com/"><img src="../../../Image/Instagram.png" alt="" class="media"></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.youtube.com/"><img src="../../../Image/Youtube.png" alt="" class="media"></a>
            </button>
          </div>

          <div class="row mt-4 content">
            <div class="col-12 col-sm-6 col-lg-3">
              <h5>BRANCH</h5>
              <p>System builder</p>
              <p>Guest Houses</p>
              <p>Online cause builder</p>
              <p>Promote Branch</p>
              <p>Suggest feature</p>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <h5>RESOURCES</h5>
              <p>System House</p>
              <p>General Active</p>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <h5>INFO</h5>
              <p>View Map directory</p>
              <p>Find house here</p>
              <p>Security & Safe</p>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <h5>COUNTRY</h5>
              <p>Every Place</p>
              <p>Inside country</p>
              <p>Booking remote</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12 col-lg-5 text-start text-black py-3">
        @Copyright: Group 6 / Inns Rest system
      </div>
      <div class="col-12 col-lg-3 d-flex justify-content-center align-items-center">
        <img src="../../../Image/qrcode.jpg" class="footer-image">
        <img src="../../../Image/card.png" class="footer-image ml-2">
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterView'
}
</script>

<style scoped>
.footer-header {
  background-color: #40008f;
  text-align: center;
}

.btn-custom {
  background-color: transparent;
  border: none;
  padding: 0;
}

.btn-custom:hover {
  background-color: transparent !important;
  border-color: transparent !important;
}

.btn-custom a img {
  display: block;
}

footer a {
  text-decoration: none;
}

.footer a:hover {
  text-decoration: none;
}

footer a img {
  transition: transform 0.3s;
}

footer a:hover img {
  transform: scale(1.1);
}

.logo {
  width: 160px;
  display: block;
  margin: 0 auto;
}

.media {
  filter: grayscale(100%);
  width: 52px;
  height: 52px;
}

.socialmedai {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  margin-bottom: 1rem;
}

.content {
  margin-top: 2rem;
  color: #7606ff;
  text-align: center;
}

.content h5 {
  margin-bottom: 1rem;
}

.content p {
  color: black;
}

.footer-image {
  width: 80px;
  height: 50px;
}

@media screen and (max-width: 767px) {
  .footer-header {
    text-align: center;
  }

  .socialmedai {
    justify-content: center;
  }

  .content {
    text-align: center;
  }
}

@media screen and (min-width: 768px) and (max-width: 1024px) {
  .footer-header {
    text-align: center;
  }

  .content {
    text-align: left;
  }
}
@media screen and (max-width: 767px) {
  .col-lg-3{
    display: none;
  }
  .text-start{
    text-align: center;
    margin-left: 20%;
  }
}
</style>
