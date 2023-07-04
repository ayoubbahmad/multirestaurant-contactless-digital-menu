<div>
    <div>

        
            <style>
        [x-cloak] { display: none !important; }
                </style>
         <header>
            <div class="back-links">
                    <a href="{{ url('/store/' . $view_id) }}"><button class="" style="padding: 0;border: none;background: none;"><i class="iconly-Arrow-Left icli"></i></button>
                        <div class="content">
                            <h2>{{$selected_language->data['home'] ?? 'Home'}}</h2>
                        </div>
                    </a>
     
            </div>
        </header>
        
        <div class="page-content-wrapper">
            <div class="container">
                <!-- Cart Wrapper-->
                <div class="cart-wrapper-area py-2">
                   
                <div class="d-flex flex-column pt-5 justify-content-center align-items-center" style="height: 75vh;">
                   <h4 class="text-danger">Payment Failed</h4>
                    <p>Please Try Again</p>
        
                </div>

            </div>
                </div>
            </div>
        </div>
        <!-- Footer Nav-->
        @include('livewire.home.layouts.navbar')
            
</div>
