<template>
  <footer class="footer text-black pt-5 pb-2 mt-3">
    <div class="container text-center text-md-left" >
      <div class="row text-center text-md-left">
        <h5 style="background-color:#001063;" class="text-white p-3 mb-5">List of property <hr></h5>
        
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto head" >

            <img src="../../../Image/InnsRest.png" class="logo">
         
          <!-- <p class="text-uppercase mb-2 font-weight-bold text-black mt-3">List of property</p> -->
          <!-- <hr class="mb-4 w-100 text-white"/> -->
          <!-- <p>
            The purpose of building an app Guesthouse Management system is to help people find
            guesthouses when they travel to a new place no matter if it is a long or short way. This
            app can provide the service of booking or renting the guesthouse with safety, comfort,
            and satisfaction.
          </p> -->
        </div>

        <div class="col-lg-2 col-xl-8 mx-auto">
          <!-- <h4 class="text-uppercase mb-4 font-weight-bold text-black">Content</h4> -->
          <div class="socialmedai">
            <button type="button" class="btn btn-custom">
              <a href="https://x.com/?lang=en"><img src="../../../Image/Twitter.png" alt="" class="media"></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.facebook.com/people/%E1%9E%98%E1%9F%89%E1%9E%B6-%E1%9E%9F%E1%9F%92%E1%9E%9A%E1%9E%B8%E1%9E%93%E1%9E%B8/pfbid032m4gZpP773VVtj4TiTkCD5aepaePD1JeY2hA2pJXSKhB5fXx6i4x3HSJJsJc6g5Jl/?locale=en_GB"><img src="../../../Image/Facebook.png" alt="" class="media"/></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.instagram.com/"><img src="../../../Image/Instagram.png" alt="" class="media"/></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.youtube.com/"><img src="../../../Image/Youtube.png" alt="" class="media"/></a>
            </button>
          </div>
        </div>
        <div class="row mt-10 content">
          <div class="col-lg-3">
            <h6 >BRANCH</h6>
            <br>
            <p>System builder</p>
            <p>Guest Houses</p>
            <p>Online cause builder</p>
            <p>Promote Branch</p>
            <p>Suggest feature</p>
          </div>
          <div class="col-lg-3">
            <h6 >RESOUCES</h6>
            <br>
            <p>System House</p>
            <p>General Active</p>
          </div>
          <div class="col-lg-3">
            <h6 >INFO</h6>
            <br>
            <p>View Map derictory</p>
            <p>Find house here</p>
            <p>Security & Safe</p>
          </div>
          <div class="col-lg-3">
            <h6 >CONTRY</h6>
            <br>
            <p>Every Place</p>
            <p>Inside contry</p>
            <p>Booking remote</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-lg-5 footer-copyright text-start text-black py-3 ml-20 mt-5">@Copyright: Group 6 / Inns Rest system</div>
       <div class="col-lg-3 row mt-10 ml-10">
                <img src="../../../Image/qrcode.jpg" style="width: 80px; height: 50px;">
                <img src="../../../Image/card.png" style="width: 80px; height: 50px;">
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
/* .footer { */
  /* background: linear-gradient(1deg, gray 0%, gray 52%);
 background: linear-gradient(1deg, #7606ff 0%, #40008f 52%);

} */

.container{
    background-color: #D9D9D9;
    width: 100%;
    
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

footer a img {
  transition: transform 0.3s;
}

.footer-copyright {
  /* background: linear-gradient(1deg, gray 0%, gray 52%); */
  color: white;
}

/* .head{
    background: #40008f;
    width: 100%;
} */

.logo{
  width: 160px;
}

.media{
  filter: grayscale(100%);
  width: 56px;
  height: 56 px;
}
.socialmedai{
  display: flex;
  justify-content: space-around;
}
.content{
  margin-left: 0rem;
  color: #7606ff;
}
.content p{
  color: black;
}
</style>
