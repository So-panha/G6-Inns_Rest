<template>

    <div class="container">
        <h1>Booking <br> Room</h1>
    </div>
    <div class="content">

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="firstname">First Name *</label>
                <input type="text" class="form-control" id="firstname" placeholder="First name">
            </div>
            <div class="col-md-4 mb-3">
                <label for="lastname">Last Name *</label>
                <input type="text" class="form-control" id="lastname" placeholder="Last name">
            </div>
            <div class="col-md-4 mb-3">
                <label for="phone">Phone Number *</label>
                <input type="tel" class="form-control" id="phone" placeholder="Phone number">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="email">Email *</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="col-md-4 mb-3">
                <label for="price">Price *</label>
                <input type="text" class="form-control" id="price" placeholder="Price Auto">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="departuredate">Departure Date *</label>
                <input type="date" class="form-control" id="departuredate" placeholder="Form">
            </div>
            <div class="col-md-6 mb-3">
                <label for="arrivaldate">Arrival Date *</label>
                <input type="date" class="form-control" id="arrivaldate" placeholder="To">
            </div>
        </div>
        <div class="text-right">
            <button class="btn btn-danger mr-2">Cancel</button>
            <button class="btn btn-primary">Payment</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BookingRoom',
};
</script>

<style scoped>
body,
html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
h1{
    margin-top: 20%;
    text-align: left;
    color: white;
    font-size: 70px;
}
.container {
    margin-top: 10px;
    position: relative;
    width: 95%;
    min-height: 50vh;
    display: flex;
    /* justify-content: center; */
    align-items: center;
    background-image: url('https://wpmedia.roomsketcher.com/content/uploads/2021/12/09103646/Subtle_Blue_Shades_Large_Bedroom_idea-1024x768.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.content {
    position: relative;
    background: rgba(255, 255, 255, 0.9);
    padding: 20px;
    width: 91%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-left: 4.5%;
}

.room-image {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto 20px auto;
}
</style>