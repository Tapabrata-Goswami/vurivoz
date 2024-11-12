@include('restaurent.includes.header')
<style>
    .hero-section-background{
        position:relative;
        padding:0 !important;
        margin:0 !important;
        height:450px;
        background-position:center;
        background-size:cover;
        background-image:url("{{asset('restaurent/assets/img/foodiesfeed.com_exotic-spices.jpg')}}");
    }
    .hero-section-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Adjust color and transparency */
        z-index: 1; /* Places the overlay above the background */
    }
    .hero-section-background * {
        position: relative;
        z-index: 2; /* Ensures content inside is above the overlay */
    }
    .hero-heading{
        font-size: 48px;
        color:#fff;
        font-weight:600;
        letter-spacing:3px;
        word-spacing:3px;
    }
</style>

<div class="container-fluid hero-section-background">
    <div class="container" style="height:100%;">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md " >
                <h1 class="hero-heading text-center">Partner with Vurivoz<br>
                and grow your business</h1>
                <p>0% commission for the 1st month
                for new restaurant partners in selected cities</p>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2></h2>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
</div>


@include('restaurent.includes.footer')