<template>
  <footer class="footer text-white pt-5 pb-4">
    <div class="container text-center text-md-left">
      <div class="row text-center text-md-left">
        <hr class="mb-4" />

        <div class="col-md-3 col-lg-2 col-xl-8 mx-auto mt-2">
          <h4 class="text-uppercase mb-2 font-weight-bold text-white">Service</h4>
          <p>
            The purpose of building an app Guesthouse Management system is to help people find
            guesthouses when they travel to a new place no matter if it is a long or short way. This
            app can provide the service of booking or renting the guesthouse with safety, comfort,
            and satisfaction.
          </p>
        </div>

        <div class="col-lg-2 col-xl-8 mx-auto mt-2">
          <h4 class="text-uppercase mb-4 font-weight-bold text-white">Content</h4>
          <div class="socialmedai">
            <button type="button" class="btn btn-custom">
              <a href="https://x.com/?lang=en"><img src="../../../Image/Twitter.png" alt="" width="40" height="40" /></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.facebook.com/people/%E1%9E%98%E1%9F%89%E1%9E%B6-%E1%9E%9F%E1%9F%92%E1%9E%9A%E1%9E%B8%E1%9E%93%E1%9E%B8/pfbid032m4gZpP773VVtj4TiTkCD5aepaePD1JeY2hA2pJXSKhB5fXx6i4x3HSJJsJc6g5Jl/?locale=en_GB"><img src="../../../Image/Facebook.png" alt="" width="40" height="40" /></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.instagram.com/"><img src="../../../Image/Instagram.png" alt="" width="40" height="40" /></a>
            </button>
            <button type="button" class="btn btn-custom">
              <a href="https://www.youtube.com/"><img src="../../../Image/Youtube.png" alt="" width="40" height="40" /></a>
            </button>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <div class="footer-copyright text-center py-3">@Copyright: Group 6</div>
</template>

<script>
export default {
  name: 'FooterView'
}
</script>

<style scoped>
.footer {
  background: linear-gradient(1deg, #7606ff 0%, #40008f 52%);
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
  background: linear-gradient(1deg, #2b2eff 0%, #03299a 52%);
  color: white;
}
</style>
