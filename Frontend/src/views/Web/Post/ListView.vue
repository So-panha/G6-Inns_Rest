<template>
  <section>
    <div class="container">
      <div class="text">
        <h1>Page Not Found</h1>
        <p>
          We can't seem to find the page you're looking for. Please check the URL for any typos.
        </p>
        <div class="input-box">
          <input type="text" placeholder="Search..." />
          <button><i class="fa-solid fa-search"></i></button>
        </div>
        <ul class="menu">
          <li><a href="#">Go to Homepage</a></li>
          <li><a href="#">Visit our Blog</a></li>
          <li><a href="#">Contact support</a></li>
        </ul>
      </div>
      <div><img class="image" src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.vecteezy.com%2Ffree-vector%2Frobot-error&psig=AOvVaw0FbCPNtPdegj7vyhXia3-C&ust=1721150662941000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCJDvsIXIqYcDFQAAAAAdAAAAABAE" alt="" /></div>
    </div>
    <!-- </div> -->
  </section>
</template>

<script>
export default {}
</script>

<style>
section {
  width: 100%;
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: row;
  column-gap: 20px;
}
.container img {
  width: 420px;
}
.text {
  display: block;
  padding: 40px 40px;
  width: 450px;
}
.text {
  display: block;
  padding: 40px 40px;
  width: 450px;
}
.text h1 {
  color: #00c2cb;
  font-size: 35px;
  font-weight: 700;
  margin-bottom: 15px;
}
.text p {
  font-size: 15px;
  color: #e0ffff;
  margin-bottom: 15px;
  line-height: 1.5rem;
  margin-bottom: 15px;
}
</style>
