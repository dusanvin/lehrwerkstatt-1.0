<style type="text/css">
	.main-img {
	    background-image: url('https://images.pexels.com/photos/5212320/pexels-photo-5212320.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
	    background-position: center center;
	    background-repeat: no-repeat;
	    background-size: cover;
	}

	body span,label,a,button,div,p,input,label {
        font-family: 'Segoe UI' !important;
    }
    
	button {
    	letter-spacing: 0em !important;
	}
	

</style>

@include('layouts.header')

<div class="flex flex-col items-center justify-center main-img flex-col py-6 sm:py-12 min-h-full sm:min-h-screen">
    <div class="w-full sm:max-w-md my-12 px-6 py-12 bg-white shadow-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>

@include('layouts.footer')