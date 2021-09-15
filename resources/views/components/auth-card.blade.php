<style type="text/css">
	.main-img {
	    background-image: url('https://images.pexels.com/photos/5212320/pexels-photo-5212320.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
	    background-position: center center;
	    background-repeat: no-repeat;
	    background-size: cover;
	    min-height: 120vh;
	    width: 100%;
	}
	body span,label,a,button,div,p,input,label {
        font-family: 'Segoe UI' !important;
    }
    
	button {
    	letter-spacing: 0em !important;
	}
	

</style>

@include('layouts.header')

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 main-img">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>

@include('layouts.footer')